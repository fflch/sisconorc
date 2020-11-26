@extends('master')

@section('content_header')
  <h1>Tipo de Conta: {{ $tipoconta->descricao }} </h1>
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

<div>
    <a href="{{ route('tipocontas.edit',$tipoconta->id) }}" class="btn btn-success">Editar</a>

</div>
<br>

<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Descrição</b>: {{ $tipoconta->descricao }}</li>
        <li class="list-group-item"> 
@if ($tipoconta->cpfo == 1)
                      X
                    @endif 
         <b> Faz Contra-Partida com a Ficha Orçamentária</b></li>
        <li class="list-group-item"> 
@if ($tipoconta->relatoriobalancete == 1)
                      X
                    @endif 
        <b> Deve constar no relatório Balancete</b></li>
        <li class="list-group-item"><b>Cadastrado/Alterado por</b>: {{ $tipoconta->user->name ?? '' }}</li>
    </ul>
</div>

@stop