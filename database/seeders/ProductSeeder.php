<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'name' => 'Sambal Terasi',
            'description' => 'Sambal terasi pedas dengan rasa khas Indonesia.',
            'price' => 15000,
            'image' => 'terasi.jpg'
        ]);
    }
}
