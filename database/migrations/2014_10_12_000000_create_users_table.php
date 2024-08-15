<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('address')->nullable();
            $table->string('cpfcnpj');

            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->longText('wallet')->nullable();
            $table->longText('api_key')->nullable();

            $table->integer('type')->default(2); // 1 - Administrador 2 - Empresa 3 - Colaborador 
            $table->integer('status')->default(0); // 0 - pendent 1 - active 3 - block

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
