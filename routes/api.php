<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookController as Book;
use App\Http\Controllers\Api\V1\AuthorController as Author;
use App\Http\Controllers\AuthController as Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//RUTA DE REGISTRO//

Route::post('sign_up', [Auth::class, 'sign_up']);//ok
Route::post('login', [Auth::class, 'login']);//ok
Route::post('logout', [Auth::class, 'logout']);//ok

Route::middleware(['auth:sanctum', 'solo_usuario_administrador'])->get('books',[Book::class, 'index']);


//RUTAS DE BOOKS//

// Route::get('books',[Book::class, 'index']);//recibe dos argunmentos, la url y lo que me trae,
//llama al controlador y al metodo index
Route::get('books/title={value}',[Book::class,'getByTitle']);
Route::get('books/{id}',[Book::class,'getById']);

Route::post('books/{author_id}',[Book::class, 'store']);
// Route::post('books',[Book::class, 'store']);

// Route::middleware(['auth:sanctum', 'solo_usuario_administrador'])->delete('books/{id}',[Book::class,'destroy']);
Route::delete('books/{id}',[Book::class,'destroy']);
Route::put('books',[Book::class,'update']);

//RUTAS AUTORES//

Route::get('authors',[Author::class, 'index']);
Route::get('authors/name={value}',[Author::class,'getByName']);
Route::get('authors/{id}',[Author::class,'getById']);

Route::post('authors',[Author::class, 'store']);

Route::delete('authors/{id}',[Author::class,'destroy']);

Route::put('authors',[Author::class,'update']);
