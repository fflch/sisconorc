@extends('master')

@section('title')
    Unidade
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

<div class="table-responsive">
    <table class="table table-striped" border="0">
        <thead>
            <tr align="center">
                <th width="5%" align="center">#</th>
                <th width="5%" align="left">Número</th>
                <th width="45%" align="left">Nome</th>
                <th width="35%" align="left">Departamento</th>
                <th width="10%" align="center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidade)
            <tr>
                <td align="center">{{ $unidade->id }}</td>
                <td align="center">{{ $unidade->numero }}</td>
                <td align="left"><a href="/unidades/{{ $unidade->id }}">{{ $unidade->nome }}</a></td>
                <td align="left">{{ $unidade->departamento }}</td>
                <td align="center"><a class="btn btn-warning" href="/unidades/{{$unidade->id}}/edit">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
