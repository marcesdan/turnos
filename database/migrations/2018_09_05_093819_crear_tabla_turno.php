<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTurno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turno', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->boolean('reservado');
            $table->boolean('confirmado');
            $table->unsignedInteger('paciente_id')->nullable();
            $table->unsignedInteger('medico_id');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('paciente')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('medico_id')
                ->references('id')
                ->on('medico')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('turno');
    }
}
