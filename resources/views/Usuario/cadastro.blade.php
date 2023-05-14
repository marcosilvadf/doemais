@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Cadastrar Usuário
@endsection

@section('body')
    @if (!(isset($usuario->nome)))
    <form action="{{route('log.cadastrar')}}" method="post" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
    @else
    <form action="{{route('log.editar')}}" method="post" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
        <input type="hidden" name="id" value="{{$usuario->id}}">
    @endif
        @csrf
        <label for="banner" style="display: flex; flex-direction: column; align-items: center">
            <img src="{{asset('svg/profile.svg')}}" alt="" class="inputBanner" required>
            <h3 id="nameImage">Selecione uma imagem</h3>
        </label>
        <input type="file" name="banner" id="banner" accept=".jpg, .png, .jpeg">
        <input type="text" name="nome" id="" placeholder="Nome:" required value="{{$usuario->nome ?? ''}}">
        <input type="email" name="email" id="" placeholder="E-mail:" required value="{{$usuario->email ?? ''}}">
        
        @if ($ong)
            <div class="password irow">
                <input type="text" name="cnpj" id="" placeholder="CNPJ:" required value="{{$usuario->ong->cnpj ?? ''}}">
                <input type="text" name="razao_social" id="" placeholder="Razão Social:" required value="{{$usuario->ong->razao_social ?? ''}}">
            </div>
            
            <select name="categoria" id="">
                <option value="" disabled selected>Selecione uma categoria</option>
                @foreach ($categorias as $categoria)                
                    <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
                @endforeach
            </select>
            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição:" required>{{$usuario->ong->descricao ?? ''}}</textarea>

            <div class="password irow">
                <input type="text" name="CEP" id="" placeholder="CEP:" required value="{{$usuario->endereco->CEP ?? ''}}">
                <input type="text" name="estado" id="" placeholder="Estado:" required value="{{$usuario->endereco->estado ?? ''}}">
            </div>

            <div class="password irow">
                <input type="text" name="cidade" id="" placeholder="Cidade:" required value="{{$usuario->endereco->cidade ?? ''}}">
                <input type="text" name="bairro" id="" placeholder="Bairro:" required value="{{$usuario->endereco->bairro ?? ''}}">
            </div>
            <div class="password irow">
                <input type="text" name="logradouro" id="" placeholder="Logradouro:" required value="{{$usuario->endereco->logradouro ?? ''}}">
                <input type="text" name="rua" id="" placeholder="Rua:" required value="{{$usuario->endereco->rua ?? ''}}">
                <input type="number" name="numero" id="" placeholder="Numero:" required value="{{$usuario->endereco->numero ?? ''}}">
            </div>
        @endif
        
        <input type="text" name="telefone" id="" placeholder="Telefone:" required value="{{$usuario->telefone->numero ?? ''}}">
        @if (!(isset($usuario->nome)))
            <div class="irow">
                <div class="password irow">
                    <input type="password" name="senha" id="pass1" placeholder="Senha:" required>
                    <img src="{{asset('svg/olhoaberto.svg')}}" class="pass1">          
                </div>
                
                <div class="password irow">
                    <input type="password" name="" id="confirmpass" placeholder="Confirme sua senha:" required>
                    <img src="{{asset('svg/olhoaberto.svg')}}" class="confirmpass">          
                </div>
            </div>
        @endif        

        <button>
            <span>Cadastrar</span>
            <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
            </svg>
          </button>
            @if (!(isset($usuario->nome)))
                <a href="{{route('log.login')}}">Já tem login? Clique aqui</a>                
                <a href="1">É uma ong? Clique aqui</a>
            @endif     
    </form>
@endsection

@section('js')    
<script src="{{asset('js/form.js')}}"></script>
@endsection