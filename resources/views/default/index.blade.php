<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <menu>
            <span>
                Doe Mais
            </span>
            <ul>
                <li><a href="{{route('inicio')}}">Início</a></li>
                <li><a href="">Início</a></li>
                <li><a href="">Início</a></li>
            </ul>

            <?php
            $routePerfil = session()->get('imagem') != null ? 'log.perfil' : 'log.login';
            $imgPerfil = session()->get('imagem') != null ? session()->get('imagem') : 'svg/profile.svg'
            ?>
            <img src="{{asset($imgPerfil)}}" alt="" id="profile" onclick="window.location.href = '{{route($routePerfil)}}'">
        </menu>
    </header>
    @if(Session::get('error') != null)
        <div class="message">
            {{Session::get('error')}}
        </div>
    @endif    

    @yield('body')

    <footer>

    </footer>

    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    @yield('js')
</body>
</html>