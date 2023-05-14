<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Doador;
use App\Models\Endereco;
use App\Models\Objeto;
use App\Models\Ong;
use App\Models\Telefone;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ong)
    {
        $categorias = Categoria::all();
        return view('Usuario.cadastro')
        ->with('categorias', $categorias)
        ->with('ong', $ong);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = Usuario::where('email', $request->email)
        ->first();

        if ($usuario) {
            Session::flash('error', 'E-mail já cadastrado!');
            return redirect()->back();
        }

        $arquivo = $request->file('banner');

        if (!$arquivo) {
            Session::flash('error', 'Sem foto de perfil!');
            return redirect()->back();
        }

        $path = $arquivo->store('public/profiles');
        \DB::beginTransaction();

        try {
            $usuario = [
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => $request->senha,
                'imagem' => $path
            ];
            $resUsuario = Usuario::create($usuario);
            
            if (isset($request->cnpj) && $request->cnpj != null) {
                $ong = [
                    'cnpj' => $request->cnpj,
                    'razao_social' => $request->razao_social,
                    'usuario_id' => $resUsuario->id,
                    'categoria_id' => $request->categoria,
                    'descricao' => $request->descricao,
                ];
                $resOng = Ong::create($ong);
    
                $endereco = [
                    'usuario_id' => $resUsuario->id,
                    'CEP' => $request->CEP,
                    'estado' => $request->estado,
                    'cidade' => $request->cidade,
                    'bairro' => $request->bairro,
                    'logradouro' => $request->logradouro,
                    'rua' => $request->rua,
                    'numero' =>$request->numero
                ];
                $resEndereco = Endereco::create($endereco);
            } else {
                $doador = [
                    'usuario_id' => $resUsuario->id
                ];
                $resDoador = Doador::create($doador);
            }
            

            $telefone = [
                'usuario_id' => $resUsuario->id,
                'numero' => $request->telefone
            ];
            $resTelefone = Telefone::create($telefone);

            \DB::commit();
            $nome = "logado";
            $usuario['id'] = $resUsuario->id;
            $valor = json_encode($usuario);
            $dataExpira = time() + (30 * 24 * 60 * 60); // 30 dias em segundos

            setcookie($nome, $valor, $dataExpira, "/");
            return redirect()->route('inicio');
        } catch (\Exception $e) {
            \DB::rollback();
            return 'ERRO: '.$e->getMessage();
        }        
        return $resUsuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usuario = Usuario::find(session()->get('id'));
        $usuario->update(['nome' => $request->nome, 'email' => $request->email]);
        return redirect()->route('log.perfil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login()
    {
        if(false) 
        {
            return $_COOKIE['logado'];
        }
        return view('Usuario.login');
    }   

    public function createLogin(Request $request)
    {
        $usuario = Usuario::where('email', $request->email)
        ->where('senha', $request->senha)
        ->first();

        if (!$usuario) {               
            Session::flash('error', 'E-mail e/ou senha incorreta!');
            return redirect()->back();         
        }

        if ($usuario->id == getenv('ID_ADMIN')) {
            session()->put('admin', true);
            return redirect()->route('admin');         
        }
                
        $nome = "logado";
        $valor = json_encode($usuario);
        $dataExpira = time() + (30 * 24 * 60 * 60); // 30 dias em segundos

        setcookie($nome, $valor, $dataExpira, "/");
        return redirect()->route('inicio');
    }

    public function perfil()
    {   
        $id = session()->get('id');
        $usuario = Usuario::find($id);

        if (isset($usuario->ong->id)) {            
            $usuario = Ong::where('usuario_id', $id)->first();
        } else {
            $usuario = Doador::where('usuario_id', $id)->first();
        }
        

        $objetos = Objeto::where('doadore_id', $usuario->id)->get();
        $usuario = Usuario::find($id);
        return view('Usuario.perfil')
        ->with('objetos', $objetos)
        ->with('usuario', $usuario);
    }

    public function deslogar()
    {
        $nome = "logado";
        $valor = json_encode('');
        $dataExpira = time() + -3600; // -1 hora

        setcookie($nome, $valor, $dataExpira, "/");
        session()->forget('imagem');
        session()->forget('id');
        return redirect()->route('inicio');
    }

    public function edtUser($id)
    {
        $usuario = Usuario::find($id);
        
        $categorias = Categoria::all();

        if (isset($usuario->ong->cnpj)) {
            $ong = true;
        } else {
            $ong = false;            
        }
        

        return view('Usuario.cadastro')
        ->with('categorias', $categorias)
        ->with('usuario', $usuario)
        ->with('ong', $ong);
    }

    public function deletar()
    {
        $userId = session()->get('id');
        $usuario = Usuario::find($userId);
        $telefone = Telefone::where('usuario_id', $userId)->first();
        $endereco = Endereco::where('usuario_id', $userId)->first();
        $Ong = Ong::where('usuario_id', $userId)->first();
        $doador = Doador::where('usuario_id', $userId)->first();                

        \DB::beginTransaction();

        try {
            if (isset($Ong->cnpj))
            {
                $Ong->delete();
            } elseif (isset($doador->usuario_id))
            {
                $doador->delete();            
            }
            else{

            }

            if (isset($telefone->numero))
            {
                $telefone->delete();
            } 

            if (isset($endereco->CEP))
            {
                $endereco->delete();
            } 

            $usuario->delete();

            \DB::commit();
            return redirect()->route('log.deslogar');
        } catch (\Exception $e) {
            \DB::rollback();
            return 'ERRO: '.$e->getMessage();
        }                    
    }

    public function recuperarSenhaForm()
    {
        return view('Usuario.recovery');
    }

    public function recuperarSenha(Request $request)
    {
        $usuario = Usuario::where('email', $request->email)
        ->first();

        if (!$usuario) {               
            Session::flash('error', 'E-mail não cadastrado!');
            return redirect()->back();         
        }

        $usuario->update(['senha' => $request->senha]);$nome = "logado";
        $valor = json_encode($usuario);
        $dataExpira = time() + (30 * 24 * 60 * 60); // 30 dias em segundos

        setcookie($nome, $valor, $dataExpira, "/");
        return redirect()->route('inicio');
    }

    public function listAll()
    {
        if (session()->get('admin') == null)
        {
            Session::flash('error', 'você não é administrador');
            return redirect()->route('log.login');
        }
        $doadores = Doador::all();
        $ongs = Ong::all();
        return view('Admin.list')
        ->with('doadores', $doadores)
        ->with('ongs', $ongs);
    }
}