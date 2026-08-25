<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->string('question');
            $table->string('portuguese_question');
            $table->boolean('is_initial_question')->default(false);
            $table->boolean('is_secondary_question')->default(false);
            $table->string('internal_name')->nullable()->unique();
            $table->foreignId('character_id')->nullable();
            $table->unique(['question']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
