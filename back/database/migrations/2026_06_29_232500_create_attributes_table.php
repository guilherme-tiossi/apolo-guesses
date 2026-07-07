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
            $table->foreignId('attribute_subgroup_id')->constrained();
            $table->string('question');
            $table->string('portuguese_question');
            $table->boolean('is_initial_question')->default(false);
            $table->string('internal_name')->nullable()->unique();
            $table->unique(['attribute_subgroup_id', 'question']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
