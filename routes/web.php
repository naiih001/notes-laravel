<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController; 

Route::get('/', function () {
    return view('welcome');
});

Route::resource('notes', NoteController::class);