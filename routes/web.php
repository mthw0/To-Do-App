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
    Route::get('hotovo/{todo}', [TodoController::class, 'toggle_done']);
    Route::post('store-data', [TodoController::class, 'store']);
    Route::get('/', [TodoController::class,'index'])->name('dashboard');

});





require __DIR__ . '/auth.php';
