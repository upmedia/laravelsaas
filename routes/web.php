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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.'], function() {
    Route::get('/', 'Account\AccountController@index')->name('index');

    /** Profile */
    Route::get('/profile', 'Account\ProfileController@index')->name('profile.index');
    Route::post('/profile', 'Account\ProfileController@store')->name('profile.store');

    /** Password */
    Route::get('/password', 'Account\PasswordController@index')->name('password.index');
    Route::post('/password', 'Account\PasswordController@store')->name('password.store');

});

Route::group(['prefix' => 'activation', 'as' => 'activation.', 'middleware' => ['guest']], function() {
    Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');
    Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');
    Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');
});

/**
 * Account activation
 */
Route::group(['prefix' => 'plans', 'as' => 'plans.'], function() {
    Route::get('/', 'Subscription\PlanController@index')->name('index');
    Route::get('/teams', 'Subscription\PlanTeamController@index')->name('teams.index');
});

/**
 * Subscription
 */
Route::group(['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' => ['auth.register']], function() {
    Route::get('/', 'Subscription\SubscriptionController@index')->name('index');
    Route::post('/', 'Subscription\SubscriptionController@store')->name('store');
});