<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apprentice extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'cedula',
        'programa',
        'ficha',
        'centro',
        'estado',
    ];

    public function computers(): HasMany
    {
        return $this->hasMany(Computer::class, 'aprendiz_id');
    }
}
