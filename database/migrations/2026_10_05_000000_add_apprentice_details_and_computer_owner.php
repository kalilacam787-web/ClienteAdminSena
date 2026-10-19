<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('apprentices', function (Blueprint $table) {
            $table->string('apellido1')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('cedula')->nullable()->unique();
        });

        Schema::table('computers', function (Blueprint $table) {
            $table->foreignId('aprendiz_id')->nullable()->constrained('apprentices')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('aprendiz_id');
        });

        Schema::table('apprentices', function (Blueprint $table) {
            $table->dropUnique(['cedula']);
            $table->dropColumn(['apellido1', 'apellido2', 'cedula']);
        });
    }
};