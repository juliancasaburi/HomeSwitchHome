<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('semana_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->decimal('valor_reservado', 9, 2);
            $table->tinyInteger('modo_reserva');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('semana_id')->references('id')->on('semanas');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
