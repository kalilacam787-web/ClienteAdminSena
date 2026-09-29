<?php

namespace App\Http\Controllers;

class GalleriesApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('galleries', 'Galería', ['id' => 'ID', 'title' => 'Título', 'image_path' => 'Imagen', 'description' => 'Descripción', 'is_active' => 'Activa', 'order' => 'Orden']);
    }
}
