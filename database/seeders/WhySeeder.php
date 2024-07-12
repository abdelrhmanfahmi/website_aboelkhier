<?php

namespace Database\Seeders;

use App\Models\Why;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Why::create([
            'title' => 'Why One',
            'description' => 'description',
            'image' => ''
        ]);

        Why::create([
            'title' => 'Why One',
            'description' => 'description',
            'image' => ''
        ]);

        Why::create([
            'title' => 'Why One',
            'description' => 'description',
            'image' => ''
        ]);
    }
}
