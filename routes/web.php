<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProducsController; 
use App\http\Controllers\ClientController;
use App\http\Controllers\AdminController;
use App\http\Controllers\AttributeController;
use App\Models\Role; 

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

    Route::prefix('/attribute')->name('Attribute.')->group(function(){ 
        Route::get('/', [AttributeController::class, 'list'])->name('List'); 
        Route::get('create', [AttributeController::class, 'create'])->name('Create');
        Route::Post('store', [AttributeController::class, 'store'])->name('Store'); 
        Route::delete('delete', [AttributeController::class, 'delete'])->name('Delete'); 
        Route::get('edit/{attr?}', [AttributeController::class, 'edit'])->name('Edit'); 
        Route::post('update', [AttributeController::class, 'update'])->name('Update'); 
        Route::delete('delete/{attr?}', [AttributeController::class, 'delete'])->name('Delete'); 
    });
}); 