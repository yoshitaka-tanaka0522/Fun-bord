<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

//Route::resource('bulletin', BulletinBoardController::class);
Route::get('bulletin','BulletinBoardController@index');

//認証が完了した場合に初期画面に遷移する
//->nameを付けることでview側からroute('bulletin.index')で画面を呼び出せる。
Route::group(['prefix' => 'bulletin','middleware' => 'auth'],function() {
    Route::get('/','BulletinBoardController@index')->name('bulletin.index');
    Route::get('/create','BulletinBoardController@create')->name('bulletin.create');
    Route::post('/store','BulletinBoardController@store')->name('bulletin.store');
    //https://readouble.com/laravel/8.x/ja/routing.html(ルートパラメータ)
    Route::get('/show/{id}','BulletinBoardController@show')->name('bulletin.show');
    Route::get('/edit/{id}','BulletinBoardController@edit')->name('bulletin.edit');
    Route::post('/update/{id}','BulletinBoardController@update')->name('bulletin.update');
    Route::post('/destroy/{id}','BulletinBoardController@destroy')->name('bulletin.destroy');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/{bulletin}/comments', 'CommentController@store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
