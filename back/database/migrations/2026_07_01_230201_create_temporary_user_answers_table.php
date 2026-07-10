<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temporary_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temporary_user_id')->constrained();
            $table->foreignId('attribute_id')->constrained();
            $table->float('answer_score');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('temporary_user_answers');
    }
};
