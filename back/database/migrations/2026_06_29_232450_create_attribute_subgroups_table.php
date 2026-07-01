<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute_subgroups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('attribute_group_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_subgroups');
    }
};
