<?php

namespace Database\Seeders;

use App\Models\Myschedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MyscheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Myschedule::factory()->create();
    }
}
