<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociados', function (Blueprint $table) {
        $table->id();
        $table->string('numerodepadron', 10);
        $table->string('nropadron2024', 10)->nullable();
        $table->string('nombres', 50);
        $table->string('apellidomaterno', 50);
        $table->string('apellidopaterno', 50)->nullable();
        $table->string('dni', 8);
        $table->string('estadodepago',15);
        $table->string('estado', 15);
        $table->string('sexo', 2)->nullable();
        $table->date('fechanacimiento')->nullable();
        $table->string('distritonacimiento', 50)->nullable();
        $table->string('provincianacimiento', 50)->nullable();
        $table->string('departamentonacimiento', 50)->nullable();
        $table->string('gradoestudio', 50)->nullable();
        $table->string('estadocivil', 50)->nullable();
        $table->string('nombreconyuge', 50)->nullable();
        $table->string('dniconyuge', 8)->nullable();
        $table->string('domicilio', 240)->nullable();
        $table->string('telefono', 9)->nullable();
        $table->string('email', 80)->nullable();
        $table->date('fechadeingreso')->nullable();
        $table->string('tomo2006', 2)->nullable();
        $table->string('foliodeingreso', 5)->nullable();
        $table->string('referencia_ano', 15)->nullable();
        $table->string('referencia_tomo', 2)->nullable();
        $table->string('referencia_folio', 4)->nullable();
        $table->string('cargo', 15)->nullable();
        $table->string('actividad', 20)->nullable();
        $table->string('tomo_padroanterior',2)->nullable();
        $table->string('ano_padronanterior', 15)->nullable();
        $table->string('nro_padronanterior', 5)->nullable();
        $table->string('folio_padronanterior', 5)->nullable();
        $table->string('formadeadquisicion', 12)->nullable();
        $table->string('coposesionario', 2)->nullable();
        $table->string('cantidad-stands', 3)->nullable();
        // estadoreempadronamiento INT 2 NULL
        $table->tinyInteger('estadoreempadronamiento')->default(0);
        $table->date('fecha_reempadronamiento')->nullable();
        //notas muchos caracteres text
        $table->text('notas')->nullable();
        $table->string('foto', 50)->nullable();
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
        Schema::dropIfExists('asociados');
    }
}
