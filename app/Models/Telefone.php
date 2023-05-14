<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'numero'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
