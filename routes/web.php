<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Barang;
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

Route::get('/', 'App\Http\Controllers\BarangController@index')->middleware('auth');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard','App\Http\Controllers\BarangController@dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('barang', Barang::class)->name('barang');
});
