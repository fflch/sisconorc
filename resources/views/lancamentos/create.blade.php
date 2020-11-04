@extends('master')

@section('content_header')
    <h1>Cadastrar Lançamentos</h1>
@stop

@section('content')

<div class="row">
    @include('messages.flash')
    @include('messages.errors')

        <div class="col-md-6">
            <form method="post" action="{{ url('lancamentos') }}">
                {{ csrf_field() }}
                @include('lancamentos.form')
            </form>
        </div>
    </div>

@stop
