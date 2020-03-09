<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(); // SEM ELE APARECE QUE A ROTA LOGIN NÃO FOI ENCONTRADA
if(version_compare(PHP_VERSION, '7.2.0', '>=')) { error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); }

Route::group(['middleware' => 'auth'], function() {
  Route::get('/teste', 'PedidoController@t');
  Route::get('/', 'PedidoController@mostrarPedidos');
  Route::post('/fechar-mesa', 'PedidoController@fecharMesa');
  Route::post('/fechar-pedido', 'PedidoController@fecharPedidoLevar');
  Route::post('/relatorio', 'PedidoController@gerarRelatorio');
  Route::get('/mesas', 'PedidoController@verMesas');
  Route::get('/relatoriodata', 'PedidoController@escolherData');
  Route::get('/delete/{id}', 'PedidoController@deleteItem');
  Route::get('/imprimir', 'PedidoController@imprimirComanda');


});


Route::group(['middleware' => 'authGarcom:garcom'], function() {
  Route::get('/garcom', 'PedidoController@mostrarMesas');
  Route::get('/mesa/{id}', 'PedidoController@escolherMesa');
  Route::get('/cliente/{id}', 'PedidoController@escolherCliente');
  Route::get('/lanchee/{id}', 'PedidoController@escolherLanche');

  Route::get('/lanche/{id}', 'PedidoController@escolherLancheLevar');
  Route::get('/bebida-levar/{id}', 'PedidoController@escolherBebidasLevar');
  Route::get('/porcao-classica/{id}', 'PedidoController@escolherPorClassicaLevar');
  Route::get('/porcao-doce/{id}', 'PedidoController@escolherPorDoceLevar');
  Route::get('/porcaoe-especial/{id}', 'PedidoController@escolherPorEspecialLevar');
  Route::get('/pastas-levar/{id}', 'PedidoController@escolherPastasLevar');
  Route::get('/chopp-levar/{id}', 'PedidoController@escolherChoppLevar');

  Route::get('/levar/{id}', 'PedidoController@escolherNomeLevar');
  Route::get('/porcaoclassica/{id}', 'PedidoController@escolherPorClassica');
  Route::get('/porcaodoce/{id}', 'PedidoController@escolherPorDoce');
  Route::get('/porcaoespecial/{id}', 'PedidoController@escolherPorEspecial');
  Route::get('/pastas/{id}', 'PedidoController@escolherPastas');
  Route::get('/bebida/{id}', 'PedidoController@escolherBebidas');
  Route::get('/chopp/{id}', 'PedidoController@escolherChopp');
  Route::get('/garcom/logout', 'GarcomController@logout');
  Route::get('/pedido-levar', 'PedidoController@levar');
  Route::get('/novopedido', 'PedidoController@novoPedido');
  Route::post('/cadastrarpedido', 'PedidoController@cadPedido');
  Route::post('/save', 'PedidoController@salvarPedido');
  Route::post('/save-levar', 'PedidoController@salvarPedidoLevar');

});

Route::get('/garcom/login', 'GarcomController@login')->name('loginGarcom');
Route::post('/garcom/login', 'GarcomController@postLogin');



// Route::get('/lanche/{id}', function () {
//   return view('garcom_escolher_lanche')->with('$id_mesa', $id);
// });

// Route::get('/', function() {
//   return Redirect::to('/relatoriodata');
// });


Route::get('/logout', function() {
  Auth::logout();
  return Redirect::to('/');
});

Route::get('/home', 'HomeController@index')->name('home');
