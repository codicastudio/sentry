<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

function verifyCredentials($username, $password)
{
    Log::info('Verifying credentials');
    $user = DB::table('users')->where('name', $username)->first();
    // in the real world, we'd have some logic here
    throw new Exception('Invalid password!');
}


function authenticateUser()
{
    Log::info('Authenticating the current user');
    verifyCredentials('jane_doe99', 'fizzbuzz');
}


Route::get('/', function () {
    Log::info('Rendering a page thats about to error');
    authenticateUser();
})->name('index');

Route::get('login', function () {
    return 'This represents a login page we are redirect to if we need to login.';
})->name('login');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('protected', function () {
        Log::info('Rendering a page thats about to error and protected with the auth middleware');
        authenticateUser();
    })->name('index');
});

Route::get('/welcome/{id}', 'HomeController@showWelcome')->name('welcome');
