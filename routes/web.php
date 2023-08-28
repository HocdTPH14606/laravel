<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProducsController; 
use App\http\Controllers\ClientController;
use App\http\Controllers\AdminController;
use App\http\Controllers\AttributeController;
use App\http\Controllers\ProductController;
use App\http\Controllers\ProductAttributeController;
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
        Route::Post('store1', [AttributeController::class, 'store1'])->name('Store1'); 
        Route::Post('store2', [AttributeController::class, 'store2'])->name('Store2'); 
        Route::delete('delete1/{id?}', [AttributeController::class, 'delete1'])->name('Delete1'); 
        Route::delete('delete2/{id?}', [AttributeController::class, 'delete2'])->name('Delete2'); 
        Route::get('edit/{id?}', [AttributeController::class, 'edit'])->name('Edit'); 
        Route::post('update1', [AttributeController::class, 'update1'])->name('Update1'); 
        Route::post('update2', [AttributeController::class, 'update2'])->name('Update2'); 
        Route::delete('delete/{id?}', [AttributeController::class, 'delete'])->name('Delete'); 
    });

    Route::prefix('/product')->name('Product.')->group(function(){ 
        Route::get('/', [ProductController::class, 'list'])->name('List'); 
        Route::get('create', [ProductController::class, 'create'])->name('Create');
        Route::Post('store', [ProductController::class, 'store'])->name('Store'); 
        Route::delete('delete', [ProductController::class, 'delete'])->name('Delete'); 
        Route::get('edit/{product?}', [ProductController::class, 'edit'])->name('Edit'); 
        Route::post('update', [ProductController::class, 'update'])->name('Update'); 
        Route::delete('delete/{product?}', [ProductController::class, 'delete'])->name('Delete'); 
        Route::get('/changeDiscount', [ProductController::class, 'changeDiscount'])->name('changeDiscount'); //product.changeStatus
        Route::get('/changeStatus', [ProductController::class, 'changeStatus'])->name('changeStatus');  
        Route::get('detail/{id?}', [ProductController::class, 'detail'])->name('Detail');  
    });
}); 