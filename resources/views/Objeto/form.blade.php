<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postar Objeto</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <form action="{{route('cadastrar/objeto')}}" method="post">
        @csrf        
        <input type="text" name="descricao" id="" placeholder="Especifique o objeto">
        <select name="estado" id="">
            <option value="">Selecione</option>
            <option value="1">Entrega por transportadora</option>
            <option value="2">Entrega pessoalmente</option>
        </select>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>