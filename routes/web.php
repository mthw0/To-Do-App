<?php

use App\Http\Controllers\TodoController;
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

Route::middleware('auth')->group(function (){
    Route::get('create', [TodoController::class, 'create']);
    Route::get('show/{todo}', [TodoController::class, 'show']);
    Route::get('edit/{todo}', [TodoController::class, 'edit']);
    Route::post('update/{todo}', [TodoController::class, 'update']);
    Route::get('delete/{todo}', [TodoController::class, 'delete']);
    Route::delete('/todo/{id}', [TodoController::class, 'delete2'])->name('todo.delete');
    Route::get('undelete/{todo}', [TodoController::class, 'undelete']);
    Route::get('hotovo/{todo}', [TodoController::class, 'toggle_done']);
    Route::post('store-data', [TodoController::class, 'store']);
    Route::get('/', [TodoController::class,'index']);
    Route::get('/fetch', [TodoController::class,'fetch']);
    Route::get('/send',[TodoController::class, 'send'])->name('send');;

});


require __DIR__ . '/auth.php';
