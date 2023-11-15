<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointment_status')->insert([
            ['name' => 'Pendiente', 'type' => 'appointments'],
            ['name' => 'Confirmado', 'type' => 'appointments'],
            ['name' => 'Cancelado', 'type' => 'appointments'],
        ]);
    }
}
