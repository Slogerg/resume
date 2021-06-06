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
});

$namespace = [
    'namespace' => 'App\Http\Controllers'
];
Route::group($namespace, function (){
    //Resume
    $methods = ['index','create','store'];
    Route::resource('resume','ResumeController')
        ->only($methods);
    Route::get('resume/searchName','ResumeController@searchName')->name('resume.searchName');
    Route::get('resume/searchDate','ResumeController@searchDate')->name('resume.searchDate');
    Route::get('resume/orderNew','ResumeController@orderNew')->name('resume.orderNew');
    Route::get('resume/orderOld','ResumeController@orderOld')->name('resume.orderOld');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
