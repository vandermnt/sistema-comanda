<?php

namespace App\Http\Controllers;

use DB;
use Request;
use App\MesaModel;
use App\PedidoModel;
use App\CarrinhoModel;
use App\ProdutoModel;
use App\PedidoLevar;


class PedidoController extends Controller{

    public function levar(){
      $pedidos_levar = PedidoLevar::where('status', '=', true)->get();
      return view('garcom_pedido_levar')->with('pedidos_levar', $pedidos_levar);
    }

    public function escolherNomeLevar($id_cliente){
      return view('garcom_categorias')->with('id_cliente', $id_cliente);
    }

    public function novoPedido(){
      return view ('garcom_novo_pedido');
    }

    public function cadPedido(){
      $nome_cliente = Request::input('nome_cliente');

      $levar = new PedidoLevar();

      $levar->nome = $nome_cliente;
      $levar->status = true;
      $levar->save();

      $id_cliente = PedidoLevar::where('status', '=', true)->where('nome', '=', $nome_cliente)->first();

      return view('garcom_categorias')->with('id_cliente', $id_cliente);
    }

    public function mostrarPedidos(){
      $pedidos_em_aberto = CarrinhoModel::where('status', '=', true)->where('id_entrega', '=', null)->get();
      $pedidos_em_aberto_levar = CarrinhoModel::join('pedido_levars', 'carrinho_models.id_entrega', '=', 'pedido_levars.id')
          ->select('pedido_levars.nome', 'carrinho_models.id', 'carrinho_models.id_entrega', 'carrinho_models.data_compra', 'carrinho_models.valor')
          ->where('carrinho_models.status', '=', true)->where('carrinho_models.id_mesa', '=', null)->get();

      $p_levar = CarrinhoModel::where('status', '=', true)->where('id_mesa', '=', null)->get();

      $clientes = PedidoLevar::where('status', '=', true)->get();

      $pedidos = DB::table('pedido_models')
          ->join('produto_models', 'pedido_models.produto_id', '=', 'produto_models.id')
          ->select('pedido_models.id', 'pedido_models.carrinho_id', 'produto_models.nome', 'produto_models.preco', 'pedido_models.mesa_id', 'pedido_models.cliente_id', 'pedido_models.obs', 'pedido_models.adicionais')
          ->where('status', '=', true)->get();

        return view('inicio')->with('p_levar', $p_levar)->with('clientes', $clientes)->with('pedidos_em_aberto_levar',  $pedidos_em_aberto_levar)->with('pedidos_em_aberto', $pedidos_em_aberto)->with('pedidos', $pedidos);

    }

    public function deleteItem($id_item){
      $item = PedidoModel::find($id_item);
      $preco_produto = ProdutoModel::find($item->produto_id);
      $carrinho = CarrinhoModel::find($item->carrinho_id);

      $total = $carrinho->valor - $preco_produto->preco;

      $carrinho->valor = $total;
      $carrinho->save();

      $item->delete();

      return redirect()->action('PedidoController@mostrarPedidos')->withInput();
    }

    public function imprimirComanda(){
      $carrinho = Request::input('id_carrinho');
      $car = CarrinhoModel::find($carrinho);

      $pedidos = DB::table('pedido_models')
          ->join('produto_models', 'pedido_models.produto_id', '=', 'produto_models.id')
          ->select('pedido_models.id', 'pedido_models.carrinho_id', 'produto_models.nome', 'produto_models.preco', 'pedido_models.mesa_id', 'pedido_models.cliente_id', 'pedido_models.obs', 'pedido_models.adicionais')
          ->where('status', '=', true)->where('carrinho_id', '=', $carrinho)->get();

      return view('teste')->with('pedidos', $pedidos)->with('car', $car);
    }

    public function mostrarMesas(){
      $mesas = MesaModel::all();
      return view('garcom_mesas')->with('mesas', $mesas);
    }

    public function verMesas(){
      $mesas = MesaModel::all();
      return view('mostrar_mesas')->with('mesas', $mesas);
    }

    public function escolherMesa($id_mesa){
      return view('garcom_categorias')->with('id_mesa', $id_mesa);
    }

    public function escolherCliente($id_cliente){
      return view('garcom_categorias')->with('id_cliente', $id_cliente);
    }

    public function escolherLanche($id_mesa){
      $lanches = ProdutoModel::where('categoria', '=', 'lanche')->get();
      return view('garcom_escolher_lanche')->with('id_mesa', $id_mesa)->with('lanches', $lanches);
    }

    public function escolherLancheLevar($id_cliente){
      $lanches = ProdutoModel::where('categoria', '=', 'lanche')->get();
      return view('garcom_escolher_lanche')->with('id_cliente', $id_cliente)->with('lanches', $lanches);
    }

