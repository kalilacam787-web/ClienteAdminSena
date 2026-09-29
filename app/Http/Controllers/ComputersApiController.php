<?php

namespace App\Http\Controllers;

class ComputersApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('computers', 'Computadores', ['id' => 'ID', 'number' => 'Código', 'brand' => 'Marca', 'assigned_name' => 'Asignado a']);
    }
}
