<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prendas', function (Blueprint $table) {
            $table->id('id_prenda');
            $table->timestamps();
            $table->string('material_prenda');
            $table->string('color_prenda');
            $table->integer('stock_prenda');
            $table->integer('precio_prenda');
            $table->bigInteger('id_compra')->unsigned();
            $table->foreign('id_compra')->references('id_compra')->on('compras')->onDelete('cascade');
            $table->bigInteger('id_talla')->unsigned();
            $table->foreign('id_talla')->references('id_talla')->on('tallas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prendas');
    }
}
