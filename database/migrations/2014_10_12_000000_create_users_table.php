<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('address')->nullable();
            $table->string('cpfcnpj')->nullable();

            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('password');

            $table->longText('wallet')->nullable();
            $table->longText('api_key')->nullable();
            $table->longText('url')->nullable();

            $table->integer('type')->default(4); // 1 - Administrador 2 - Empresa 3 - Colaborador 4 - Cliente
            $table->integer('status')->default(0); // 0 - pendent 1 - active 3 - block

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
