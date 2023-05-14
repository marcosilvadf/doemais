@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Login
@endsection

@section('body')
<form action="{{route('log.login')}}" method="post" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
        @csrf
        <input type="email" name="email" id="" placeholder="E-mail:" required>
        <div class="password irow">
            <input type="password" name="senha" id="pass1" placeholder="Senha:" required>
            <img src="{{asset('svg/olhoaberto.svg')}}" class="pass1">          
        </div>        

        <button>
            <span>Entrar</span>
            <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
            </svg>
          </button>
          <a href="cadastrar/0">Não tem cadastro? Clique aqui</a>
          <a href="{{route('log.recovery')}}">Esqueceu a senha? Clique aqui</a>
    </form>
@endsection

@section('js')
@endsection