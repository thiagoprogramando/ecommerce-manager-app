<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('url')->nullable();
            $table->string('file');
            $table->longText('license');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('banner');
    }
};
