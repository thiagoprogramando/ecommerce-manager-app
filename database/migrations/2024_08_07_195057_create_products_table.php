<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('value', 10, 2);
            $table->integer('qtd');
            $table->string('ean')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('group')->nullable();
            $table->string('size')->nullable();
            $table->integer('type')->default(0); // 0 - Físico 1 - Digital 2 - Serviço
            $table->integer('status')->default(2); // 1 - Disponível 2 - Pendente 3 - Bloqueado 4 - Sem estoque
            $table->longText('license');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
