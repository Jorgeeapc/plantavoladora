<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('cliente_rut')->nullable();
            $table->string('cliente_nombres')->nullable();
            $table->string('cliente_apellido_p')->nullable();
            $table->string('cliente_apellido_m')->nullable();
            $table->string('cliente_correo')->nullable();
            $table->integer('cliente_telefono')->nullable();
            $table->string('cliente_calle')->nullable();
            $table->integer('cliente_casa')->nullable();
            $table->bigInteger('id_comuna')->unsigned()->nullable();
            $table->foreign('id_comuna')->references('id_comuna')->on('comunas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
