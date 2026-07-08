<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('brand');
            $table->integer('price');
            $table->integer('old_price')->nullable();
            $table->decimal('rating', 2, 1);
            $table->string('image');
            $table->string('tag')->nullable();
            $table->string('category');
            $table->text('description')->nullable();
            $table->integer('stock')->default(50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
