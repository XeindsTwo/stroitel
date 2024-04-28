<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('services', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->string('phone');
      $table->text('question')->nullable();
      $table->string('service_type');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('services');
  }
};