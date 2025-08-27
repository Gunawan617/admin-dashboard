<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 10 dummy visits
        for ($i = 1; $i <= 10; $i++) {
            Visit::create([
                'ip_address' => '192.168.1.' . $i,
                'user_agent' => 'DummyAgent/' . $i,
                'url' => '/dummy-url-' . $i,
                'referrer' => 'https://example.com/ref' . $i,
                'created_at' => now()->subDays($i),
                'updated_at' => now()->subDays($i),
            ]);
        }
    }
}
