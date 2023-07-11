<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProducsController; 
use App\http\Controllers\ClientController;
use App\http\Controllers\AdminController;
use App\http\Controllers\AttributeController;
use App\Models\Role;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::prefix('/')->name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('client'); 
    
});
Route::get('/somthing', function () {
    redirect('/'); // redirect to '/' trỏ tới route '/'
});

Route::get('/products', function () {
    return view('index');
});
Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/attribute', [AttributeController::class, 'index'])->name('AttributeIndex'); 
    Route::get('/attribute/create', [AttributeController::class, 'create'])->name('AttributeCreate');
    Route::Post('/attribute/store', [AttributeController::class, 'store'])->name('AttributeStore'); 

});