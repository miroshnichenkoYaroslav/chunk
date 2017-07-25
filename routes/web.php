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
use App\Adapters\Chunks\BladeToChunk\Adapter as reAdapter;


Route::get('/', function () {

    $chunk = new Adapter;
    //$chunk->run('testA29E38A8447FEAE5F5809B7E77390');

    $reChunk = new reAdapter;
    $reChunk->run('testA29E38A8447FEAE5F5809B7E77390');

    return view('welcome');
});

Route::get('/form', function () {
    return view('chunks.form');
});
Route::get('/chunk/{chunk}', 'ChunksController@test');










