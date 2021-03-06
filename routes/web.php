<?php

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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function()
{

Route::resource('categorys', App\Http\Controllers\CategorysController::class);

Route::resource('subcategories', App\Http\Controllers\SubcategoryController::class);

Route::resource('parentcategories', App\Http\Controllers\ParentcategoryController::class);

Route::resource('childcategories', App\Http\Controllers\ChildcategoryController::class);

Route::resource('products', App\Http\Controllers\ProductController::class);

Route::resource('productPartNumbers', App\Http\Controllers\Product_part_numberController::class);

Route::resource('specifications', App\Http\Controllers\SpecificationController::class);

Route::resource('specificationTypes', App\Http\Controllers\Specification_typeController::class);

Route::post('getspecificationtype',[App\Http\Controllers\Specification_typeController::class, 'getspecificationtype'])->name('getspecificationtype');
});



Route::prefix('website')->group(function () {
    Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
    Route::get('/listparent/{subcat_id}', [App\Http\Controllers\FrontendController::class, 'parentcats'])->name('website.parentcats');
    Route::get('/parts/{product_id}', [App\Http\Controllers\FrontendController::class, 'productpartnumber'])->name('website.productpartnumber');
});

Route::post('addtocart',[App\Http\Controllers\CartController::class, 'addtocart'])->name('add-to-cart');
Route::get('/cartloadbyajax',[App\Http\Controllers\CartController::class, 'cartloadbyajax'])->name('load-cart-data');
Route::get('/cartdata',[App\Http\Controllers\CartController::class, 'cartdata'])->name('cartdata');
Route::get('/clearcart',[App\Http\Controllers\CartController::class, 'clearcart'])->name('clear-cart');


Route::get('/website/product/{childcat_id}', [App\Http\Controllers\FrontendController::class, 'product'])->name('website.product');
Route::get('/website/part/{product_id}', [App\Http\Controllers\FrontendController::class, 'part'])->name('website.part');
