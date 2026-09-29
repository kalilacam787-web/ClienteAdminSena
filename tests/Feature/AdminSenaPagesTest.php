<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use App\Models\Role;
use Tests\TestCase;

class AdminSenaPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_main_dashboard_is_available(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('AdminSena')
            ->assertSee('Cauca');
    }

    public function test_management_pages_are_available(): void
    {
        $this->get('/computadores')->assertStatus(200);
        $this->get('/aprendices')->assertStatus(200);
        $this->get('/ofertas')->assertStatus(200);
        $this->get('/roles')->assertStatus(200);
        $this->get('/centros')->assertStatus(200);
    }

    public function test_a_computer_can_be_registered(): void
    {
        $response = $this->post('/computadores', [
            'codigo' => 'CMP-999',
            'marca' => 'Dell',
            'modelo' => 'Inspiron 15',
            'serial' => 'DL-999-01',
            'estado' => 'Operativo',
            'sede' => 'Popayán',
        ]);

        $response->assertRedirect('/computadores');
        $this->assertDatabaseHas('computers', ['codigo' => 'CMP-999']);
    }

    public function test_an_apprentice_can_be_registered(): void
    {
        $response = $this->post('/aprendices', [
            'nombre' => 'María López',
            'programa' => 'Análisis y Desarrollo de Software',
            'ficha' => '2458120',
            'centro' => 'Popayán',
            'estado' => 'Activo',
        ]);

        $response->assertRedirect('/aprendices');
        $this->assertDatabaseHas('apprentices', ['ficha' => '2458120']);
    }

    public function test_an_offer_can_be_registered(): void
    {
        $response = $this->post('/ofertas', [
            'nombre' => 'Técnico en Electricidad Industrial',
            'modalidad' => 'Presencial',
            'duracion' => '12 meses',
            'centro' => 'Popayán',
        ]);

        $response->assertRedirect('/ofertas');
        $this->assertDatabaseHas('offers', ['nombre' => 'Técnico en Electricidad Industrial']);
    }

    public function test_a_role_can_be_updated(): void
    {
        $role = Role::create([
            'nombre' => 'Instructor',
            'permisos' => 'Seguimiento académico',
            'usuario' => 'instr.tics',
            'estado' => 'Activo',
        ]);

        $response = $this->put('/roles/'.$role->id, [
            'nombre' => 'Instructor líder',
            'permisos' => 'Seguimiento académico y reportes',
            'usuario' => 'instr.tics',
            'estado' => 'En revisión',
        ]);

        $response->assertRedirect('/roles');
        $this->assertDatabaseHas('roles', ['id' => $role->id, 'nombre' => 'Instructor líder']);
    }

    public function test_comments_from_the_admin_api_are_visible(): void
    {
        Http::fake([
            '127.0.0.1:8001/api/v1/contacts' => Http::response([
                [
                    'name' => 'Ana Gómez',
                    'email' => 'ana@example.com',
                    'message' => 'Quiero información sobre los cursos disponibles.',
                    'status' => 'pending',
                    'created_at' => '2026-09-25T12:00:00.000000Z',
                ],
            ]),
        ]);

        $this->get('/comentarios')
            ->assertOk()
            ->assertSee('Ana Gómez')
            ->assertSee('Quiero información sobre los cursos disponibles.')
            ->assertSee('Pendiente');
    }

    public function test_areas_can_be_fetched_from_the_admin_api(): void
    {
        Http::fake([
            '127.0.0.1:8001/api/v1/areas' => Http::response([
                ['id' => 7, 'name' => 'Área de formación API'],
            ]),
        ]);

        $this->get('/datos-api/areas')
            ->assertOk()
            ->assertSee('Área de formación API');
    }

    public function test_each_main_api_table_has_a_get_page(): void
    {
        Http::fake([
            '127.0.0.1:8001/api/v1/*' => Http::response([]),
        ]);

        $tables = [
            'areas' => 'Áreas',
            'training-centers' => 'Centros de formación',
            'computers' => 'Computadores',
            'courses' => 'Cursos',
            'teachers' => 'Instructores',
            'apprentices' => 'Aprendices',
            'contacts' => 'Comentarios',
            'galleries' => 'Galería',
        ];

        foreach ($tables as $table => $title) {
            $this->get('/datos-api/'.$table)
                ->assertOk()
                ->assertSee($title);
        }
    }

}
