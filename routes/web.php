<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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


Route::name('dashboard.')->middleware('auth')->group(function(){
    // Task Manager Routes 
    Route::get('all-tasks',[TaskController::class,'index'])->name('tasks.all');
    Route::get('tasks/edit/{id}',[TaskController::class,'edit'])->name('tasks.edit');
});
Route::get('/dashboard', function () {
    return view('dashboard');
    
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
