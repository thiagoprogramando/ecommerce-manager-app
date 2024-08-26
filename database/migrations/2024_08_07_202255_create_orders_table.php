<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('name');
            $table->decimal('value', 10, 2);
            $table->integer('status')->default(0); // 0 is pendent 1 is confirmed 2 is payment approved 3 send 4 cancel
            $table->string('payment_method');
            $table->integer('payment_installments');
            $table->string('payment_token');
            $table->longText('payment_url')->nullable();
            $table->longText('tracking_code')->nullable();
            $table->longText('license');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
