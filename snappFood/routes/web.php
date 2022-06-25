<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siteController;
use App\Http\Controllers\adminController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/admin/home',[siteController::class,'showAdminHome']);
Route::get('/admin/categories',[siteController::class,'showAdminCategories'])->name('adminCategory');
Route::get('/admin/discount',[siteController::class,'showAdminDiscount']);
Route::post('/admin/category/add',[adminController::class,'addCategory']);
Route::post('/admin/category/delete',[adminController::class,'deleteCategory']);
Route::post('/admin/category/edit',[adminController::class,'editCategory']);
Route::post('/admin/category/edit/save',[adminController::class,'editCategorySave']);
Route::get('/admin/admin/discount',[siteController::class,'showAdminDiscount'])->name('adminDiscount');
Route::post('/admin/discount/add',[adminController::class,'addDiscount']);
Route::post('/admin/discount/delete',[adminController::class,'deleteDiscount']);
Route::post('/admin/discount/edit',[adminController::class,'editDisount']);
Route::post('/admin/discount/edit/save',[adminController::class,'editDiscountSave']);
