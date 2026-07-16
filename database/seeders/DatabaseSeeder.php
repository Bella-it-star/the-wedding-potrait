<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 3 data tamu contoh untuk uji coba aplikasi
        Guest::create([
            'name' => 'Halimatus Sa\'diah',
            'invited_count' => 2, // Kuota 2 orang
            'category' => 'VIP',
            'table_number' => 'V-01',
        ]);

        Guest::create([
            'name' => 'Budi Setiadi',
            'invited_count' => 4, // Kuota 4 orang
            'category' => 'Keluarga Utama',
            'table_number' => 'A-05',
        ]);

        Guest::create([
            'name' => 'Siti Aminah',
            'invited_count' => 1, // Kuota 1 orang
            'category' => 'Teman Kuliah',
            'table_number' => 'B-12',
        ]);
    }
}