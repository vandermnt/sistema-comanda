<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrinhoModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinho_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_mesa');
            $table->unsignedInteger('id_pedidolevar');
            $table->date('data_compra');
            $table->boolean('status')->nullable();
            $table->double('valor')->nullable();
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
        Schema::dropIfExists('carrinho_models');
    }
}
