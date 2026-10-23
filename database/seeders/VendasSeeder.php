<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;

class VendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria vendas e cada venda gera automaticamente sua avaliação 1:1 via VendaFactory
        Venda::factory()->count(50)->create();
    }
}
