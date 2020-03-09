@extends('garcom_principal')

@section('conteudo')
<br>
<div align="center">
  <b> <h1 style="color: green"> PEDIDO FEITO COM SUCESSO! </h1> </b> <br>
  <a href="{{ action('PedidoController@escolherMesa', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> CONTINUAR PEDIDO </b></button> </a>
  <a href="/garcom"> <button type="button" style="margin-top: 3px;"class="btn btn-success btn-lg btn-block"><b> FINALIZAR </b></button> </a>
</div>

@stop
