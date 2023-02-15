<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //el metodo up intenta crear la tabla y si no
    //se hace va directamente a borrar en el down que esta abajo
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
            ->references('id')//esto es para cuando se elimine algo se haga en cascada
            ->on('users')
            ->delete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //aqui es donde borra
    {
        Schema::dropIfExists('books');
    }
};
