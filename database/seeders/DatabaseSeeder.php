<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Administrador', 'permisos' => 'Gestión total', 'usuario' => 'admin.cauca', 'estado' => 'Activo'],
            ['nombre' => 'Coordinador de formación', 'permisos' => 'Proyectos y fichas', 'usuario' => 'coord.formacion', 'estado' => 'Activo'],
            ['nombre' => 'Instructor', 'permisos' => 'Seguimiento académico', 'usuario' => 'instr.tics', 'estado' => 'En revisión'],
            ['nombre' => 'Aprendiz', 'permisos' => 'Consulta y reportes', 'usuario' => 'aprendiz.2026', 'estado' => 'Activo'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['usuario' => $role['usuario']], $role);
        }
    }
}
