@extends('default.index')

@section('css')    
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('title')
    Doar
@endsection

@section('body')
<form action="{{route('ong.form')}}" method="post" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
        @csrf
        <label for="banner" style="display: flex; flex-direction: column; align-items: center">
            <img src="{{asset('svg/caixa.svg')}}" alt="" class="inputBanner" required>
            <h3 id="nameImage">Selecione uma imagem</h3>
        </label>
        <input type="hidden" name="ong_id" value="{{$ong_id}}">
        <input type="file" name="banner" id="banner" accept=".jpg, .png, .jpeg">
        <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição: exemplo. 5 camisas coloridas." required></textarea>      

        <button>
            <span>Enviar</span>
            <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
            </svg>
          </button>
    </form>
@endsection

@section('js')    
    <script src="{{asset('js/form.js')}}"></script>
@endsection