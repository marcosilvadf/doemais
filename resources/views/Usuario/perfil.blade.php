@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="{{asset('css/perfil.css')}}">
    <link rel="stylesheet" href="{{asset('css/button.css')}}">
@endsection

@section('title')
    Perfil
@endsection

@section('body')
<?php
$imgSrc = str_replace('public/profiles', 'storage/profiles', $usuario->imagem);
?>
    <div class="perfil">
        <img src='{{asset("$imgSrc")}}' alt="">
        <h2>{{$usuario->nome}}</h2>
        <a href="{{route('log.deslogar')}}">Sair</a>
        <a href="editar/{{$usuario->id}}"><img src="{{asset('svg/edit.svg')}}" alt="" class="edit"></a>
        <a href="{{route('log.deletar')}}" onclick="certeza(event)"><img src="{{asset('svg/lixeira.svg')}}" alt="" class="delete"></a>
    </div>

    <div class="objs">
        <h2>
            @if (isset($usuario->ong->id))
                Objetos recebidos/receber
            @else
                Objetos doados:
            @endif
        </h2>

        @if (isset($usuario->ong->id))
            @foreach ($objetos as $obj)
            <?php
                preg_match("/img='([^']*)'/", $obj->descricao, $url);
                $url = str_replace("img='", '', $url[0]);
                $url = str_replace("'", '', $url);
                $descricao = preg_replace("/'(.*?)'/", "", $obj->descricao);
                $descricao = str_replace("img=", '', $descricao);
            ?>

            <div class="obj">
                <img src="{{asset($url)}}" class="obj">
                <h3>{{$descricao}}</h3>
                @if ($obj->estado == 1)
                    <button class="button-17" role="button" style="background-color: green;" onclick="window.location.href = '/Ong/recebido/{{$obj->id}}'">
                        <img src="{{asset('svg/enviar.svg')}}" style="width: 20px;">
                    </button>
                @endif
            </div>
            
            @endforeach
        @else
            @foreach ($objetos as $obj)
            <?php
                preg_match("/img='([^']*)'/", $obj->descricao, $url);
                $url = str_replace("img='", '', $url[0]);
                $url = str_replace("'", '', $url);
                $descricao = preg_replace("/'(.*?)'/", "", $obj->descricao);
                $descricao = str_replace("img=", '', $descricao);
            ?>

            <div class="obj">
                <img src="{{asset($url)}}" class="obj">
                <h3>{{$descricao}}</h3>
                @if ($obj->estado == 0)
                    <button class="button-17" role="button" onclick="window.location.href = '/Ong/enviado/{{$obj->id}}'">
                        <img src="{{asset('svg/enviar.svg')}}" style="width: 20px">
                    </button>

                    <button class="button-17" role="button" style="background-color: red" onclick="certezaObj(event, '/Ong/deletar/{{$obj->id}}')">
                        <img src="{{asset('svg/lixeira.svg')}}" style="width: 20px">
                    </button>
                @endif
            </div>
            
            @endforeach
        @endif        
    </div>

@endsection

@section('js')    
<script src="{{asset('js/form.js')}}"></script>
@endsection