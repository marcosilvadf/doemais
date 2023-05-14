<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;    

    protected $fillable = [
        'nome', 'email', 'senha', 'imagem'
    ];

    public function ong()
    {
        return $this->hasOne(Ong::class);
    }
    
    public function doador()
    {
        return $this->hasOne(Doador::class);
    }
    
    public function telefone()
    {
        return $this->hasOne(Telefone::class);
    }
    
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
