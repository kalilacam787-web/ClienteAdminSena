<?php

namespace App\Http\Controllers;

class TrainingCentersApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('training-centers', 'Centros de formación', ['id' => 'ID', 'name' => 'Nombre', 'location' => 'Ubicación']);
    }
}
