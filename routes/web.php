<?php

use App\Models\Pet;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/tests', function (){
   return  $tags = \App\Models\Tag::query()->get()->random(1,5);

});


Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
