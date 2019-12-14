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
Route::get('/', 'PagesController@home');

Route::get('/about', 'PagesController@about');
// Route::get('/contact', 'PagesController@contact');
//create ticket
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
//get all tickets
Route::get('/tickets', 'TicketsController@index');
// get current ticket
Route::get('/ticket/{slug?}', 'TicketsController@show');
//edit current ticket
Route::get('/ticket/{slug?}/edit', 'TicketsController@edit');
Route::post('/ticket/{slug?}/edit', 'TicketsController@update');
//delete ticket
Route::post('/ticket/{slug?}/delete', 'TicketsController@destroy');

//pašto siuntimas
Route::get('sendemail', function () {
    $data = array(
      'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('fmrcsender@gmail.com', 'Learning Laravel');
        $message->to('fmrcsender@gmail.com')->subject('Learning Laravel test email');
    });

    return "Your email has been sent successfully";
});

//comment create new
Route::post('/comment', 'CommentsController@newComment');

//user registration
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
//logout
Route::get('users/logout', 'Auth\LoginController@logout');
//login
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('users/login', 'Auth\LoginController@login');

//all list blog
Route::get('/blog', 'BlogController@index');
//open one page
Route::get('/blog/{slug?}', 'BlogController@show');



//adminpanel routes
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);

    //user edit
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit', 'UsersController@update');


    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');

    Route::get('/', 'PagesController@home');

    Route::get('posts', 'PostsController@index');
    Route::get('posts/create', 'PostsController@create');
    Route::post('posts/create', 'PostsController@store');
    Route::get('posts/{id?}/edit', 'PostsController@edit');
    Route::post('posts/{id?}/edit', 'PostsController@update');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@create');
    Route::post('categories/create', 'CategoriesController@store');
});
