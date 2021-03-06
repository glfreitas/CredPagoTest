<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('home');
*/

require __DIR__ . '/auth.php';
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('sites', SitesController::class);
Route::get('/testsite/{id}', [SitesController::class, 'testsite'])->name('testsite');
Route::get('/testsites', [SitesController::class, 'testsites'])->name('testsites');