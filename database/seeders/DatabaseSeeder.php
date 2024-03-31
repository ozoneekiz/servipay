<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asociado;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(100)->create();
        $this->call(UsersSeeder::class);
        $this->call(AsociadosSeeder::class);

        
    }
}
