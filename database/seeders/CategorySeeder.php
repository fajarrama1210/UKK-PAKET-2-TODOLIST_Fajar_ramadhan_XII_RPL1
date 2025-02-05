<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pekerjaan'],
            ['name' => 'Pribadi'],
            ['name' => 'Mendesak'],
            ['name' => 'Belajar'],
            ['name' => 'Keuangan'],
            ['name' => 'Kesehatan'],
            ['name' => 'Belanja'],
            ['name' => 'Rumah Tangga'],
            ['name' => 'Hobi'],
            ['name' => 'Sosial'],
            ['name' => 'Acara'],
            ['name' => 'Proyek'],
            ['name' => 'Perjalanan'],
            ['name' => 'Kebugaran'],
            ['name' => 'Relawan'],
            ['name' => 'Pengembangan Diri'],
            ['name' => 'Teknologi'],
            ['name' => 'Pemrograman'],
            ['name' => 'Hiburan'],
            ['name' => 'Perawatan'],
        ];
        DB::table('categories')->insert($categories);
    }
}
