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
//Route::get('/formation','App\Http\Controllers\FormationController@index')->name('formation.index');
Route::get('/', function () {
    return view('welcome');
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');*/
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/formation','App\Http\Controllers\FormationController@index')->name('formation.index');

    Route::get('formation/add', function () {
        return Inertia\Inertia::render('formation/AddFormation');
    })->name('formation.add');
    Route::get('formation/{id}','App\Http\Controllers\FormationController@show')->name('formation.show');
    Route::post('/formations','App\Http\Controllers\FormationController@store');
    Route::post('/completion','App\Http\Controllers\FormationController@toggleCompletion')->name('episode.completion');
    Route::get('/formations/edit/{id}','App\Http\Controllers\FormationController@edit');
    Route::patch('/formations/{id}','App\Http\Controllers\FormationController@update');
    Route::delete('/formations/delete/{id}','App\Http\Controllers\FormationController@destroy');

    });