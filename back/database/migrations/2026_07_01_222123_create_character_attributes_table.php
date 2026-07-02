<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained();
            $table->foreignId('character_id')->constrained();
            $table->float('score');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('character_attributes');
    }
};
