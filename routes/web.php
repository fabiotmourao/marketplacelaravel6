<?php

use Illuminate\Support\Facades\Route;
use App\User;
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

Route::get('/','HomeController@index')->name('home');
Route::get('/product/{slug}','HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function() {
    // Rotas do carrinho de compras
    Route::get('/','CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function() {
    // Rotas de Checkout
    Route::get('/','CheckoutController@index')->name('index');
    Route::post('/proccess','CheckoutController@proccess')->name('proccess');
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        // Rotas de Loja/Store
            Route::prefix('stores')->name('stores.')->group(function() {
                Route::get('/', 'StoreController@index')->name('index');
                Route::get('/create','StoreController@create')->name('create');
                Route::post('/store','StoreController@store')->name('store');
                Route::get('/{id}/edit','StoreController@edit')->name('edit');
                Route::put('/update/{id}','StoreController@update')->name('update');
                Route::delete('/remover/{id}', 'StoreController@remover')->name('remover');
            });
            
        // Rotas de Produtos/Product
            Route::prefix('products')->name('products.')->group(function() {
                Route::get('/', 'ProductController@index')->name('index');
                Route::get('/create','ProductController@create')->name('create');
                Route::post('/store','ProductController@store')->name('store');
                Route::get('/{id}/edit','ProductController@edit')->name('edit');
                Route::put('/update/{id}','ProductController@update')->name('update');
                Route::delete('/remover/{id}', 'ProductController@remover')->name('remover');
            });

        // Rotas de Categorias/Category
            Route::prefix('categories')->name('categories.')->group(function() {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create','CategoryController@create')->name('create');
            Route::post('/store','CategoryController@store')->name('store');
            Route::get('/{id}/edit','CategoryController@edit')->name('edit');
            Route::put('/update/{id}','CategoryController@update')->name('update');
            Route::delete('/remover/{id}', 'CategoryController@remover')->name('remover');
            });

        // Rota de Remover Photos
            Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');        
        });    
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
