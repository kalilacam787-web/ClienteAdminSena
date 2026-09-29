<?php

namespace App\Http\Controllers;

class ContactsApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('contacts', 'Comentarios', ['id' => 'ID', 'name' => 'Nombre', 'message' => 'Comentario', 'status' => 'Estado', 'created_at' => 'Fecha']);
    }
}
