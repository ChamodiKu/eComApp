<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->integer('quantity');
            $table->decimal('cost_price');
            $table->decimal('sell_price');
            $table->text('description')->nullable();
            $table->integer('rating')->comment("1-5")->nullable();
            $table->boolean('is_active')->default(1)->comment("1=> Active, 0=> Inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
