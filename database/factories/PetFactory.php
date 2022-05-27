<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{Pet, Category};
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Pet::class, function (Faker $faker) {
    return [
        'category_id' => Category::query()->pluck('id')->random(),
        'name' => $faker->name,
//        'photoUrls' => $faker->imageUrl(800, 600),
        'photoUrls' => "pet_default.png",
        'status' => Arr::random(Pet::availableValues()),
    ];
});
