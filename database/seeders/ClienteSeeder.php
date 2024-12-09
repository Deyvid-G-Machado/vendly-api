<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            'nome' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'senha' => bcrypt('12345678'),
            'cpf' => '123.456.789-01',
            'telefone' => '(11) 98765-4321',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
