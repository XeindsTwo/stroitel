<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->text('comment');
      $table->unsignedInteger('rating');
      $table->boolean('status')->default(false);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
};
