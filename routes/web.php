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

});

//----------------------GroupController----------------------------------------------
Route::group(['middleware' => 'auth'], function () {

        Route::get('/groups', ['as' => 'groups', 'uses' =>'GroupController@groups']);   //View Groups

        Route::post('/groups/create', ['as' => 'creategroup', 'uses' =>'GroupController@createGroup']); //Create Groups

        Route::post('/groups/groupfollow', ['as' => 'groupfollow', 'uses' =>'GroupController@groupFollow']);    //Follow Groups

        Route::post('/groups/groupunfollow', ['as' => 'groupunfollow', 'uses' =>'GroupController@groupunfollow']);      //Unfollow Groups

        Route::get('/groups/g{id}', ['as' => 'groupdetail', 'uses' =>'GroupController@groupDetail']);   //View  Groups Detail

});


//----------------------MarketController----------------------------------------------
Route::group(['middleware' => 'auth'], function () {

        Route::get('market/add', ['as' => 'addMarket', 'uses' =>'MarketController@add']);   //Add New Product to Market

        Route::post('market/add/submit', ['as' => 'addMarketSubmit', 'uses' =>'MarketController@addSubmit']);   //Add Product Submit

        Route::post('market/add/imageupload', ['as' => 'addMarketImageSubmit', 'uses' =>'MarketController@addImageSubmit']);   //Add Product Submit


});
