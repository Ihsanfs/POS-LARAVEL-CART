<?php

namespace Database\Seeders;

use App\Models\produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            produk::create([
                'nama' => $faker->word,
                'harga' => $faker->randomFloat(2, 10, 1000),
                'satuan' => $faker->randomElement(['kg', 'pcs', 'liter']),
            ]);
        }
    }
}
