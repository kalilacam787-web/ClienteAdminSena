<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('serial')->unique();
            $table->string('estado');
            $table->string('sede');
            $table->timestamps();
        });

        Schema::create('apprentices', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('programa');
            $table->string('ficha');
            $table->string('centro');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('modalidad');
            $table->string('duracion');
            $table->string('centro');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('permisos');
            $table->string('usuario')->unique();
            $table->string('estado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('apprentices');
        Schema::dropIfExists('computers');
    }
};