<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta-origen');
            $table->foreign('cuenta-origen')->references('id')->on('users');
            $table->unsignedBigInteger('cuenta-destino')->nullable();
            $table->foreign('cuenta-destino')->references('id')->on('users');
            $table->enum('tipo-accion', ['Transferir', 'Retiro', 'Deposito']);
            $table->integer('balance');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actions');
    }
}