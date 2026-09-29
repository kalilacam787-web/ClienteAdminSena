<?php

namespace App\Http\Controllers;

class AreasApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('areas', 'Áreas', ['id' => 'ID', 'name' => 'Nombre']);
    }
}
