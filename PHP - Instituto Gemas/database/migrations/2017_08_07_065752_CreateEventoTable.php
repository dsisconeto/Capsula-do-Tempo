<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('slug', 200);
            $table->string('capa', 50)->nullable();
            $table->text('descricao');
            $table->string('endereco', 255)->nullable();
            $table->dateTime('data')->nullable();
            $table->text('galleria')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
