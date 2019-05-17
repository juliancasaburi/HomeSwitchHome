<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subastas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('semana_id')->unsigned()->index();
            $table->decimal('precio_inicial', 9, 2);
            $table->dateTime('inscripcion_inicio');
            $table->dateTime('inscripcion_fin');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->timestamps();

            $table->foreign('semana_id')->references('id')->on('semanas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subastas');
    }
}
