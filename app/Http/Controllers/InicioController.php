<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ong;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $ongs = Ong::all();
        return view('Inicio.inicio')
        ->with('ongs', $ongs);
    }
}
