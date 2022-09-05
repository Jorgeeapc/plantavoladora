<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasprendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprasprendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('precio_total')->nullable();
            $table->integer('cantidad');
            $table->bigInteger('id_compra')->unsigned()->nullable();
            $table->foreign('id_compra')->references('id_compra')->on('compras');
            $table->bigInteger('id_prenda')->unsigned()->nullable();
            $table->foreign('id_prenda')->references('id_prenda')->on('prendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprasprendas');
    }
}
