@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Ver mais
@endsection

@section('body')
<?php
$imgSrc = str_replace('public/profiles', 'storage/profiles', $ong->usuario->imagem)
?>
    <div class="perfil"><img src='{{asset("$imgSrc")}}' alt="">
        <h2>{{$ong->usuario->nome}}</h2>
        <span class="categoria">{{$ong->categoria->descricao}}</span>
        <p>{{$ong->descricao}}</p>
    </div>

    <div>
        @if ($doar)
            <button onclick='window.location.href = "doar/{{$ong->id}}"'>
                <span>Fazer uma doação</span>
                <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
                <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
                </svg>
            </button>
        @endif
    </div>
@endsection

@section('js')    
    <script src="{{asset('js/form.js')}}"></script>
@endsection