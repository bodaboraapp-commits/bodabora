<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pickup_requests')) {
            return;
        }

        Schema::table('pickup_requests', function (Blueprint $table) {
            // Guest bookings have no merchant account, so a guest pickup that is
            // confirmed and moved to Regular/Express must be allowed without one.
            $table->foreignId('merchant_id')->nullable()->change();
        });

        if (! Schema::hasColumn('pickup_requests', 'guest_booking_id')) {
            Schema::table('pickup_requests', function (Blueprint $table) {
                $table->unsignedBigInteger('guest_booking_id')->nullable()->after('merchant_id');
                $table->index('guest_booking_id');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('pickup_requests')) {
            return;
        }

        if (Schema::hasColumn('pickup_requests', 'guest_booking_id')) {
            Schema::table('pickup_requests', function (Blueprint $table) {
                $table->dropIndex(['guest_booking_id']);
                $table->dropColumn('guest_booking_id');
            });
        }

        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->foreignId('merchant_id')->nullable(false)->change();
        });
    }
};
