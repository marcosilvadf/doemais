<?php

namespace App\Http\Controllers;

use App\Models\Doador;
use App\Models\Objeto;
use App\Models\Ong;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OngController extends Controller
{
    public function show($id)
    {
        $idUser = session()->get('id');

        $usuario = Usuario::find($idUser);

        if ($usuario && isset($usuario->doador->id)) {
            $doar = true;
        } else {
            $doar = false;
        }
        

        $ong = Ong::find($id);
        return view('Ong.vermais')
        ->with('ong', $ong)
        ->with('doar', $doar);
    }

    public function formDoar($id)
    {
        return view('Ong.form')
        ->with('ong_id', $id);
    }

    public function receberForm(Request $request)
    {
        $arquivo = $request->file('banner');
        $path = $arquivo->store('public/objetos');
        if (!$arquivo) {           
            Session::flash('error', 'Nenhuma foto selecionada!');
            return redirect()->back();
        }

        $path = str_replace('public/objetos', 'storage/objetos', $path);

        $usuario = Doador::where('usuario_id', session()->get('id'))->first();

        $objeto = Objeto::create([
            'doadore_id' => $usuario->id,
            'ong_id' => $request->ong_id,
            'descricao' => $request->descricao . " img='$path'",
            'estado' => '0'
        ]);

        return redirect()->route('log.perfil');
    }

    public function enviado($id)
    {
        $obj = Objeto::find($id);
        $obj->update(['estado' => 1]);
        return redirect()->route('log.perfil');
    }

    public function recebido($id)
    {
        $obj = Objeto::find($id);
        $obj->update(['estado' => 2]);
        return redirect()->route('log.perfil');
    }

    public function deletar($id)
    {
        $obj = Objeto::find($id);
        $obj->delete();
        return redirect()->route('log.perfil');
    }
}
