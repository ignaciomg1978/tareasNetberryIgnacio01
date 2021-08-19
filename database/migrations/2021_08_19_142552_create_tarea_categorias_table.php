<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarea_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->timestamps();

            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarea_categorias');
    }
}
