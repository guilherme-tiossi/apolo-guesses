<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->string('signature_question')->nullable()->after('character_category_id');
            $table->string('signature_portuguese_question')->nullable()->after('signature_question');
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn(['signature_question', 'signature_portuguese_question']);
        });
    }
};
