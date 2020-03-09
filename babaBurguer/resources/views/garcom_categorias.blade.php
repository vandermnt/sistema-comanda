@extends('garcom_principal')

@section('conteudo')

@if(isset($id_cliente))

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherLancheLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> LANCHES </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherPorClassicaLevar', ['id_cliente' => $id_cliente]) }}"><button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES CLÁSSICAS </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherPorDoceLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES DOCES </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherPorEspecialLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES ESPECIAIS </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherPastasLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PASTAS </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherChoppLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> CHOPPS </b></button> </a>
</div>

<div class="col-sm-12"style="margin-top: 5px">
  <a href="{{ action('PedidoController@escolherBebidasLevar', ['id_cliente' => $id_cliente]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> BEBIDAS </b></button> </a>
</div>

@else
  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherLanche', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> LANCHES </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherPorClassica', ['id_mesa' => $id_mesa]) }}"><button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES CLÁSSICAS </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherPorDoce', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES DOCES </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherPorEspecial', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PORÇÕES ESPECIAIS </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherPastas', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> PASTAS </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherChopp', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> CHOPPS </b></button> </a>
  </div>

  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@escolherBebidas', ['id_mesa' => $id_mesa]) }}"> <button type="button" class="btn btn-primary btn-lg btn-block"><b> BEBIDAS </b></button> </a>
  </div>

@endif
@stop
