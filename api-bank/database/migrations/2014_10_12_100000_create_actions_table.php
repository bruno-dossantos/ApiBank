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
            $table->unsignedBigInteger('source');
            $table->foreign('source')->references('id')->on('users');
            $table->unsignedBigInteger('destiny')->nullable();
            $table->foreign('destiny')->references('id')->on('users');
            $table->enum('type', ['Transferir', 'Retiro', 'Deposito']);
            $table->integer('amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
