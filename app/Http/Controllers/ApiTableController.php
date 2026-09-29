<?php

namespace App\Http\Controllers;

class ApiTableController extends Controller
{
    private array $tables = [
        'areas' => AreasApiController::class,
        'training-centers' => TrainingCentersApiController::class,
        'computers' => ComputersApiController::class,
        'courses' => CoursesApiController::class,
        'teachers' => TeachersApiController::class,
        'apprentices' => ApprenticesApiController::class,
        'contacts' => ContactsApiController::class,
        'galleries' => GalleriesApiController::class,
    ];

    public function index(string $table)
    {
        abort_unless(isset($this->tables[$table]), 404);

        $controller = $this->tables[$table];

        return app($controller)->index();
    }
}