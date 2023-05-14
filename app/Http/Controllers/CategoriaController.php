<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create()
    {
       return view('Categoria.form');
    }

    public function store(Request $request)
    {
        $categoria = [
            'descricao' => $request->descricao
        ];

        $resCategoria = Categoria::create($categoria);
        return $resCategoria;
    }
}
