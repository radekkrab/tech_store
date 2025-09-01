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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ["deposit","withdraw","purchase","refund"]);
            $table->enum('status', ["pending","completed","failed"]);
            $table->float('amount');
            $table->string('description');
            $table->foreignId('user_id');
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->foreignId('balance_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
