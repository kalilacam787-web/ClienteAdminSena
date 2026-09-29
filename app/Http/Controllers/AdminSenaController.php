<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Apprentice;
use App\Models\Offer;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminSenaController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Computadores registrados', 'value' => Computer::count(), 'trend' => 'en inventario'],
            ['label' => 'Aprendices activos', 'value' => Apprentice::where('estado', 'Activo')->count(), 'trend' => 'en formación'],
            ['label' => 'Ofertas vigentes', 'value' => Offer::count(), 'trend' => 'registradas'],
            ['label' => 'Roles actualizados', 'value' => Role::count(), 'trend' => 'perfiles'],
        ];

        $centers = [
            ['name' => 'SENA Regional Cauca', 'municipio' => 'Popayán', 'direccion' => 'Cra. 5 # 4-80', 'telefono' => '+57 602 823 8300'],
            ['name' => 'Centro de Formación Agroindustrial', 'municipio' => 'Popayán', 'direccion' => 'Km 3 vía a Timbío', 'telefono' => '+57 602 820 0000'],
            ['name' => 'Centro de Formación en Diseño y Manufactura', 'municipio' => 'Popayán', 'direccion' => 'Autopista a la Sabana', 'telefono' => '+57 602 824 0101'],
            ['name' => 'Centro de Formación para la Industria y la Construcción', 'municipio' => 'Santander de Quilichao', 'direccion' => 'Calle 10 # 8-30', 'telefono' => '+57 602 820 0202'],
        ];

        return view('home', compact('stats', 'centers'));
    }

    public function computadores()
    {
        $computers = Computer::orderBy('codigo')->get();

        return view('computadores', compact('computers'));
    }

    public function guardarComputador(Request $request)
    {
        $data = $request->validate([
            'codigo' => ['required', 'string', 'max:255', 'unique:computers,codigo'],
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255', 'unique:computers,serial'],
            'estado' => ['required', 'in:Operativo,En mantenimiento,Disponible,En revisión'],
            'sede' => ['required', 'in:Popayán,Santander de Quilichao,Puerto Tejada'],
        ]);

        Computer::create($data);

        return redirect()->route('computadores')->with('success', 'Computador registrado correctamente.');
    }

    public function aprendices()
    {
        $apprentices = Apprentice::orderBy('nombre')->get();

        return view('aprendices', compact('apprentices'));
    }

    public function guardarAprendiz(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'programa' => ['required', 'string', 'max:255'],
            'ficha' => ['required', 'string', 'max:50'],
            'centro' => ['required', 'in:Popayán,Santander de Quilichao,Puerto Tejada'],
            'estado' => ['required', 'in:Activo,En prórroga,Formación,Finalizado'],
        ]);

        Apprentice::create($data);

        return redirect()->route('aprendices')->with('success', 'Aprendiz registrado correctamente.');
    }

    public function ofertas()
    {
        $offers = Offer::orderBy('nombre')->get();

        return view('ofertas', compact('offers'));
    }

    public function guardarOferta(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'modalidad' => ['required', 'in:Virtual,Presencial,Mixto,Dual,Híbrida'],
            'duracion' => ['required', 'string', 'max:100'],
            'centro' => ['required', 'in:Popayán,Santander de Quilichao,Puerto Tejada'],
        ]);

        Offer::create($data);

        return redirect()->route('ofertas')->with('success', 'Oferta registrada correctamente.');
    }

    public function roles()
    {
        $roles = Role::orderBy('nombre')->get();

        return view('roles', compact('roles'));
    }

    public function actualizarRol(Request $request, Role $role)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'permisos' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255', 'unique:roles,usuario,'.$role->id],
            'estado' => ['required', 'in:Activo,En revisión,Inactivo'],
        ]);

        $role->update($data);

        return redirect()->route('roles')->with('success', 'Rol actualizado correctamente.');
    }

    public function centros()
    {
        $centers = [
            ['nombre' => 'SENA Regional Cauca', 'municipio' => 'Popayán', 'direccion' => 'Cra. 5 # 4-80', 'telefono' => '+57 602 823 8300', 'latitud' => '2.4422', 'longitud' => '-76.6066'],
            ['nombre' => 'Centro de Formación Agroindustrial', 'municipio' => 'Popayán', 'direccion' => 'Km 3 vía a Timbío', 'telefono' => '+57 602 820 0000', 'latitud' => '2.4428', 'longitud' => '-76.6115'],
            ['nombre' => 'Centro de Formación en Diseño y Manufactura', 'municipio' => 'Popayán', 'direccion' => 'Autopista a la Sabana', 'telefono' => '+57 602 824 0101', 'latitud' => '2.4384', 'longitud' => '-76.5844'],
            ['nombre' => 'Centro de Formación para la Industria y la Construcción', 'municipio' => 'Santander de Quilichao', 'direccion' => 'Calle 10 # 8-30', 'telefono' => '+57 602 820 0202', 'latitud' => '3.0002', 'longitud' => '-76.4845'],
            ['nombre' => 'Centro de Formación de la Moda', 'municipio' => 'Puerto Tejada', 'direccion' => 'Diagonal 15 # 12-35', 'telefono' => '+57 602 820 0303', 'latitud' => '2.9559', 'longitud' => '-76.4244'],
        ];

        return view('centros', compact('centers'));
    }
}
