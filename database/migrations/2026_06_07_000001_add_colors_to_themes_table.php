<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('themes', function (Blueprint $table) {
            $table->string('primary_color')->default('#7e0095')->nullable()->after('file_path');
            $table->string('text_color')->default('#ffffff')->nullable()->after('primary_color');
        });

        $themeColors = [
            'frontend/theme-1' => '#7e0095',
            'frontend/theme-2' => '#16a34a',
            'frontend/theme-3' => '#22c55e',
            'frontend/theme-4' => '#16a34a',
            'frontend/theme-5' => '#0ea5e9',
        ];

        foreach ($themeColors as $filePath => $primaryColor) {
            DB::table('themes')
                ->where('file_path', $filePath)
                ->update([
                    'primary_color' => $primaryColor,
                    'text_color' => '#ffffff',
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('themes', function (Blueprint $table) {
            $table->dropColumn(['primary_color', 'text_color']);
        });
    }
};
