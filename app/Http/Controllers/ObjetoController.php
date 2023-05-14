<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjetoController extends Controller
{
    public function create()
    {
        return view('Objeto.form');
    }

    public function store(Request $request)
    {
        
    }
}
