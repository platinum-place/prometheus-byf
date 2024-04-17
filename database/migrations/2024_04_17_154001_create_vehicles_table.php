<?php

use App\Enums\Vehicle\VehicleTypeEnum;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('color')->nullable();
            $table->string('identification')->nullable()->unique();
            $table->string('plate')->nullable();
            $table->integer('year')->nullable();
            $table->string('chassis')->nullable()->unique();
            $table->foreignIdFor(VehicleMake::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(VehicleModel::class)->constrained()->cascadeOnDelete();
            $table->enum('type', VehicleTypeEnum::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
