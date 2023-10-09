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
        'name' => $name,
        'email' => $email,
        '--password' => $password
    ]);
});

Route::get('test-queue', function () {
//    Artisan::call('queue:work --once');
    Artisan::call('queue:work');
});


Route::get('test-event/{name}', function ($name) {
// Được sử dụng để kích hoạt sự kiện và gọi các listener (nghe sự kiện) liên quan trực tiếp.
// Sự kiện sẽ được xử lý đồng bộ, nghĩa là mã xử lý sự kiện sẽ được thực thi ngay lập tức khi bạn gọi event()
   \App\Events\EventSendMail::dispatch($name);
//    event(new \App\Events\EventSendMail($name));
});
