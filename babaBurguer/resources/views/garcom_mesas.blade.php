@extends('garcom_principal')

@section('conteudo')

<div class="container">
<div class="row">
  <div class="col-sm-12"style="margin-top: 5px">
    <a href="{{ action('PedidoController@levar') }}"> <button type="button" class="btn btn-warning btn-lg btn-block"><b> PARA LEVAR </b></button> </a>
  </div>
  @foreach ($mesas as $mesas)
    @if($mesas->status == false)
      <div class="col-sm-2"style="margin-top: 5px;">
        <a href="{{ action('PedidoController@escolherMesa', ['id_mesa' => $mesas->id])}}"> <button type="button" class="btn btn-success btn-lg btn-block"><b> {{ $mesas->id }} </b></button> </a>
      </div>
      @else
        <div class="col-sm-2"style="margin-top: 5px">
          <a href="{{ action('PedidoController@escolherMesa', ['id_mesa' => $mesas->id])}}"> <button type="button" class="btn btn-danger btn-lg btn-block"><b> {{ $mesas->id }} </b></button> </a>
        </div>
    @endif

  @endforeach
</div>
</div>
@stop
