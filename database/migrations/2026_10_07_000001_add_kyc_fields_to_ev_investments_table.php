<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The ev_investments table was originally created outside of migrations,
 * so this migration both creates it on a fresh install and adds the
 * missing columns on an existing database.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ev_investments')) {
            Schema::create('ev_investments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('country', 100)->default('Kenya');
                $table->string('national_id', 50)->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('county', 100)->nullable();
                $table->string('occupation', 150)->nullable();
                $table->string('kra_pin', 50)->nullable();
                $table->string('referral_source', 100)->nullable();
                $table->integer('bikes_count')->default(1);
                $table->decimal('total_investment', 12, 2)->default(0);
                $table->string('payment_method')->nullable();
                $table->text('notes')->nullable();
                $table->boolean('consent')->default(false);
                $table->timestamp('consent_at')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('stage')->default(1);
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('ev_investments', function (Blueprint $table) {
            if (!Schema::hasColumn('ev_investments', 'country')) {
                $table->string('country', 100)->default('Kenya')->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'national_id')) {
                $table->string('national_id', 50)->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'county')) {
                $table->string('county', 100)->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'occupation')) {
                $table->string('occupation', 150)->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'kra_pin')) {
                $table->string('kra_pin', 50)->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'referral_source')) {
                $table->string('referral_source', 100)->nullable();
            }
            if (!Schema::hasColumn('ev_investments', 'consent')) {
                $table->boolean('consent')->default(false);
            }
            if (!Schema::hasColumn('ev_investments', 'consent_at')) {
                $table->timestamp('consent_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('ev_investments')) {
            return;
        }

        Schema::table('ev_investments', function (Blueprint $table) {
            foreach ([
                'country',
                'national_id',
                'date_of_birth',
                'county',
                'occupation',
                'kra_pin',
                'referral_source',
                'consent',
                'consent_at',
            ] as $column) {
                if (Schema::hasColumn('ev_investments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
