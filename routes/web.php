<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Command line artisan
// php artisan make:command CreatedMultiUsers


Route::get('/', function () {
    return view('welcome');
});

// Chay command line
Route::get('command-add-users/{name}/{email}/{password?}', function ($name, $email, $password = '12345678') {
    Artisan::call('app:created-multi-users', [
        'name' => $name, 'email' => $email, '--password' => $password
    ]);
});
