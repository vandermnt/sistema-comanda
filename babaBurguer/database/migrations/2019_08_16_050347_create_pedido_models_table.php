<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pedido_models', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('carrinho_id')->nullable();
          $table->unsignedInteger('produto_id')->nullable();
          $table->integer('qtde_produto');
          $table->string('adicionais');
          $table->unsignedInteger('mesa_id');
          $table->unsignedInteger('pedidolevar_id');
          $table->boolean('status')->nullable();
          $table->string('obs');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_models');
    }
}
