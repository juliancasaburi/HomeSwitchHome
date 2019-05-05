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
            $table->boolean('activa');
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('password');
            $table->smallInteger('creditos')->default(2);
            $table->decimal('saldo', 7,2)->default(0.0);
            $table->string('tarjeta_credito', 30)->nullable();
            $table->string('tarjeta_debito', 30)->nullable();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nacionalidad', 30);
            $table->string('DNI', 40);
            $table->date('fecha_nacimiento');
            $table->boolean('premium');
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
