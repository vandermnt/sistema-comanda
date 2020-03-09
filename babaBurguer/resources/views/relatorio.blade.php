@extends('principal')

@section('conteudo')

<div id="content">

  <div class="form-inline" style="margin-left: 15px">
    <img src="{{ url('/img/relatorio.png') }}" style="width: 90px;"> <h1 class="relatorio"> Relatório de Vendas </h1>
  </div>
  <hr/> <br>

  <form action="{{ action('PedidoController@gerarRelatorio')}}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">

    <div class="row">
      <div class="form-group col-lg-7">
        <h4 style="color: #696969" >Digite a data que deseja emitir o relatório: </h4>
        <input style="font-size: 27px" type="date" class="form-control" name="data_inicio"  value="" required>
      </div>
      <!-- <div class="form-group col-lg-3">
        <h4 style="color: #696969" >Data Final: </h4>
        <input type="date" class="form-control" name="data_final"  value="" required>
      </div> -->
    </div>
    <div class="box-actions">
      <button type="submit" class="btn btn-success"> <span data-feather="file-text"> </span> <b> Gerar Relatório <b></button>
    </div></form>
  </div>

@stop
