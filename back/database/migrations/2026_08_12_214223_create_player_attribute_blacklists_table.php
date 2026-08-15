<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_attribute_blacklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->foreignId('attribute_id')->constrained();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('player_attribute_blacklists');
    }
};
