<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('funcionarios')->insert([
            'nome' => 'Deyvid',
            'email' => 'deyvid@example.com',
            'senha' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
