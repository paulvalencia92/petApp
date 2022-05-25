<?php

use App\Models\Pet;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsCount = Tag::query()->count();

        factory(Pet::class, 10)->create()->each(function ($pet) use ($tagsCount) {
            $pet->tags()->attach($this->array(rand(1, $tagsCount)));
        });
    }


    public function array($max)
    {
        $values = [];

        for ($i = 1; $i < $max; $i++) {
            $values[] = $i;
        }

        return $values;


    }
}
