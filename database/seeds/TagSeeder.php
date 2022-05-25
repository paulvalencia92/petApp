<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Amigable']);
        Tag::create(['name' => 'de raza']);
        Tag::create(['name' => 'Rapido']);
        Tag::create(['name' => 'Dormilon']);
        Tag::create(['name' => 'Jugueton']);
        Tag::create(['name' => 'Dañido']);
        Tag::create(['name' => 'Ruidoso']);
    }
}
