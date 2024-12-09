<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    public function run()
    {
        DB::table('enderecos')->insert([
            'rua' => 'Rua Principal',
            'numero' => '123',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'cep' => '01001-000',
            'complemento' => 'Apartamento 101',
            'cliente_id' => 1, // ID do cliente existente
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
