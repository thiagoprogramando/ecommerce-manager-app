<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->decimal('value', 8, 2);
            $table->longText('payment_token')->nullable();
            $table->integer('status')->default(0); // 0 is pendent 1 is used
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('discount');
    }
};
