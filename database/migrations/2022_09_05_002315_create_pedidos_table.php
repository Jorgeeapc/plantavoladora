<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('comentarios');
            $table->integer('telefono');
            $table->integer('largo');
            $table->integer('busto');
            $table->integer('cintura');
            $table->integer('cantidad');
            $table->bigInteger('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('users');
            $table->bigInteger('id_prenda')->unsigned();
            $table->foreign('id_prenda')->references('id_prenda')->on('prendas');
            $table->bigInteger('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id_estado')->on('estados');
            $table->bigInteger('id_comprasprenda')->unsigned();
            $table->foreign('id_comprasprenda')->references('id')->on('comprasprendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
