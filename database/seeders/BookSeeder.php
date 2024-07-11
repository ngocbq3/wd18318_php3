<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            'title' => fake()->text(25),
            'thumbnail' => fake()->imageUrl(),
            'author' => fake()->name() . ' ' . fake()->firstName() . ' ' . fake()->lastName(),
            'pubisher' => fake()->text('30'),
            'publication' => fake()->dateTime(),
            'price' => rand(1, 200),
            'quantity' => rand(1, 4000),
            'category_id' => rand(1, 4)
        ]);
    }
}
