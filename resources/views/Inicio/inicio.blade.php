@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
@endsection

@section('title')
    Início
@endsection

@section('body')
    @foreach ($ongs as $ong)
    <div class="oneOng">
        <?php
            $imagem = str_replace('public/profiles', 'storage/profiles', $ong->usuario->imagem)
        ?>
        <div class="profile">
            <img src="{{$imagem}}" alt="">
        </div>
        
        <div class="info" onclick="window.location.href = '{{route('ong.show', ['id' => $ong->id])}}'">
            <h2>{{$ong->usuario->nome}}</h2>
            <span>{{$ong->categoria->descricao}}</span>
            <p>{{$ong->descricao}}</p>
        </div>
    </div>       
    @endforeach
@endsection

@section('js')
@endsection