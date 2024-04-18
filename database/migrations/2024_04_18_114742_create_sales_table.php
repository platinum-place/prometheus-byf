<?php

use App\Enums\Invoice\SaleTypeEnum;
use App\Models\Customer\Contact;
use App\Models\Customer\Customer;
use App\Models\Supplier\Agent;
use App\Models\Supplier\Product;
use App\Models\Supplier\Supplier;
use App\Models\Vehicle\Vehicle;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->enum('type', SaleTypeEnum::values());
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Agent::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Contact::class)->constrained()->cascadeOnDelete();
            $table->text('note')->nullable();

            /**
             * Vehicle
             */
            $table->foreignIdFor(Vehicle::class)->nullable()->constrained()->cascadeOnDelete();
            $table->text('site_a')->nullable();
            $table->text('site_b')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
