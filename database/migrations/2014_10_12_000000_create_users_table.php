<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('activa')->default(1);
            $table->string('email', 50)->unique();
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('pais', 60);
            $table->string('DNI', 40);
            $table->date('fecha_nacimiento');
            $table->smallInteger('creditos')->default(2);
            $table->decimal('saldo', 9,2)->default(0.00);
            $table->string('password');
            $table->string('numero_tarjeta', 16)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('premium')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
