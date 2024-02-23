<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('partnership_requests', function (Blueprint $table) {
      $table->id();
      $table->string('email');
      $table->string('organization_name');
      $table->string('phone');
      $table->text('comment')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('partnership_requests');
  }
};