<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        //
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            'libelle' => 'Roman',
        ]);
        DB::table('categories')->insert([
            'libelle' => 'Fiction'
        ]);
        DB::table('categories')->insert([
            'libelle' => 'Jeunesse'
        ]);
    }
}
