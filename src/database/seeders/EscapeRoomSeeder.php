<?php

namespace Database\Seeders;

use App\Models\EscapeRoom;
use Illuminate\Database\Seeder;

class EscapeRoomSeeder extends Seeder
{
    public function run(): void
    {
        EscapeRoom::factory()->count(10)->create();
    }
}
