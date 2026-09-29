<?php

namespace App\Http\Controllers;

class CoursesApiController extends ExternalApiReadController
{
    public function index()
    {
        return $this->fetchTable('courses', 'Cursos', ['id' => 'ID', 'course_number' => 'Ficha', 'name' => 'Programa', 'day' => 'Días', 'schedule' => 'Horario', 'duration_months' => 'Duración (meses)', 'area_id' => 'Área', 'training_center_id' => 'Centro']);
    }
}
