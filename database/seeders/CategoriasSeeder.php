<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(['nombre' => 'PHP',]);
        DB::table('categorias')->insert(['nombre' => 'Javascript',]);
        DB::table('categorias')->insert(['nombre' => 'CSS',]);
    }
}
