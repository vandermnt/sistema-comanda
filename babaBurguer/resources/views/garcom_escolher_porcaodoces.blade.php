@extends('garcom_principal')

@section('conteudo')
<br>
@if(isset($id_cliente))
<div class="col-sm-12">
  <form method="post" action="{{ action('PedidoController@salvarPedidoLevar') }}">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="id_cliente" value="{{ $id_cliente }}">
    <input type ="hidden" name="categoria" value="pordoce">

    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha a porção doce </option>
      @foreach($pordoce as $pordoce)
        <option value="{{ $pordoce->id }}"> {{ $pordoce->nome }} </option>
      @endforeach
    </select>

</div> <br>

<div class="col-sm-12" id="porcao" style="display:none;">
  <h3> Observações: </h3>
  <input class="form-control" name="obs" class="form-control" placeholder="Observações: ..."> <br>
  <button type="submit" class="btn btn-primary btn-lg btn-block"><b> FAZER PEDIDO </b></button>
</div>
</form>

@else
<div class="col-sm-12">
  <form method="post" action="{{ action('PedidoController@salvarPedido') }}">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="id_mesa" value="{{ $id_mesa }}">
    <input type ="hidden" name="categoria" value="pordoce">

    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha a porção doce </option>
      @foreach($pordoce as $pordoce)
        <option value="{{ $pordoce->id }}"> {{ $pordoce->nome }} </option>
      @endforeach
    </select>

</div> <br>

<div class="col-sm-12" id="porcao" style="display:none;">
  <h3> Observações: </h3>
  <input class="form-control" name="obs" class="form-control" placeholder="Observações: ..."> <br>
  <button type="submit" class="btn btn-primary btn-lg btn-block"><b> FAZER PEDIDO </b></button>
</div>
</form>

@endif


<script type="text/javascript">
  function optionCheck(){
      document.getElementById("porcao").style.display ="block";
  }
  </script>
@stop
