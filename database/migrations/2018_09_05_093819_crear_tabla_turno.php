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
            $table->datetime('reservado')->nullable();
            $table->datetime('confirmado')->nullable();
            $table->datetime('finalizado')->nullable();
            $table->unsignedInteger('paciente_id')->nullable();
            $table->unsignedInteger('medico_id')->nullable();

            $table->foreign('paciente_id')
                ->references('id')
                ->on('paciente')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('medico_id')
                ->references('id')
                ->on('medico')
                ->onDelete('set null')
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