    public function escolherPorClassicaLevar($id_cliente){
      $porclassica = ProdutoModel::where('categoria', '=', 'porclassica')->get();
      return view('garcom_escolher_porcaoclassica')->with('porclassica', $porclassica)->with('id_cliente', $id_cliente);
    }

    public function escolherPorEspecialLevar($id_cliente){
      $porespecial = ProdutoModel::where('categoria', '=', 'porespecial')->get();
      return view('garcom_escolher_porcaoespecial')->with('porespecial', $porespecial)->with('id_cliente', $id_cliente);
    }

    public function escolherPastasLevar($id_cliente){
      $pasta = ProdutoModel::where('categoria', '=', 'pasta')->get();
      return view('garcom_escolher_pastas')->with('pasta', $pasta)->with('id_cliente', $id_cliente);
    }

    public function escolherBebidasLevar($id_cliente){
      $bebida = ProdutoModel::where('categoria', '=', 'bebida')->get();
      return view('garcom_escolher_bebidas')->with('bebida', $bebida)->with('id_cliente', $id_cliente);
    }

    public function escolherChoppLevar($id_cliente){
      $chopp = ProdutoModel::where('categoria', '=', 'chopp')->get();
      return view('garcom_escolher_chopps')->with('chopp', $chopp)->with('id_cliente', $id_cliente);
    }

    public function escolherPorDoceLevar($id_cliente){
      $pordoce = ProdutoModel::where('categoria', '=', 'pordoce')->get();
      return view('garcom_escolher_porcaodoces')->with('pordoce', $pordoce)->with('id_cliente', $id_cliente);
    }

    public function fecharPedidoLevar(){
      $id_carrinho = Request::input('id_carrinho');

      $carrinho = CarrinhoModel::find($id_carrinho);
      $cliente_id = PedidoLevar::find($carrinho->id_entrega);

      $pedidos = PedidoModel::where('carrinho_id', '=', $id_carrinho)->get();

      foreach($pedidos as $pedidos){
        $pedidos->status = false;
        $pedidos->save();
      }

      $cliente_id->status = false;
      $cliente_id->save();

      $carrinho->status = false;
      $carrinho->save();

      $pedidos_em_aberto = CarrinhoModel::where('status', '=', true)->where('id_entrega', '=', null)->get();
      $pedidos_em_aberto_levar = DB::table('carrinho_models')
          ->join('pedido_levars', 'carrinho_models.id_entrega', '=', 'pedido_levars.id')
          ->select('pedido_levars.nome', 'carrinho_models.id', 'carrinho_models.id_entrega', 'carrinho_models.data_compra', 'carrinho_models.valor')
          ->where('carrinho_models.status', '=', true)->where('carrinho_models.id_mesa', '=', null)->get();

      $p_levar = CarrinhoModel::where('status', '=', true)->where('id_mesa', '=', null)->get();

      $clientes = PedidoLevar::where('status', '=', true)->get();

      $pedidos = DB::table('pedido_models')
          ->join('produto_models', 'pedido_models.produto_id', '=', 'produto_models.id')
          ->select('pedido_models.id', 'pedido_models.carrinho_id', 'produto_models.nome', 'produto_models.preco', 'pedido_models.mesa_id', 'pedido_models.cliente_id', 'pedido_models.obs', 'pedido_models.adicionais')
          ->where('status', '=', true)->get();

      $alert = true;
      return view('inicio')->with('p_levar', $p_levar)->with('alert', $alert)->with('clientes', $clientes)->with('pedidos_em_aberto_levar',  $pedidos_em_aberto_levar)->with('pedidos_em_aberto', $pedidos_em_aberto)->with('pedidos', $pedidos);
    }

    public function fecharMesa(){
      $id_carrinho = Request::input('id_carrinho');

      $carrinho = CarrinhoModel::find($id_carrinho);
      $mesa_id = MesaModel::find($carrinho->id_mesa);

      $pedidos = PedidoModel::where('carrinho_id', '=', $id_carrinho)->get();

      foreach($pedidos as $pedidos){
        $pedidos->status = false;
        $pedidos->save();
      }

      $mesa_id->status = false;
      $mesa_id->save();

      $carrinho->status = false;
      $carrinho->save();

      $pedidos_em_aberto = CarrinhoModel::where('status', '=', true)->where('id_entrega', '=', null)->get();
      $pedidos_em_aberto_levar = DB::table('carrinho_models')
          ->join('pedido_levars', 'carrinho_models.id_entrega', '=', 'pedido_levars.id')
          ->select('pedido_levars.nome', 'carrinho_models.id', 'carrinho_models.id_entrega', 'carrinho_models.data_compra', 'carrinho_models.valor')
          ->where('carrinho_models.status', '=', true)->where('carrinho_models.id_mesa', '=', null)->get();

      $p_levar = CarrinhoModel::where('status', '=', true)->where('id_mesa', '=', null)->get();

      $clientes = PedidoLevar::where('status', '=', true)->get();

      $pedidos = DB::table('pedido_models')
          ->join('produto_models', 'pedido_models.produto_id', '=', 'produto_models.id')
          ->select('pedido_models.id', 'pedido_models.carrinho_id', 'produto_models.nome', 'produto_models.preco', 'pedido_models.mesa_id', 'pedido_models.cliente_id', 'pedido_models.obs', 'pedido_models.adicionais')
          ->where('status', '=', true)->get();

      $alert = true;
      return view('inicio')->with('p_levar', $p_levar)->with('alert', $alert)->with('clientes', $clientes)->with('pedidos_em_aberto_levar',  $pedidos_em_aberto_levar)->with('pedidos_em_aberto', $pedidos_em_aberto)->with('pedidos', $pedidos);
    }

