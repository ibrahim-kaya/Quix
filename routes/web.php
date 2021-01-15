<?php

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
})->middleware('guest');

Route::middleware(['auth:sanctum', 'verified'])->get('/anasayfa', function () {
    return view('dashboard');
})->name('anasayfa');

Route::group([
    'middleware' => ['auth','isAdmin'],
    'prefix'=>'admin'
    ], function () {

    //admin func

});

Route::resource('quiz', \App\Http\Controllers\TestController::class);
Route::resource('quizler', \App\Http\Controllers\QuizController::class);
Route::resource('quizlerim', \App\Http\Controllers\EditQuiz::class);
Route::post('sonuc', '\App\Http\Controllers\TestController@sonuc')->name('sonuc');
Route::get('sonuc/{id}/{uniqueid}', '\App\Http\Controllers\TestController@sonucGoster')->name('sonuc_Goster');
Route::get('kategori/{ktgid}', '\App\Http\Controllers\KategoriController@show');
Route::resource('quiz/{uniqueid}/sorular', \App\Http\Controllers\SoruController::class);
Route::get('quiz/{uniqueid}/sorular/{soruid}/sil', '\App\Http\Controllers\SoruController@soruSil');
Route::post('yayinlandi', '\App\Http\Controllers\QuizController@yayinlandi')->name('yayinlandi');
