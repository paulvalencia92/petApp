<?php

use App\Http\Controllers\{PetController, CategoryController, TagController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/pets', [PetController::class, 'index']);
Route::get('/pet/findByStatus', [PetController::class, 'findByStatus']);
Route::get('/pet/{pet}', [PetController::class, 'show']);
Route::post('/pet', [PetController::class, 'store']);
Route::put('/pet/{pet}', [PetController::class, 'update']);
Route::delete('/pet/{pet}', [PetController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/tags', [TagController::class, 'index']);


