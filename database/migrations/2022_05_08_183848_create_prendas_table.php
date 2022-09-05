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
            $table->integer('precio_venta')->nullable();
            $table->string('categoria');
            $table->string('descripcion');
            $table->string('img')->nullable();
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
