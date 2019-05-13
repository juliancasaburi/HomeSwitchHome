<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('pais');
            $table->string('provincia');
            $table->string('localidad');
            $table->string('calle');
            $table->string('numero');
            $table->decimal('precio', 9,2);
            $table->tinyInteger('estrellas');
            $table->tinyInteger('capacidad');
            $table->tinyInteger('habitaciones');
            $table->tinyInteger('baños');
            $table->tinyInteger('capacidad_vehiculos');
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('propiedades');
    }
}
