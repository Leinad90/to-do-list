<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;


/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/', [TodoController::class, 'store'])->name('todos.store');
Route::put('/', [TodoController::class, 'setDone'])->name('todos.setDone');
Route::delete('/',  [TodoController::class, 'destroy'])->name('todos.destroy');
