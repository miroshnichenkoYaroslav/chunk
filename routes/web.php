<?php

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

use App\Adapters\Chunks\ChunkToBlade\Adapter;

Route::get('/', function () {

    $chunk = new Adapter();
    $chunk->run('0481E31883BA4F199ABB5DD19A4B0169');

    return view('welcome');
});

Route::get('/form', function () {
    return view('chunks.form');
});
Route::get('/chunk/{chunk}', 'ChunksController@test');


