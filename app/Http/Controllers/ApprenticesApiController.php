<?php

namespace App\Http\Controllers;

class ApprenticesApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('apprentices', 'Aprendices', ['id' => 'ID', 'name' => 'Nombre', 'last_name' => 'Apellido', 'course_id' => 'Curso', 'computer_id' => 'Computador']);
    }
}
