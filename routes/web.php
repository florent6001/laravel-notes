<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route resource for notes, except the update
Route::resource('notes', App\Http\Controllers\NotesController::class)->except(['update', 'edit', 'show']);
