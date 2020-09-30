@extends('master')

@section('content_header')
    <h1>Cadastrar Dotação Orçamentária</h1>
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

<p><a href="{{ route('dotorcamentarias.create') }}" class="btn btn-success">
    Adicionar Dotação Orçamentária
</a></p>

<form method="get" action="/dotorcamentarias">
  <div class="row">
    <div class=" col-sm input-group">
      <input type="text" class="form-control" name="busca" value="{{ Request()->busca}}" placeholder="Busca por Dotação">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-success"> Buscar </button>
      </span>
    </div>
  </div>
</form>

<div class="table-responsive">
<p>{{ $dotorcamentarias->links() }}</p>
    <table class="table table-striped" border="0">
        <thead>
            <tr>
                <th width="5%" align="center">#</th>
                <th width="10%" align="left">Dotação</th>
                <th width="10%" align="center">Grupo</th>
                <th width="20%" align="center">Descrição do Grupo</th>
                <th width="10%" align="center">Item</th>
                <th width="25%" align="left">Descrição do Item</th>  
                <th width="5%" align="center">Receita</th>                              
                <th width="15%" align="center" colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dotorcamentarias as $dotorcamentaria)
            <tr>
                <td align="center" valign="middle">{{ $dotorcamentaria->id }}</td>
                <td align="left"><a href="/dotorcamentarias/{{ $dotorcamentaria->id }}">{{ $dotorcamentaria->dotacao }}</a></td>
                <td align="center">{{ $dotorcamentaria->grupo }}</td>
                <td align="left">{{ $dotorcamentaria->descricaogrupo }}</td>
                <td align="left">{{ $dotorcamentaria->item }}</td>
                <td align="left">{{ $dotorcamentaria->descricaoitem }}</td>
                <td align="center" valign="middle">
                    @if ($dotorcamentaria->receita == 1)
                      X
                    @endif</td>
                <td align="center">
                    <a class="btn btn-warning" href="/dotorcamentarias/{{$dotorcamentaria->id}}/edit">Editar</a>
                </td>
                <td align="center">
                    <form method="post" role="form" action="{{ route('dotorcamentarias.destroy', $dotorcamentaria) }}" >
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="delete-item btn btn-danger" type="submit" onclick="return confirm('Deseja realmente excluir o registro?');">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<p>{{ $dotorcamentarias->links() }}</p>
</div>
@stop