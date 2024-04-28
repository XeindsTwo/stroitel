<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->boolean('availability')->default(true)->after('id');
      $table->string('new_price')->nullable()->after('price');
    });
  }

  public function down(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->dropColumn('availability');
      $table->dropColumn('new_price');
    });
  }
};