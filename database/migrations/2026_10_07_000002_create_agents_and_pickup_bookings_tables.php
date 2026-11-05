<?php

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Applications from shops, sellers and individuals who want to earn with BodaBora.
        if (!Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('business_name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone', 30);
                $table->string('type', 30)->default('agent')->comment('agent, seller or shop');
                $table->string('county', 100)->nullable();
                $table->text('address')->nullable();
                $table->string('volume', 100)->nullable()->comment('expected parcels per week');
                $table->text('notes')->nullable();
                $table->unsignedTinyInteger('status')->default(Status::ACTIVE);
                $table->timestamps();

                $table->index('type');
                $table->index('status');
            });
        }

        // Public parcel pickup bookings (guests included, so no merchant FK).
        if (!Schema::hasTable('pickup_bookings')) {
            Schema::create('pickup_bookings', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone', 30);
                $table->string('email')->nullable();
                $table->text('pickup_address');
                $table->text('dropoff_address')->nullable();
                $table->text('parcel_description')->nullable();
                $table->unsignedInteger('parcel_quantity')->default(1);
                $table->string('weight', 50)->nullable();
                $table->date('preferred_date')->nullable();
                $table->string('preferred_time', 50)->nullable();
                $table->text('notes')->nullable();
                $table->unsignedTinyInteger('status')->default(Status::ACTIVE);
                $table->timestamps();

                $table->index('status');
                $table->index('preferred_date');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_bookings');
        Schema::dropIfExists('agents');
    }
};
