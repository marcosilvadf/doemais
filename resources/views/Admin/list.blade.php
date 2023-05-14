@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Ver mais
@endsection

@section('body')
    <div class="admin">
        <div class="doadores">
            @foreach ($doadores as $doador)
            <?php
                $imgSrc = str_replace('public/profiles', 'storage/profiles', $doador->usuario->imagem);
            ?>
                <div class="row">
                    <img src="{{asset($imgSrc)}}" class="img">
                    <h4>{{$doador->usuario->nome}}</h4>
                </div>
            @endforeach
        </div>
        
        <div class="ongs">
            @foreach ($ongs as $ong)
            <?php
                $imgSrc = str_replace('public/profiles', 'storage/profiles', $ong->usuario->imagem);
            ?>
                <div class="row">
                    <img src="{{asset($imgSrc)}}" class="img">
                    <h4>{{$ong->usuario->nome}}</h4>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
@endsection