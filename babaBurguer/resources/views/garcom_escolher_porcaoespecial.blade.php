@extends('garcom_principal')

@section('conteudo')
<br>
@if(isset($id_cliente))

<form method="post" action="{{ action('PedidoController@salvarPedidoLevar') }}">
<div class="col-sm-12">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="id_cliente" value="{{ $id_cliente }}">
    <input type ="hidden" name="categoria" value="porespecial">

    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha a porção especial </option>
      @foreach($porespecial as $porespecial)
        <option value="{{ $porespecial->id }}"> {{ $porespecial->nome }} </option>
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
<form method="post" action="{{ action('PedidoController@salvarPedido') }}">
<div class="col-sm-12">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="id_mesa" value="{{ $id_mesa }}">
    <input type ="hidden" name="categoria" value="porespecial">

    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha a porção especial </option>
      @foreach($porespecial as $porespecial)
        <option value="{{ $porespecial->id }}"> {{ $porespecial->nome }} </option>
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
