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
    // return redirect()->route('category.show', ['slug' => 'books']);
});

Route::prefix('basics')->group(function(){

  Route::get('/merhaba', function(){
    return ['message' => 'Merhaba API'];
  });

  Route::get('/merhaba-json', function(){
    return response(['message' => 'Merhaba API'], 200)
    ->header('Content-Type', 'application/json');
  });

  Route::get('/merhaba-json2', function(){
    return response()->json(['message' => 'Merhaba API']);
  });

  Route::get('/product/{id}/{type?}', function($id, $r_type = 'girilmedi'){
    return "product id: $id, Type: $r_type";
  });

  Route::get('/category/{slug}', function($slug){
    return "category Slug: $slug";
  })->name('category.show');

});

Route::get('/product/{id}/{type?}', 'ProductController@show')->name('product.show');

Route::resource('/products', 'ProductController')->only(['index', 'show']);
Route::resource('/products', 'ProductController')->except(['destroy']);
