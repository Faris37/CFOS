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


Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage.users')->group(function(){
    Route::resource('/users','UsersController',['except'=> ['show','create','store']]);
    Route::get('/users/organization', 'UsersController@organization')->name('users.organization');
    Route::get('/users/add', 'UsersController@add')->name('users.add');
    Route::post('/users/UserData' , 'UsersController@UserData')->name('users.UserData');
    Route::get('/users/Oadd', 'UsersController@Oadd')->name('users.Oadd');
    Route::post('/users/OaddData' , 'UsersController@OaddData')->name('users.OaddData');
    //ni auto admin

});

Route::namespace('Parent')->prefix('parent')->name('parent.')->middleware('can:parent.users')->group(function(){
    Route::resource('/Childrens','ChildrensController');
    Route::get('/Childrens/editing/{id}/{date}', 'ChildrensController@editing')->name('Childrens.editing');
    Route::get('/Childrens/backing/{id}', 'ChildrensController@backing')->name('Childrens.backing');
    Route::get('/Childrens/menuEdit/{id}/{menu_id}', 'ChildrensController@menuEdit')->name('Childrens.menuEdit');
});

Route::namespace('Menu')->prefix('menu')->name('menu.')->middleware('can:parent.users')->group(function(){
    Route::resource('/Menu','MenuController');
});


Route::namespace('Canteen')->prefix('canteen')->name('canteen.')->middleware('can:edit.canteen')->group(function(){
    Route::resource('/Canteen','CanteenController');
    Route::post('/Canteen/search', 'CanteenController@search')->name('Canteen.search');
});

Route::namespace('Manageorder')->prefix('manageorder')->name('manageorder.')->middleware('can:edit.canteen')->group(function(){
    Route::resource('/Manageorder','Morder');
});

Route::namespace('COrder')->prefix('corder')->name('corder.')->middleware('can:parent.users')->group(function(){
    Route::resource('/COrder','COrderController');
});

Route::namespace('Payment')->prefix('pay')->name('pay.')->middleware('can:parent.users')->group(function(){
    Route::resource('/Payment','PayController');
});

Route::namespace('Teacher')->prefix('Teacher')->name('Teacher.')->middleware('can:teacher.users')->group(function(){
    Route::resource('/Teacher','TeacherController');
});

Route::namespace('Admin')->prefix('Admin')->name('Admin.')->middleware('can:School.Admin')->group(function(){
    Route::get('/Users/mainAdmin', 'UsersController@mainAdmin')->name('SchAdm.mainAdmin');
    Route::post('/Users/mainSearch', 'UsersController@mainSearch')->name('SchAdm.mainSearch');
    Route::post('/Users/inactiveUser' , 'UsersController@inactiveUser')->name('SchAdm.inactiveUser');
    Route::get('/Users/updateUser/{id}', 'UsersController@updateUser')->name('SchAdm.updateUser');
    Route::post('/Users/updateDataUser' , 'UsersController@updateDataUser')->name('SchAdm.updateDataUser');
    Route::get('/Users/addUser', 'UsersController@addUser')->name('SchAdm.addUser');
    Route::get('/Users/bannedMenu', 'UsersController@bannedMenu')->name('SchAdm.bannedMenu');
    Route::post('/Users/searchBanned', 'UsersController@searchBanned')->name('SchAdm.searchBanned');
    Route::get('/Users/deleteBanned/{id}', 'UsersController@deleteBanned')->name('SchAdm.deleteBanned');
    Route::get('/Users/addBanned', 'UsersController@addBanned')->name('SchAdm.addBanned');
    Route::post('/Users/addDataBanned' , 'UsersController@addDataBanned')->name('SchAdm.addDataBanned');
    Route::get('/Users/priceMenu', 'UsersController@priceMenu')->name('SchAdm.priceMenu');
    Route::post('/Users/searchpriceMenu', 'UsersController@searchpriceMenu')->name('SchAdm.searchpriceMenu');
    Route::get('/Users/editpriceMenu/{id}', 'UsersController@editpriceMenu')->name('SchAdm.editpriceMenu');
    Route::post('/Users/editDatapriceMenu' , 'UsersController@editDatapriceMenu')->name('SchAdm.editDatapriceMenu');
    Route::get('/Users/addpriceMenu' , 'UsersController@addpriceMenu')->name('SchAdm.addpriceMenu');
});