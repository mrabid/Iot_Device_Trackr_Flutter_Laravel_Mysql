<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // First, let's create 10 devices
        $devices = [];
        for ($i = 1; $i <= 10; $i++) {
            $devices[] = [
                'name' => 'Device ' . $i,
                'location' => 'Location ' . $i,
                'device_id' => 'DEV-' . str_pad($i, 3, '0', STR_PAD_LEFT), // Add this line
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('devices')->insert($devices);

        // Now create temperature and humidity readings for each device
        $readings = [];
        $now = Carbon::now();

        foreach (range(1, 10) as $deviceId) {
            // Create 50 readings per device (you can adjust this number)
            foreach (range(1, 50) as $index) {
                $timestamp = $now->copy()->subMinutes($index * 15);

                $readings[] = [
                    'device_id' => $deviceId,
                    'temperature' => rand(180, 320) / 10, // Random temp between 18.0°C and 32.0°C
                    'humidity' => rand(300, 800) / 10,    // Random humidity between 30.0% and 80.0%
                    'recorded_at' => $timestamp,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }

        DB::table('device_readings')->insert($readings);
    }
}
