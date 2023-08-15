<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerbaikanController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/asset/select', 'AssetController@select')->name('asset.select');

Route::get('search', 'AssetController@search')->name('search');

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');



Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('asset', AssetController::class);
    Route::get('/asset/perbaikan/{asset}', 'AssetController@perbaikan')->name('asset.perbaikan');
    Route::get('/asset/perbaikancreate/{asset}', 'AssetController@perbaikancreate')->name('asset.perbaikancreate');
    Route::get('/asset/{asset}/perbaikanedit', 'AssetController@perbaikanedit')->name('asset.perbaikanedit');
    Route::post('/asset/perbaikanstore', 'AssetController@perbaikanstore')->name('asset.perbaikanstore');
    Route::put('/asset/perbaikanupdate/{asset}', 'AssetController@perbaikanupdate')->name('asset.perbaikanupdate');
    Route::delete('/asset/perbaikan/{asset}', 'AssetController@perbaikandestroy')->name('asset.perbaikandestroy');
    
    Route::get('/asset/penyusutan/{asset}', 'AssetController@penyusutan')->name('asset.penyusutan');

    Route::get('/asset/lokasi/{asset}', 'AssetController@lokasi')->name('asset.lokasi');

    Route::get('/qrcode', 'AssetController@qrcode')->name('asset.qrcode');
});
