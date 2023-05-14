@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Recuperar senha
@endsection

@section('body')
<form action="{{route('log.recovery')}}" method="post" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
        @csrf
        <input type="email" name="email" id="" placeholder="E-mail:" required>
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

        <button>
            <span>Entrar</span>
            <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
            </svg>
          </button>
          <a href="cadastrar/0">Não tem cadastro? Clique aqui</a>
    </form>
@endsection

@section('js')
<script src="{{asset('js/form.js')}}"></script>
@endsection