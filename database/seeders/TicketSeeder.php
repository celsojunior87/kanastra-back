<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('ticket')->insert([
            'name' => 'Celso da silva couto junior',
            'debtID' => 1,
            'governmentId' => 156156151,
            'email' =>'juniorcoutodf@gmail.com',
            'debtAmount'=> 47.50,
            'debtDueDate'=>'2024-05-27 14:30:00'
        ]);
    }
}
