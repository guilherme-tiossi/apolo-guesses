<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute_oppositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('opposite_attribute_id')->constrained('attributes')->cascadeOnDelete();
            $table->unique(['attribute_id', 'opposite_attribute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_oppositions');
    }
};
