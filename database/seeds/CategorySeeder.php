<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Perro']);
        Category::create(['name' => 'Gato']);
        Category::create(['name' => 'Hámster']);
        Category::create(['name' => 'Pájaro']);
    }
}
