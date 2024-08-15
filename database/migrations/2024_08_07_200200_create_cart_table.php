<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('name');
            $table->decimal('value', 8, 2);
            $table->longText('token_pay')->nullable();
            $table->integer('status')->default(0); // 0 is pendent 1 - payment confirmed 2 - payment pendent 3  payment canceled 4 - payment default
            $table->longText('license');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cart');
    }
};
