<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'marca',
        'modelo',
        'serial',
        'estado',
        'sede',
        'aprendiz_id',
    ];

    public function apprentice(): BelongsTo
    {
        return $this->belongsTo(Apprentice::class, 'aprendiz_id');
    }
}
