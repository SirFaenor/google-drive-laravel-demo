<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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


/**
 * Lista dei contenuti di una risorsa
 */
Route::get("drive/list", function() {
    
    // id della directory a partire da directory root del disco
    // config: filesystem.disks.google.folder_id
    $dir = '';

    // recupero ricorsivo
    $recursive = false;

    $contents = Storage::disk('google')->listContents($dir, $recursive);

    return $contents;

    // filtro opzionale su tipo di file (creando Collection)
    // $contents = collect($contents);
    //return $contents->where('type', '=', 'file'); // files
    //return $contents->where('type', '=', 'file'); // files

});


/**
 * Creazione di un nuovo file
 */
Route::get("drive/put", function() {
    
    return Storage::disk('google')->put("test.txt", "Hello world!");

});


/**
 * Download di un file
 */
Route::get("drive/download", function() {

    // path come restituito da /list
    $path = '1Bk0p-PXtNSHZdECq8AeN2u_2PSjuZ4IC'; 
    
    // name come restituito da /list, per avere corrispondenza di nomi
    $name = 'text.txt';

    return Storage::disk('google')->download($path, $name);

});