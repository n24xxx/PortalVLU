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




Route::prefix('admin')->group(function(){
  //authenticate admin login
  Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login/submit','Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
  //authenicate admin route
  Route::group(['middleware'=>['auth:admin']],function(){
    Route::get('/dashboard','PIController@index')->name('admin.pi.dashboard');
    Route::get('/pi-list','PIController@index')->name('admin.pi.index');
    //pi detail
    Route::get('/pi-detail/{id}','PIController@getdetail')->name('pi.detail');
    //add personal information
    Route::get('/pi-add','PIController@getAdd')->name('admin.pi.add');
    Route::post('/pi-add','PIController@postAdd')->name('admin.pi.add');
    //update personal information
    Route::get('/pi-update/{id}','PIController@getupdate')->name('admin.pi.update');
    Route::post('/pi-update/{id}','PIController@postupdate')->name('admin.pi.update');
  });
});


Route::prefix('')->group(function(){
  //authenticate admin login/logout
  Route::get('/login','Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
  Route::post('/login','Auth\EmployeeLoginController@login')->name('employee.login');
  Route::get('/logout','Auth\EmployeeLoginController@logout')->name('employee.logout');
  //authenicate admin route
  Route::group(['middleware'=>['auth:employee']],function(){

    Route::get('/pi-detail/{id}','PIController@getupdate')->name('employee.pi.detail');
    Route::get('/pi-update/{id}','PIController@getupdate')->name('employee.pi.update');
    Route::post('/pi-update/{id}','PIController@postupdate')->name('employee.pi.update');
  });
});

//show detail a persional
