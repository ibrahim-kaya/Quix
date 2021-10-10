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

Route::middleware(['auth:sanctum', 'verified'])->get('/anasayfa', '\App\Http\Controllers\QuizController@anasayfa')->name('anasayfa');

Route::group([
    'middleware' => ['auth','isAdmin'],
    'prefix'=>'admin'
    ], function () {

    //admin func

});

Route::resource('quiz', \App\Http\Controllers\TestController::class);
Route::resource('quizler', \App\Http\Controllers\QuizController::class);
Route::resource('quizlerim', \App\Http\Controllers\EditQuiz::class);
Route::post('yayinlandi', '\App\Http\Controllers\QuizController@yayinlandi')->name('yayinlandi');
Route::post('oyla', '\App\Http\Controllers\QuizController@oyVer');

//Sorular
Route::resource('quiz/{uniqueid}/sorular', \App\Http\Controllers\SoruController::class);
Route::get('quiz/{uniqueid}/sorular/{soruid}/sil', '\App\Http\Controllers\SoruController@soruSil');
Route::post('quiz/{uniqueid}/sorular/{soruid}/guncelle', '\App\Http\Controllers\SoruController@soruGuncelle')->name('soru_guncelle');

// Sonuç
Route::post('sonuc', '\App\Http\Controllers\TestController@sonuc')->name('sonuc');
Route::get('sonuc/{id}/{uniqueid}', '\App\Http\Controllers\TestController@sonucGoster')->name('sonuc_Goster');

// Kategori
Route::get('kategori/{ktgid}', '\App\Http\Controllers\KategoriController@show')->name('kategori');
Route::post('kategori/{ktgid}', '\App\Http\Controllers\KategoriController@TakipEtVeyaBirak')->name('kategori_takip');

//Profil
Route::get('profil/{username}', '\App\Http\Controllers\ProfilController@index')->name('profil');

// Düello
Route::get('duello', '\App\Http\Controllers\DuelloController@index')->middleware(['auth:sanctum', 'verified'])->name('duellolarim');
Route::get('duello/olustur', '\App\Http\Controllers\DuelloController@hazirla')->middleware(['auth:sanctum', 'verified'])->name('duello_olustur');
Route::post('duello/olustur', '\App\Http\Controllers\DuelloController@olustur')->middleware(['auth:sanctum', 'verified']);
Route::get('duello/{uniqueid}', '\App\Http\Controllers\DuelloController@onizleme')->middleware(['auth:sanctum', 'verified'])->name('duello_onizleme');
Route::post('duello/{uniqueid}', '\App\Http\Controllers\DuelloController@testEkrani')->middleware(['auth:sanctum', 'verified'])->name('testEkrani');
Route::post('duello/{uniqueid}/red', '\App\Http\Controllers\DuelloController@reddet')->middleware(['auth:sanctum', 'verified'])->name('duello_red');
Route::get('duello/sonuc/{uniqueid}', '\App\Http\Controllers\DuelloController@sonuc')->middleware(['auth:sanctum', 'verified'])->name('duello_sonuc');
Route::get('autocomplete', '\App\Http\Controllers\DuelloController@autocomplete')->name('autocomplete');

//Credits
Route::get('/credits', function () {
    return view('credits.resimler');
})->name('credits_1');
Route::get('/credits/sec-2', function () {
    return view('credits.sec-2');
})->name('credits_2');
Route::get('/credits/sec-3', function () {
    return view('credits.sec-3');
})->name('credits_3');
