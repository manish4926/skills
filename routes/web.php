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


//-----------------Filtering Routes Based on Controllers---------------------------

Route::get('/', ['as' => 'home', 'uses' =>'MainController@openMainPage']);	//Home Page Without Login

//----------------------AuthController----------------------------------------------
Route::post('/registeruser', ['as' => 'registerMethod', 'uses' => 'AuthController@postRegister']);	//Register Method

Route::post('/loginuser', ['as' => 'loginMethod', 'uses' => 'AuthController@postSignIn']);	//Login Method

Route::get('/logout', [	'as' => 'logoutMethod', 'middleware' => 'auth', 'uses' => 'AuthController@getLogout']);	//LogOut Method

Route::get('/password/reset/{token?}', ['as' => 'forgotpasswordreset', 'uses' => 'Auth\PasswordController@showResetForm']);  //Show Reset Form (Forgot Password)

Route::post('/password/email', ['as' => 'forgotpassword', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);  //Forgot Password Method

Route::post('/password/reset', ['as' => 'passwordreset', 'uses' => 'Auth\PasswordController@reset']);  //Reset Forgotted Password

Route::get('/facebookoauth', [ 'as' => 'facebooklogin', 
                        'uses' => 'AuthController@facebookLogin'
                        ]); //Facebook Login Page

Route::get('/facebookcallback', [ 'as' => 'facebookcallback', 
                        'uses' => 'AuthController@facebookCallBackUrl'
                        ]); //Facebook Redirect Url Page

Route::get('/googleoauth', [ 'as' => 'googlelogin', 
                        'uses' => 'AuthController@googleLogin'
                        ]); //Google Login page

Route::get('/googlecallback', [ 'as' => 'googlecallback', 
                        'uses' => 'AuthController@googleCallBackUrl'
                        ]); //Google Login Redirect

//----------------------MainController----------------------------------------------
Route::get('/contact', ['as' => 'contact', 'uses' => 'MainController@contact']);	//Contact Page

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' =>'MainController@dashboard']);	//Home Page After Login

	Route::get('/groups', ['as' => 'groups', 'uses' =>'MainController@groups']);	//View Groups

	Route::post('/groups/create', ['as' => 'creategroup', 'uses' =>'MainController@createGroup']);	//Create Groups

	Route::post('/groups/groupfollow', ['as' => 'groupfollow', 'uses' =>'MainController@groupFollow']);	//Create Groups

	Route::post('/groups/groupunfollow', ['as' => 'groupunfollow', 'uses' =>'MainController@groupunfollow']);	//Create Groups

	Route::get('/groups/g{id}', ['as' => 'groupdetail', 'uses' =>'MainController@groupDetail']);	//Create Groups

});

