<?php

namespace App\Http\Controllers;

class TeachersApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('teachers', 'Instructores', ['id' => 'ID', 'name' => 'Nombre', 'area_id' => 'Área', 'training_center_id' => 'Centro']);
    }
}
