<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asociado extends Model
{
    use HasFactory;
    protected $fillable = [
        'numerodepadron',
        'nropadron2024',
        'nombres',
        'apellidomaterno',
        'apellidopaterno',
        'dni',
        'estado',
        'estado2',
        'sexo',
        'fechanacimiento',
        'distritonacimiento',
        'provincianacimiento',
        'departamentonacimiento',
        'gradoestudio',
        'estadocivil',
        'nombreconyuge',
        'dniconyuge',
        'domicilio',
        'telefono',
        'email',
        'fechadeingreso',
        'tomo2006',
        'foliodeingreso',
        'referencia_ano',
        'referencia_tomo',
        'referencia_folio',
        'cargo',
        'actividad',
        'tomo_padroanterior',
        'ano_padronanterior',
        'nro_padronanterior',
        'folio_padronanterior',
        'formadeadquisicion',
        'coposesionario',
        'cantidad-stands',
        'estadoreempadronamiento',
        'fecha_reempadronamiento',
        'foto',
    ];
}
