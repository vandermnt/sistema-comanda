@extends('garcom_principal')

@section('conteudo')
<br>
@if(isset($id_cliente))
<form method="post" action="{{ action('PedidoController@salvarPedidoLevar') }}">
  <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
  <input type ="hidden" name="id_cliente" value="{{ $id_cliente }}">
  <input type ="hidden" name="categoria" value="lanche">

  <div class="col-sm-12">
    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha o lanche </option>
      @foreach($lanches as $lanches)
        <option value="{{ $lanches->id }}"> {{ $lanches->nome }} </option>
      @endforeach
    </select>
  </div> <br>

  <div class="col-sm-12" id="opcoes" style="display:none;">
    <h3> Tipo do pão: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="paofrances" value="Frânces" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paofrances">Pão Francês</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" value="Hambúrguer" id="paohamburguer" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paohamburguer">Pão de Hambúrguer</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="paodagua" value="d'Água" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paodagua">Pão d'Água</label>
    </div> <br>

    <h3> Tipo do Queijo: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="cheddar" value="Cheddar" name="tipo_queijo" class="custom-control-input">
      <label class="custom-control-label" for="cheddar"> Cheddar</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="cattupiry" value="Cattupiry" name="tipo_queijo" class="custom-control-input">
      <label class="custom-control-label" for="cattupiry"> Cattupiry</label>
    </div> <br>



    <h3> Salada: </h3>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="tomate" name="tomate" value="sim">
      <label class="custom-control-label" for="tomate">Tomate</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="alface" name="alface" value="sim">
      <label class="custom-control-label" for="customControlValidation9">Alface</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>
    <!--
    <div class="custom-control custom-radio">
      <input type="radio" id="tomate_sim" value="Sim" name="tomate" class="custom-control-input">
      <label class="custom-control-label" for="tomate_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="tomate_nao" value="Não" name="tomate" class="custom-control-input">
      <label class="custom-control-label" for="tomate_nao"> Não </label>
    </div> <br> -->
    <h3> Com queijo: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="queijo_sim" value="Sim" name="queijo" class="custom-control-input">
      <label class="custom-control-label" for="queijo_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="queijo_nao" value="Não" name="queijo" class="custom-control-input">
      <label class="custom-control-label" for="queijo_nao"> Não </label>
    </div> <br>

    <h3> Com presunto: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="presunto_sim" value="Sim" name="presunto" class="custom-control-input">
      <label class="custom-control-label" for="presunto_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="presunto_nao" value="Não" name="presunto" class="custom-control-input">
      <label class="custom-control-label" for="presunto_nao"> Não </label>
    </div> <br>

    <h3> Batata Palha: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="batatapalha_sim" value="Sim" name="batatapalha" class="custom-control-input">
      <label class="custom-control-label" for="batatapalha_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="batatapalha_nao" value="Não" name="batatapalha" class="custom-control-input">
      <label class="custom-control-label" for="batatapalha_nao"> Não</label>
    </div> <br>

    <h3> Molhos: </h3>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="barbecue" name="barbecue" value="sim">
      <label class="custom-control-label" for="barbecue">Barbecue</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="maionese" name="maionese" value="sim">
      <label class="custom-control-label" for="maionese">Maionese</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>

    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="pasta_alho" name="pasta_alho" value="sim">
      <label class="custom-control-label" for="pasta_alho">Pasta de Alho</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>

    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="mostarda" name="mostarda" value="sim">
      <label class="custom-control-label" for="mostarda">Mostarda</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>

    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="catchup" name="catchup" value="sim">
      <label class="custom-control-label" for="customControlValidation2">Catchup</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>

    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="laranja" name="laranja" value="sims">
      <label class="custom-control-label" for="laranja">Laranja</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>

    <h3> Observações: </h3>
    <input class="form-control" name="obs" class="form-control" placeholder="Observações: ..."> <br>
     <button type="submit" class="btn btn-primary btn-lg btn-block"><b> FAZER PEDIDO </b></button>
  </div>
  <br>
</form>


@else
<form method="post" action="{{ action('PedidoController@salvarPedido') }}">
  <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
  <input type ="hidden" name="id_mesa" value="{{ $id_mesa }}">
  <input type ="hidden" name="categoria" value="lanche">

  <div class="col-sm-12">
    <select id="op" name="op" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
      <option disabled="true" selected="true"> Escolha o lanche </option>
      @foreach($lanches as $lanches)
        <option value="{{ $lanches->id }}"> {{ $lanches->nome }} </option>
      @endforeach
    </select>
  </div> <br>

  <div class="col-sm-12" id="opcoes" style="display:none;">
    <h3> Tipo do pão: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="paofrances" value="Frânces" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paofrances">Pão Francês</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" value="Hambúrguer" id="paohamburguer" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paohamburguer">Pão de Hambúrguer</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="paodagua" value="d'Água" name="pao" class="custom-control-input">
      <label class="custom-control-label" for="paodagua">Pão d'Água</label>
    </div> <br>

    <h3> Tipo do Queijo: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="cheddar" value="Cheddar" name="tipo_queijo" class="custom-control-input">
      <label class="custom-control-label" for="cheddar"> Cheddar</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="cattupiry" value="Cattupiry" name="tipo_queijo" class="custom-control-input">
      <label class="custom-control-label" for="cattupiry"> Cattupiry</label>
    </div> <br>

    <h3> Salada: </h3>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="tomate" name="tomate" value="sim">
      <label class="custom-control-label" for="tomate">Tomate</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>
    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" id="alface" id="alface" name="alface" value="sim">
      <label class="custom-control-label" for="alface">Alface</label>
      <div class="invalid-feedback">Example invalid feedback text</div>
    </div>
    <!--
    <div class="custom-control custom-radio">
      <input type="radio" id="tomate_sim" value="Sim" name="tomate" class="custom-control-input">
      <label class="custom-control-label" for="tomate_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="tomate_nao" value="Não" name="tomate" class="custom-control-input">
      <label class="custom-control-label" for="tomate_nao"> Não </label>
    </div> <br> -->
    <h3> Com queijo: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="queijo_sim" value="Sim" name="queijo" class="custom-control-input">
      <label class="custom-control-label" for="queijo_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="queijo_nao" value="Não" name="queijo" class="custom-control-input">
      <label class="custom-control-label" for="queijo_nao"> Não </label>
    </div> <br>

    <h3> Com presunto: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="presunto_sim" value="Sim" name="presunto" class="custom-control-input">
      <label class="custom-control-label" for="presunto_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="presunto_nao" value="Não" name="presunto" class="custom-control-input">
      <label class="custom-control-label" for="presunto_nao"> Não </label>
    </div> <br>

    <h3> Batata Palha: </h3>
    <div class="custom-control custom-radio">
      <input type="radio" id="batatapalha_sim" value="Sim" name="batatapalha" class="custom-control-input">
      <label class="custom-control-label" for="batatapalha_sim"> Sim</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="batatapalha_nao" value="Não" name="batatapalha" class="custom-control-input">
      <label class="custom-control-label" for="batatapalha_nao"> Não</label>
    </div> <br>

    <h3> Observações: </h3>
    <input class="form-control" name="obs" class="form-control" placeholder="Observações: ..."> <br>
     <button type="submit" class="btn btn-primary btn-lg btn-block"><b> FAZER PEDIDO </b></button>
  </div>
  <br>
</form>

@endif



<script type="text/javascript">
  function optionCheck(){
    var option = document.getElementById("op").value;
    if(option != null){
      document.getElementById("opcoes").style.display ="block";
    }
  }
  </script>
@stop
