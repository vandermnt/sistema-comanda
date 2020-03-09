@extends('principal')

@section('conteudo')


    <div class="wrapper">
        <div id="content">

          @if(isset($alert))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Pedido fechado com sucesso! <i class="fas fa-check"></i> </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif


            <div class="row">
              @foreach($pedidos_em_aberto as $pedidos_em_aberto)
                <div class="col-sm-3">
                  <div style="border:1px solid #888;border-radius:7px;"><br>
                     <h5 align="center" style="margin-left: 5px;"> Mesa: {{ $pedidos_em_aberto->id_mesa }}</h5>
                    <hr>
                    <?php $valor_formatado = number_format($pedidos_em_aberto->valor, 2, ',', '.'); ?>
                    <h5 align="center" style="margin-left: 5px"> Total: R$ {{ $valor_formatado }} </h5>
                    <button style="margin: 5px; width: 95%" type="button" class="btn btn-info"  data-toggle="modal" data-target="#exampleModal{{$pedidos_em_aberto->id}}"> <b style="font-size: 18px">Ver Pedidos</b></button>
                    <button style="margin: 5px; width: 95%" type="button" class="btn btn-success"  data-toggle="modal" data-target="#fecharPedidoModal" onclick="mod({{$pedidos_em_aberto->id}}, {{$valor_formatado}})"> <b style="font-size: 18px">Fechar Mesa</b></button>
                    <a href="{{ action('PedidoController@imprimirComanda', ['id_carrinho' => $pedidos_em_aberto->id]) }}"><button style="margin: 5px; width: 95%" type="button" class="btn btn-warning"> <b style="font-size: 18px">Imprimir Comanda</b>  <i style="font-size:20px" class="fas fa-print"></i></a>

                  </div>
              </div>

              <div class="modal fade" id="exampleModal{{$pedidos_em_aberto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="fonteMeuPedidoMob" style="color: black" class="modal-title" id="exampleModalLabel"><b> Detalhes da Mesa</b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div style="font-family: 'Roboto', sans-serif;font-size:20px;" class="modal-body">
                      @foreach($pedidos as $pedidoss)
                        @if($pedidoss->mesa_id == $pedidos_em_aberto->id_mesa)
                        <?php $valor_formatado = number_format( $pedidoss->preco, 2, ',', '.'); ?>

                          <p> 1 - {{ $pedidoss->nome }}: R$ {{ $valor_formatado }}  <a href="{{ action('PedidoController@deleteItem', ['id_produto' => $pedidoss->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Excluir Item"><i style="color: red" class="fas fa-trash-alt"></i></a> </p>
                        @endif
                      @endforeach
                      <?php $valor_formatado = number_format($pedidos_em_aberto->valor, 2, ',', '.'); ?>
                      <p> Em aberto: {{ $valor_formatado }}  </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Fechar</b> </button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div> <hr> <h3 align="center" style="color: #585858"> <b>PEDIDOS PARA LEVAR</b> </h3> <hr>

            <div class="row">

              @foreach($pedidos_em_aberto_levar as $pedidos_em_aberto_levar)

                <div class="col-sm-3">

                  <div style="border:1px solid #888;border-radius:7px;"><br>
                    <h5 style="margin-left: 5px;"> <b>Cliente:</b> {{ $pedidos_em_aberto_levar->nome }}</h5>
                    <hr>
                    <?php $valor_formatado = number_format($pedidos_em_aberto_levar->valor, 2, ',', '.'); ?>
                    <h5 style="margin-left: 5px"> Total: R$ {{ $valor_formatado }} </h5>
                    <button style="margin: 5px; width: 95%" type="button" class="btn btn-info"  data-toggle="modal" data-target="#exampleModal{{$pedidos_em_aberto_levar->id}}"> <b style="font-size: 18px">Ver Pedidos</b> <i style="font-size:20px" class="fas fa-search-plus"></i></button>
                    <button style="margin: 5px; width: 95%" type="button" class="btn btn-success"  data-toggle="modal" data-target="#fecharPedidoModall" onclick="mod({{$pedidos_em_aberto_levar->id}}, {{$valor_formatado}})"> <b style="font-size: 18px">Fechar Pedido</b></button>

                  </div>
              </div>

              <div class="modal fade" id="exampleModal{{$pedidos_em_aberto_levar->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="fonteMeuPedidoMob" style="color: black" class="modal-title" id="exampleModalLabel"><b> Detalhes da Mesa</b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div style="font-family: 'Roboto', sans-serif;font-size:20px;" class="modal-body">
                      @foreach($pedidos as $pedidoss)
                        @if($pedidoss->cliente_id == $pedidos_em_aberto_levar->id_entrega)
                        <?php $valor_formatado = number_format( $pedidoss->preco, 2, ',', '.'); ?>

                          <p> 1 - {{ $pedidoss->nome }}: R$ {{ $valor_formatado }} </p>
                        @endif
                      @endforeach
                      <?php $valor_formatado = number_format($pedidos_em_aberto_levar->valor, 2, ',', '.'); ?>
                      <p> Em aberto: {{ $valor_formatado }}  </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Fechar</b> </button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

            @if($pedidos_em_aberto->count()>0)

            <form action="{{ action('PedidoController@fecharMesa') }}" method="post">
              <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
              <input type ="hidden" id="id_carrinho" name="id_carrinho">

              <div class="modal fade" id="fecharPedidoModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="fonteMeuPedidoMob" style="color: black" class="modal-title" id="exampleModalLabel"><b>Fechamento Mesa </b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div style="font-family: 'Roboto', sans-serif;font-size:25px;" class="modal-body">

                      <div class="row">
                        <img src="{{ url('/img/total_mesa.png') }}" style="width: 35px; height: 35px; margin-top: -7px"> <h4> Total R$:</h4>
                      </div> <input id="valmesa" style="font-size: 25px" class="form-control" disabled>
                      <br>

                      <div class="row">
                        <?php $valor_mesa = number_format( $pedidos_em_aberto->valor, 2, ',', '.'); ?>
                        <img src="{{ url('/img/forma_pagamento.png') }}" style="width: 40px; height: 40px; margin-top: -7px"> <h4> Forma de pagamento: </h4>
                      </div>

                      <select id="op_pag" name="op_pag" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
                          <option disabled="true" selected="true"> Escolha a forma </option>
                            <option value="cart"> Cartão </option>
                            <option value="money"> Dinheiro </option>
                      </select> <br>

                      <div id="money" style="display:none">
                        <div class="row">
                          <?php $valor_mesa = number_format( $pedidos_em_aberto->valor, 2, ',', '.'); ?>
                          <img src="{{ url('/img/total_mesa.png') }}" style="width: 35px; height: 35px; margin-top: -7px"> <h4> Valor Pago R$:</h4>
                        </div> <input id="valor_pago" type="number" style="font-size: 25px" placeholder="Digite o valor" class="form-control" onkeyup="troco(this.value, {{$valor_mesa}})"><br>

                        <div class="row">
                          <?php $valor_mesa = number_format( $pedidos_em_aberto->valor, 2, ',', '.'); ?>
                          <img src="{{ url('/img/troco.png') }}" style="width: 35px; height: 35px; margin-left: 10px; margin-top: -7px"> <h4> Troco R$:</h4>
                        </div> <input id="troc" value="" style="font-size: 25px" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="bt_fecharmesa" style="display:none" type="submit" class="btn btn-success btn-lg btn-block"><b>Fechar Mesa</b> </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            @endif
            @if($p_levar->count()>0)

            <form action="{{ action('PedidoController@fecharPedidoLevar') }}" method="post">
              <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
              <input type ="hidden" id="id_carrinho" name="id_carrinho">

              <div class="modal fade" id="fecharPedidoModall" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="fonteMeuPedidoMob" style="color: black" class="modal-title" id="exampleModalLabel"><b>Fechamento Mesa </b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div style="font-family: 'Roboto', sans-serif;font-size:25px;" class="modal-body">

                      <div class="row">
                        <img src="{{ url('/img/total_mesa.png') }}" style="width: 35px; height: 35px; margin-top: -7px"> <h4> Total R$:</h4>
                      </div> <input id="valmesa" style="font-size: 25px" class="form-control" disabled>
                      <br>

                      <div class="row">
                        <img src="{{ url('/img/forma_pagamento.png') }}" style="width: 40px; height: 40px; margin-top: -7px"> <h4> Forma de pagamento: </h4>
                      </div>

                      <select id="op_pag" name="op_pag" class="form-control form-control-lg" onchange="optionCheck()" style="width: 100%">
                          <option disabled="true" selected="true"> Escolha a forma </option>
                            <option value="cart"> Cartão </option>
                            <option value="money"> Dinheiro </option>
                      </select> <br>

                      <div id="money" style="display:none">
                        <div class="row">
                          <img src="{{ url('/img/total_mesa.png') }}" style="width: 35px; height: 35px; margin-top: -7px"> <h4> Valor Pago R$:</h4>
                        </div> <input id="valor_pago" type="number" style="font-size: 25px" placeholder="Digite o valor" class="form-control" onkeyup="troco(this.value, {{$valor_mesa}})"><br>

                        <div class="row">
                          <img src="{{ url('/img/troco.png') }}" style="width: 35px; height: 35px; margin-left: 10px; margin-top: -7px"> <h4> Troco R$:</h4>
                        </div> <input id="troc" value="" style="font-size: 25px" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="bt_fecharmesa" style="display:none" type="submit" class="btn btn-success btn-lg btn-block"><b>Fechar Mesa</b> </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            @endif
          </div>
        </div>

  <script type="text/javascript">
    function optionCheck(){
      var option = document.getElementById("op_pag").value;
      // document.getElementById("dinheiro").innerHTML ="TESTE";

        if(option == "money"){
          // document.getElementById("dinheiro").innerHTML ="TESTE";
          document.getElementById("money").style.display ="block";
          document.getElementById("bt_fecharmesa").style.display ="block";
        }else if(option == "cart"){
          document.getElementById("money").style.display = "none";
          document.getElementById("bt_fecharmesa").style.display ="block";
        }
    }

    function troco(valor_recebido, valor_mesa){
      // var $valorpago = valor_pago;
      // var $totalmesa = total_mesa;
      //
      // var $troco = document.getElementById('troco');
      // $troco.value = parseInt($valorpago) - parseInt($totalmesa);

      // var $valormesa = valor_mesa;
      // var $valorecebido = valor_recebido;
      // var $troco = parseInt($valorecebido) - parseInt($valormesa);
      // document.getElementById('troc').value = $troco + ",00";

      var $valormesa = document.getElementById('valmesa').value;
      var $valorecebido = valor_recebido;
      var $troco = parseInt($valorecebido) - parseInt($valormesa);
      document.getElementById('troc').value = $troco + ",00";



    }

    function mod(id_carrinho, valor_mesa){
      var $valor_mesa = valor_mesa;

      document.getElementById("id_carrinho").value = id_carrinho;
      document.getElementById("valmesa").value = $valor_mesa + ",00";
    }


  </script>
@stop
