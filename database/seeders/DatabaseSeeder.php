<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(500)->create();
        Payment::factory()->count(1000)->create();
        Message::factory()->count(1000)->create();
    }
}
