<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory()
            ->count(10)
            ->has(TransactionDetail::factory()->count(3), 'transactionDetails')
            ->create();
    }
}
