<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('propiedad_id')->unsigned();
            $table->decimal('precio');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('propiedad_id')->references('id')->on('propiedades');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semanas');
    }
}
