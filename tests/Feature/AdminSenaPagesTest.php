<?php

namespace Tests\Feature;

use App\Models\Apprentice;
use App\Models\Computer;
use App\Models\Offer;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
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

        $this->get('/dashboard')->assertOk();
    }

    public function test_management_pages_are_available(): void
    {
        $this->get('/computadores')->assertOk()
            ->assertSee('Aprendiz responsable')
            ->assertSee('Marca')
            ->assertSee('ID');
        $this->get('/aprendices')->assertOk()
            ->assertSee('Primer apellido')
            ->assertSee('Segundo apellido')
            ->assertSee('Número de cédula')
            ->assertSee('Número de ficha');
        $this->get('/ofertas')->assertStatus(200);
        $this->get('/roles')->assertStatus(200);
        $this->get('/centros')->assertStatus(200);
    }

    public function test_a_computer_can_be_registered(): void
    {
        $apprentice = Apprentice::create([
            'nombre' => 'Camila',
            'apellido1' => 'Rojas',
            'apellido2' => 'Pérez',
            'cedula' => '1000000001',
            'programa' => 'Desarrollo de software',
            'ficha' => '2458120',
            'centro' => 'Popayán',
            'estado' => 'Activo',
        ]);

        $response = $this->post('/computadores', [
            'codigo' => 'CMP-999',
            'marca' => 'Dell',
            'modelo' => 'Inspiron 15',
            'serial' => 'DL-999-01',
            'estado' => 'Operativo',
            'sede' => 'Popayán',
            'aprendiz_id' => $apprentice->id,
        ]);

        $response->assertRedirect('/computadores');
        $this->assertDatabaseHas('computers', [
            'codigo' => 'CMP-999',
            'marca' => 'Dell',
            'aprendiz_id' => $apprentice->id,
        ]);

        $computer = Computer::where('codigo', 'CMP-999')->firstOrFail();
        $this->get('/computadores')
            ->assertSee((string) $computer->id)
            ->assertSee('Dell')
            ->assertSee('Camila Rojas Pérez');
    }

    public function test_a_computer_can_be_registered_without_an_apprentice(): void
    {
        $this->post('/computadores', [
            'codigo' => 'CMP-UNASSIGNED',
            'marca' => 'Dell',
            'modelo' => 'Latitude',
            'serial' => 'DL-UNASSIGNED',
            'estado' => 'Disponible',
            'sede' => 'Popayán',
            'aprendiz_id' => '',
        ])->assertRedirect('/computadores');

        $this->assertDatabaseHas('computers', [
            'codigo' => 'CMP-UNASSIGNED',
            'aprendiz_id' => null,
        ]);

        $this->from('/computadores')->post('/computadores', [
            'codigo' => 'CMP-INVALID-OWNER',
            'marca' => 'Dell',
            'modelo' => 'Latitude',
            'serial' => 'DL-INVALID-OWNER',
            'estado' => 'Disponible',
            'sede' => 'Popayán',
            'aprendiz_id' => 999,
        ])->assertSessionHasErrors('aprendiz_id');

        $this->assertDatabaseMissing('computers', ['codigo' => 'CMP-INVALID-OWNER']);
    }

    public function test_an_apprentice_can_be_registered(): void
    {
        $response = $this->post('/aprendices', [
            'nombre' => 'María',
            'apellido1' => 'López',
            'apellido2' => 'Gómez',
            'cedula' => '1000000002',
            'programa' => 'Análisis y Desarrollo de Software',
            'ficha' => '2458120',
            'centro' => 'Popayán',
            'estado' => 'Activo',
        ]);

        $response->assertRedirect('/aprendices');
        $this->assertDatabaseHas('apprentices', [
            'ficha' => '2458120',
            'nombre' => 'María',
            'apellido1' => 'López',
            'apellido2' => 'Gómez',
            'cedula' => '1000000002',
        ]);
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

    public function test_main_records_can_be_updated_and_deleted(): void
    {
        $apprentice = Apprentice::create([
            'nombre' => 'Laura',
            'apellido1' => 'Mora',
            'apellido2' => 'Díaz',
            'cedula' => '1000000003',
            'programa' => 'Software',
            'ficha' => '1001',
            'centro' => 'Popayán',
            'estado' => 'Activo',
        ]);
        $computer = Computer::create([
            'codigo' => 'CMP-100',
            'marca' => 'Dell',
            'modelo' => 'Latitude',
            'serial' => 'SER-100',
            'estado' => 'Operativo',
            'sede' => 'Popayán',
            'aprendiz_id' => $apprentice->id,
        ]);
        $offer = Offer::create([
            'nombre' => 'Programa inicial',
            'modalidad' => 'Presencial',
            'duracion' => '12 meses',
            'centro' => 'Popayán',
        ]);
        $role = Role::create([
            'nombre' => 'Consulta',
            'permisos' => 'Lectura',
            'usuario' => 'consulta.test',
            'estado' => 'Activo',
        ]);

        $this->put('/computadores/'.$computer->id, [
            'codigo' => 'CMP-100',
            'marca' => 'Lenovo',
            'modelo' => 'ThinkPad',
            'serial' => 'SER-100',
            'estado' => 'Disponible',
            'sede' => 'Popayán',
            'aprendiz_id' => $apprentice->id,
        ])->assertRedirect('/computadores');
        $this->assertDatabaseHas('computers', ['id' => $computer->id, 'marca' => 'Lenovo']);

        $this->put('/aprendices/'.$apprentice->id, [
            'nombre' => 'Laura',
            'apellido1' => 'Mora',
            'apellido2' => 'Díaz',
            'cedula' => '1000000003',
            'programa' => 'Desarrollo de software',
            'ficha' => '1001',
            'centro' => 'Popayán',
            'estado' => 'Activo',
        ])->assertRedirect('/aprendices');
        $this->assertDatabaseHas('apprentices', ['id' => $apprentice->id, 'programa' => 'Desarrollo de software']);

        $this->put('/ofertas/'.$offer->id, [
            'nombre' => 'Programa actualizado',
            'modalidad' => 'Virtual',
            'duracion' => '10 meses',
            'centro' => 'Popayán',
        ])->assertRedirect('/ofertas');
        $this->assertDatabaseHas('offers', ['id' => $offer->id, 'nombre' => 'Programa actualizado']);

        $this->post('/roles', [
            'nombre' => 'Administrador',
            'permisos' => 'Gestión total',
            'usuario' => 'admin.test',
            'estado' => 'Activo',
        ])->assertRedirect('/roles');
        $this->assertDatabaseHas('roles', ['usuario' => 'admin.test']);

        $this->delete('/aprendices/'.$apprentice->id)->assertRedirect('/aprendices');
        $this->assertDatabaseHas('computers', ['id' => $computer->id, 'aprendiz_id' => null]);
        $this->put('/computadores/'.$computer->id, [
            'codigo' => 'CMP-100',
            'marca' => 'Lenovo',
            'modelo' => 'ThinkPad',
            'serial' => 'SER-100',
            'estado' => 'Disponible',
            'sede' => 'Popayán',
            'aprendiz_id' => '',
        ])->assertRedirect('/computadores');

        $this->delete('/computadores/'.$computer->id)->assertRedirect('/computadores');
        $this->delete('/ofertas/'.$offer->id)->assertRedirect('/ofertas');
        $this->delete('/roles/'.$role->id)->assertRedirect('/roles');

        $this->assertDatabaseMissing('computers', ['id' => $computer->id]);
        $this->assertDatabaseMissing('apprentices', ['id' => $apprentice->id]);
        $this->assertDatabaseMissing('offers', ['id' => $offer->id]);
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
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