    public function salvarPedido(){

      $categoria = Request::input('categoria');
      $op = Request::input('op');
      $pao = Request::input('pao');
      $tipo_queijo = Request::input('tipo_queijo');
      $queijo = Request::input('queijo');
      $presunto = Request::input('presunto');
      $batatapalha = Request::input('batatapalha');
      $tomate = Request::input('tomate');
      $alface = Request::input('alface');
      $obs = Request::input('obs');
      $id_mesa = Request::input('id_mesa');

      $pedido = new PedidoModel();

      $carrinho_em_aberto = CarrinhoModel::where('id_mesa', '=', $id_mesa)->where('status', '=', true)->first();

      $mesa = MesaModel::find($id_mesa);
      $mesa->status = true;
      $mesa->save();

      if(isset($carrinho_em_aberto) && $carrinho_em_aberto->count() > 0){
        //carrinho aberto

        if($categoria == "lanche"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $pedido->adicionais = "Pão: " . $pao . " | " . "Queijo: " . $queijo . " | " . "Tipo do Queijo: " . $tipo_queijo . " | " . "Batata Palha: " . $batatapalha . " | " . "Tomate: " . $tomate. " | " . "Alface: " . $alface . " | " . "Presunto: " . $presunto;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "porclassica"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "porespecial"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "pordoce"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "pasta"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "chopp"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "bebida"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);
        }

      }else{
        //cria carrinho
        $dataDehoje = date('Y/m/d');

        $carrinho = new CarrinhoModel();

        $carrinho->id_mesa = $id_mesa;
        $carrinho->data_compra = $dataDehoje;
        $carrinho->status = true;
        $carrinho->save();

        $carrinho_em_aberto = CarrinhoModel::where('id_mesa', '=', $id_mesa)->where('status', '=', true)->first();

        if($categoria == "lanche"){

          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $pedido->adicionais = "Pão: " . $pao . " | " . "Queijo: " . $queijo . " | " . "Tipo do Queijo: " . $tipo_queijo . " | " . "Batata Palha: " . $batatapalha . " | " . "Tomate: " . $tomate. " | " . "Alface: " . $alface . " | " . "Presunto: " . $presunto;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "porclassica"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "porespecial"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "pordoce"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "pasta"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "chopp"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "bebida"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;
          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);
        }
      }
    }

    public function salvarPedidoLevar(){
      $categoria   = Request::input('categoria');
      $op          = Request::input('op');
      $pao         = Request::input('pao');
      $tipo_queijo = Request::input('tipo_queijo');
      $queijo      = Request::input('queijo');
      $barbecue    = Request::input('barbecue');
      $maionese    = Request::input('maionese');
      $pasta_alho  = Request::input('pasta_alho');
      $mostarda    = Request::input('mostarda');
      $catchup     = Request::input('catchup');
      $laranja     = Request::input('laranja');
      $presunto    = Request::input('presunto');
      $batatapalha = Request::input('batatapalha');
      $tomate      = Request::input('tomate');
      $alface      = Request::input('alface');
      $obs         = Request::input('obs');
      $id_cliente  = Request::input('id_cliente');

      $carrinho_em_aberto = CarrinhoModel::where([['id_entrega', '=', $id_cliente], ['status', '=', true]])->first();

      if(isset($carrinho_em_aberto) && $carrinho_em_aberto->count() > 0){
        //carrinho aberto

        if($categoria == "lanche"){

          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;
          $pedido->adicionais = "Pão: " . $pao . " | " . "Queijo: " . $queijo . " | " . "Tipo do Queijo: " . $tipo_queijo . " | " . "Batata Palha: " . $batatapalha . " | " . "Tomate: " . $tomate . " | " . "Alface: " . $alface . " | " . "Presunto: " . $presunto . " | Molhos: " . "Barbecue: " . $barbecue . " | " . "Maionese: " . $maionese . " | " . "Pasta de Alho: " . $pasta_alho . " | " . "Mostarda: " . $mostarda . " | " . "Catchup: " . $catchup . " | " . "Laranja: " . $laranja;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "porclassica"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);
          $preco_produto = ProdutoModel::find($op);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "porespecial"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess')->with('id_mesa', $id_mesa);

        }else if($categoria == "pordoce"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "pasta"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "chopp"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "bebida"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }

      }else{
        //cria carrinho
        $dataDehoje = date('Y/m/d');

        $carrinho = new CarrinhoModel();

        $carrinho->id_entrega = $id_cliente;
        $carrinho->data_compra = $dataDehoje;
        $carrinho->status = true;
        $carrinho->save();

        $carrinho_em_aberto = CarrinhoModel::where('id_entrega', '=', $id_cliente)->where('status', '=', true)->first();

        if($categoria == "lanche"){

          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $pedido->adicionais = "Pão: " . $pao . " | " . "Queijo: " . $queijo . " | " . "Tipo do Queijo: " . $tipo_queijo . " | " . "Batata Palha: " . $batatapalha . " | " . "Tomate: " . $tomate . " | " . "Alface: " . $alface . " | " . "Presunto: " . $presunto . " | Molhos: " . "Barbecue: " . $barbecue . " | " . "Maionese: " . $maionese . " | " . "Pasta de Alho: " . $pasta_alho . " | " . "Mostarda: " . $mostarda . " | " . "Catchup: " . $catchup . " | " . "Laranja: " . $laranja;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "porclassica"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "porespecial"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();
          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->mesa_id = $id_mesa;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();

          $pedido->save();

          return view('pedido_sucess_levar')->with('id_mesa', $id_mesa);

        }else if($categoria == "pordoce"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "pasta"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "chopp"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }else if($categoria == "bebida"){
          $dataDehoje = date('Y/m/d');

          $pedido = new PedidoModel();

          $pedido->carrinho_id = $carrinho_em_aberto->id;
          $pedido->produto_id = $op;
          $pedido->qtde_produto = 1;
          $pedido->cliente_id = $id_cliente;
          $pedido->status = true;
          $pedido->obs = $obs;

          $preco_produto = ProdutoModel::find($op);

          $preco_mesa = CarrinhoModel::find($carrinho_em_aberto->id);

          $total_conta = $preco_produto->preco + $preco_mesa->valor;

          $carrinho_em_aberto->valor = $total_conta;

          $carrinho_em_aberto->save();
          $pedido->save();

          return view('pedido_sucess_levar')->with('id_cliente', $id_cliente);

        }
      }
    }

    public function gerarRelatorio(){
      $data_inicio = Request::input('data_inicio');
      $date = date('d/m/Y', strtotime($data_inicio));
      $data_in = date('Y/m/d', strtotime($data_inicio));

      $mesas = CarrinhoModel::whereDate('created_at', '=', $data_in)->where('status', '=', false)->get();
      $total = CarrinhoModel::whereDate('created_at', '=', $data_in)->where('status', '=', false)->sum('valor');

      return view('mostrarRelatorio')->with('mesas', $mesas)->with('date', $date)->with('total', $total);
    }

    public function escolherData(){
      return view('relatorio');
    }

    public function escolherPorClassica($id_mesa){
      $porclassica = ProdutoModel::where('categoria', '=', 'porclassica')->get();
      return view('garcom_escolher_porcaoclassica')->with('porclassica', $porclassica)->with('id_mesa', $id_mesa);
    }

    public function escolherPorDoce($id_mesa){
      $pordoce = ProdutoModel::where('categoria', '=', 'pordoce')->get();
      return view('garcom_escolher_porcaodoces')->with('pordoce', $pordoce)->with('id_mesa', $id_mesa);
    }

    public function escolherPorEspecial($id_mesa){
      $porespecial = ProdutoModel::where('categoria', '=', 'porespecial')->get();
      return view('garcom_escolher_porcaoespecial')->with('porespecial', $porespecial)->with('id_mesa', $id_mesa);
    }

    public function escolherPastas($id_mesa){
      $pasta = ProdutoModel::where('categoria', '=', 'pasta')->get();
      return view('garcom_escolher_pastas')->with('pasta', $pasta)->with('id_mesa', $id_mesa);
    }

    public function escolherBebidas($id_mesa){
      $bebida = ProdutoModel::where('categoria', '=', 'bebida')->get();
      return view('garcom_escolher_bebidas')->with('bebida', $bebida)->with('id_mesa', $id_mesa);
    }

    public function escolherChopp($id_mesa){
      $chopp = ProdutoModel::where('categoria', '=', 'chopp')->get();
      return view('garcom_escolher_chopps')->with('chopp', $chopp)->with('id_mesa', $id_mesa);
    }
}
