<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrendaCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenda_categorias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('id_categoria')->unsigned();
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
            $table->bigInteger('id_prenda')->unsigned();
            $table->foreign('id_prenda')->references('id_prenda')->on('prendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prenda_categorias');
    }
}
