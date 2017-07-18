<?php

Route::post('auth', 'Auth\LoginController@makeAuth');
Route::post('register', 'Auth\RegisterController@register');


Auth::routes();


Route::match(['get', 'post'], '/', 'PageController@index');
Route::get('/page/news/{id?}', 'PageController@news');
Route::match(['get', 'post'], '/page/{name}', 'PageController@getPage');
Route::post('/mail', 'OrderController@sendMail');
Route::post('/reviews', 'PageController@sendReviews');
Route::get('/admin', 'PageController@toAdmin');

Route::match(['get', 'post'], '/page/gallery/{album_name}', 'PageController@getAlbum');


// Route::post('/sendform', 'OrderController@corporateOrder');



//Auth::routes();
//Route::get('admin', 'AdminController@loginForm');
//Route::get('login', function() {
//    return redirect('/admin');
//});
//Route::post('admin', 'AdminController@login');
//Route::post('logout', 'AdminController@logout')->middleware('auth');
//Route::get('users/{id?}', 'AdminController@users')->middleware('auth');
//Route::get('orders', 'AdminController@orders')->middleware('auth');
//Route::get('edit/gallery', 'AdminController@editGallery')->middleware('auth');
//Route::post('edit/gallery', 'AdminController@uploadPhoto')->middleware('auth');
//Route::delete('edit/gallery', 'AdminController@deletePhoto')->middleware('auth');
//Route::get('test', 'AdminController@test');

//Route::get('test', 'OrderController@checkOrder');
//Route::get('/', 'OrderController@sendEmail');
//Route::get('/dd', 'OrderController@getOrdersToday');
//Route::get('/make', 'OrderController@makeOrder');

Auth::routes();

Route::get('/home', 'HomeController@index');
