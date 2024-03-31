<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Historialdepadron extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historialdepadron', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('asociado_id');
            $table->integer('añodepadron');
            $table->string('tomo', 2); 
            $table->string('folio', 5);
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('asociado_id')->references('id')->on('asociados')->onDelete('cascade');
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
