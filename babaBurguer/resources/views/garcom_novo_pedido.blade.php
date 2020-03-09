@extends('garcom_principal')

@section('conteudo')

<div class="container">
  <form method="post" action="{{ action('PedidoController@cadPedido') }}">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <br>

    <div class="col-sm-12"style="margin-top: 5px">
      <input class="form-control" name="nome_cliente" class="form-control" placeholder="Nome cliente"> <br>
      <button type="submit" class="btn btn-primary btn-lg btn-block"><b> FAZER PEDIDO </b></button>

    </div>

  </form>

  <div class="col-sm-12"style="margin-top: 5px">
    <!-- <a href="{{ action('PedidoController@novoPedido') }}"> <button type="button" class="btn btn-success btn-lg btn-block"><b> NOVO PEDIDO </b></button> </a> -->
  </div>
</div>

@stop
