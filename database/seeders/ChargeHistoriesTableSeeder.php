<?php

namespace Database\Seeders;

use App\Models\ChargeHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChargeHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChargeHistory::create([
            'user_id' => 1,
            'amount' => 50.00,
            'comment' => 'Payment for service A',
            'date' => now(),
        ]);

        ChargeHistory::create([
            'user_id' => 2,
            'amount' => 100.00,
            'comment' => 'Payment for service B',
            'date' => now(),
        ]);
    }
}
