<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  public function up(): void
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('article')->unique();
      $table->string('name');
      $table->string('price');
      $table->text('description');
      $table->string('image_path');
      $table->unsignedBigInteger('category_id');
      $table->unsignedBigInteger('subcategory_id')->nullable();
      $table->timestamps();

      $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
      $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('products');
  }
}