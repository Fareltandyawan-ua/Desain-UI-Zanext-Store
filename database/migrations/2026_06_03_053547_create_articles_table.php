<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->text('excerpt');
            $table->longText('content')->nullable();
            $table->string('image');
            $table->string('category');
            $table->string('date');
            $table->string('author');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
