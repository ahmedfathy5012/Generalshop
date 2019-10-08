<?php

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
use App\Address;
use App\User;
use App\product;
use App\Image;
use App\Tag;
use App\Role;


Route::get('tags_test', function () {
  $tag = Tag::find(2);
  return $tag->products;
});


Route::get('roles_test1', function () {
  $role = Role::find(1);
  return $role->users;
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('test-login', function(){
  return 'hello' ;
})->middleware(['auth','email_verified','mobile_verified']);


Route::get('check_user_is_admin', function(){
  return 'hello' ;
})->middleware(['auth','user_is_admin']);



Route::get('check_user_is_support', function(){
  return 'hello' ;
})->middleware(['auth','user_is_support']); 


  Route::group(['auth','user_is_admin'],function(){
    // units
  route::get('units','UnitController@index')->name('units');
  route::post('units','UnitController@store');
  route::delete('units','UnitController@delete');
  route::put('units','UnitController@update');
  route::get('search-units','UnitController@search')->name('search-units');
    //Categories
  route::get('categories','CategoryController@index')->name('categories');
  route::post('categories','CategoryController@store');
  route::delete('categories','CategoryController@delete');
  route::put('categories','CategoryController@update');
  route::get('search-categories','CategoryController@search')->name('search-categories');


   //Products
   route::get('products','productController@index')->name('products');
   route::get('new-product','productController@newProduct')->name('new-product');
   route::post('new-product','productController@store');
   route::post('delete-image','productController@deleteImage')->name('delete-image');
   route::get('update-product/{id}','productController@newProduct')->name('update-product-form');
   route::put('new-product','productController@update')->name('update-product');
   route::delete('new-product/{id}','productController@delete');


   
    //Tags
   route::get('tags','TagController@index')->name('tags');
   route::post('tags','TagController@store');
   route::delete('tags','TagController@delete');
   route::put('tags','TagController@update');
   route::get('search-tags','TagController@search')->name('search-tags');


   //Payments
//route::get('payments','PaymentsController@index')->name('payments');
   //Orders
 //  route::get('ordets','OrdersController@index')->name('orders');
  //Shipments
 // route::get('shipments','ShipmentsController@index')->name('shipments');


  // Countries
  route::get('countries','CountryController@index')->name('countries');
  //Cities
  route::get('cities','CityController@index')->name('cities');
  //States
  route::get('states','StateController@index')->name('states');
  
  //Reviews
   route::get('reviews','ReviewController@index')->name('reviews');
  //Tickets
   route::get('tickets','TicketController@index')->name('tickets');
  

  //Roles
  route::get('roles','RoleController@index')->name('roles');
   });