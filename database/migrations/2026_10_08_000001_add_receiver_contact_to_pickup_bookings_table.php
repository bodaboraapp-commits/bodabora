<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pickup_bookings')) {
            return;
        }

        Schema::table('pickup_bookings', function (Blueprint $table) {
            if (! Schema::hasColumn('pickup_bookings', 'receiver_name')) {
                $table->string('receiver_name')->nullable()->after('dropoff_address');
            }

            if (! Schema::hasColumn('pickup_bookings', 'receiver_phone')) {
                $table->string('receiver_phone', 30)->nullable()->after('receiver_name');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('pickup_bookings')) {
            return;
        }

        Schema::table('pickup_bookings', function (Blueprint $table) {
            $table->dropColumn(['receiver_name', 'receiver_phone']);
        });
    }
};
