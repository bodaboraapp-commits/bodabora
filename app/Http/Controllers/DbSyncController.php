<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * One-time database sync endpoint for hosts without SSH/terminal access.
 *
 * It is disabled unless DB_SYNC_TOKEN is set in .env, and every request must
 * supply that token. Remove the token from .env once the sync is finished.
 */
class DbSyncController extends Controller
{
    public function run(Request $request)
    {
        $expected = (string) config('app.db_sync_token', '');

        // Fail closed: no token configured means the endpoint does nothing.
        if ($expected === '') {
            return $this->text("DB sync is disabled.\nAdd DB_SYNC_TOKEN=<random-string> to .env to enable it.\n", 403);
        }

        if (!hash_equals($expected, (string) $request->query('token', ''))) {
            Log::warning('db-sync: rejected request with invalid token', ['ip' => $request->ip()]);
            return $this->text("403 Forbidden\n", 403);
        }

        Log::info('db-sync: run started', ['ip' => $request->ip(), 'import' => $request->boolean('import'), 'seed' => $request->boolean('seed')]);

        $lines = [];
        $lines[] = 'BODABORA DB SYNC  ' . now()->toDateTimeString();
        $lines[] = 'database: ' . DB::connection()->getDatabaseName();
        $lines[] = '';

        /* 1. Optional full-dump import from storage/app/db-sync/bodabora.sql */
        if ($request->boolean('import')) {
            $dump = storage_path('app/db-sync/bodabora.sql');

            if (!File::exists($dump)) {
                $lines[] = 'IMPORT  : SKIPPED - upload the dump to storage/app/db-sync/bodabora.sql first';
            } else {
                try {
                    DB::unprepared(File::get($dump));
                    $lines[] = 'IMPORT  : OK (' . number_format(File::size($dump)) . ' bytes imported)';
                } catch (\Throwable $e) {
                    $lines[] = 'IMPORT  : FAILED - ' . $e->getMessage();
                }
            }
        }

        /* 2. Migrations (idempotent; safe to run after an import) */
        try {
            Artisan::call('migrate', ['--force' => true]);
            $out = trim(Artisan::output());
            $lines[] = 'MIGRATE : ' . ($out === '' ? 'nothing to run' : str_replace("\n", ' | ', $out));
        } catch (\Throwable $e) {
            $lines[] = 'MIGRATE : FAILED - ' . $e->getMessage();
        }

        /* 3. Optional baseline seeding (only for a brand-new database) */
        if ($request->boolean('seed')) {
            try {
                Artisan::call('db:seed', ['--force' => true]);
                $lines[] = 'SEED    : OK';
            } catch (\Throwable $e) {
                $lines[] = 'SEED    : FAILED - ' . $e->getMessage();
            }
        }

        /* 4. Clear caches so the new data/config takes effect immediately */
        foreach (['config:clear', 'route:clear', 'view:clear', 'cache:clear'] as $command) {
            try {
                Artisan::call($command);
            } catch (\Throwable $e) {
                // non-fatal
            }
        }
        $lines[] = 'CACHES  : cleared';

        $lines[] = '';
        $lines[] = 'Done. Remove DB_SYNC_TOKEN from .env now to disable this endpoint.';

        return $this->text(implode("\n", $lines) . "\n");
    }

    private function text(string $body, int $status = 200)
    {
        return response($body, $status)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
