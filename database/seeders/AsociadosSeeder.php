<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AsociadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asociados')->insert(
            [
                'nombres' => 'Juan',
                'apellidopaterno' => 'Perez',
                'apellidomaterno' => 'Gomez',
                'numerodepadron' =>'0001',
                'dni' => '12345678',
                'estadodepago' => 'activo',
                'estado' => 'activo',
                'created_at' => date("Y-m-d H:i:s")
    
            ]);
    }
}
