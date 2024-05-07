<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  public function up(): void
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->string('name');
      $table->string('phone_number');
      $table->string('email');
      $table->string('delivery_address')->nullable();
      $table->text('comment')->nullable();
      $table->enum('delivery_option', ['pickup', 'delivery'])->default('pickup');
      $table->enum('payment_option', ['cash', 'non-cash'])->default('cash');
      $table->bigInteger('total_price')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('orders');
  }
}