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

        Route::post('/message/send', ['as' => 'sendMessage', 'uses' =>'MainController@sendMessage']);   //Send Message

        Route::post('/upload/file', ['as' => 'uploadFiles', 'uses' =>'MainController@uploadFiles']);   //Send Message

});

//----------------------UserController----------------------------------------------
Route::group(['middleware' => 'auth'], function () {

        Route::get('/profile/u{id}', ['as' => 'userProfile', 'uses' =>'UserController@profile']);   //User Profile Page

        Route::post('/profile/changeimage', ['as' => 'updateProfilePic', 'uses' =>'UserController@updateProfilePic']);   //User Profile Page
        
        Route::get('/profile/info', ['as' => 'personalInformation', 'uses' =>'UserController@personalInformation']);   //User Profile Page

        Route::post('/updatepassword', ['as' => 'updatePassword',   'uses' => 'UserController@updatePassword']);    //Account Information

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
Route::group(['prefix' => 'market','middleware' => 'auth'], function () {

        Route::get('/', ['as' => 'marketplace', 'uses' =>'MarketController@marketplace']);   //Marketplace

        Route::get('/{id?}/item/{slug?}', ['as' => 'productDetail', 'uses' =>'MarketController@productDetail']);   //Product Detail

        Route::get('/add', ['as' => 'addMarket', 'uses' =>'MarketController@add']);   //Add New Product to Market

        Route::post('/add/submit', ['as' => 'addMarketSubmit', 'uses' =>'MarketController@addSubmit']);   //Add Product Submit

        Route::post('/add/imageupload', ['as' => 'addMarketImageSubmit', 'uses' =>'MarketController@addImageSubmit']);   //Add Image Upload Submit

        Route::get('/mymarket', ['as' => 'myMarket', 'uses' =>'MarketController@myMarket']);   //My Market

        Route::get('/edit/{id?}', ['as' => 'editMarket', 'uses' =>'MarketController@edit']);   //Add New Product to Market

        Route::post('/edit/submit', ['as' => 'editMarketSubmit', 'uses' =>'MarketController@editSubmit']);   //Edit Product Submit

        Route::post('/update/status', ['as' => 'updateMarketStatus', 'uses' =>'MarketController@updateMarketStatus']);   //Edit Product Submit



});


//----------------------ScholarshipController----------------------------------------------
Route::group(['prefix' => 'scholarship','middleware' => 'auth'], function () {

        Route::get('/', ['as' => 'scholarship', 'uses' =>'ScholarshipController@scholarship']);   //Scholarship Home Page

        Route::get('/myscholarships', ['as' => 'myScholarship', 'uses' =>'ScholarshipController@myScholarship']);   //My Scholarships (Institutes/Schools)

        Route::get('/{id?}/item/{slug?}', ['as' => 'scholarshipDetail', 'uses' =>'ScholarshipController@scholarshipDetail']);   //Scholarship Details

        Route::get('/add/{type?}', ['as' => 'addScholarship', 'uses' =>'ScholarshipController@addscholarship']);   //Add Scholarship (Normal and Linked)

        Route::post('/add/submit', ['as' => 'addScholarshipSubmit', 'uses' =>'ScholarshipController@addScholarshipSubmit']);   //Add Scholarship Submit (Normal and Linked)

        Route::get('/edit/{type?}/{id?}', ['as' => 'editScholarship', 'uses' =>'ScholarshipController@editscholarship']);   //Edit Scholarship (Normal and Linked)

        Route::post('/edit/submit', ['as' => 'editScholarshipSubmit', 'uses' =>'ScholarshipController@editScholarshipSubmit']);   //Edit Scholarship Submit (Normal and Linked)

        Route::get('/edit/{id?}', ['as' => 'editScholarship', 'uses' =>'ScholarshipController@editScholarship']);   //Edit Scholarship (Normal and Linked)

        Route::post('/edit/submit', ['as' => 'editScholarshipSubmit', 'uses' =>'ScholarshipController@editScholarshipSubmit']);   //Edit Scholarship Submit (Normal and Linked)

        Route::post('/update/status', ['as' => 'updateScholarshipStatus', 'uses' =>'ScholarshipController@updateScholarshipStatus']);   //Edit Product Submit
});

//----------------------InternshipController----------------------------------------------
Route::group(['prefix' => 'internship','middleware' => 'auth'], function () {

        Route::get('/', ['as' => 'internship', 'uses' =>'InternshipController@internship']);   //Internship Home Page

        Route::get('/myinternships', ['as' => 'myInternship', 'uses' =>'InternshipController@myInternship']);   //My Internships (Institutes/Schools)

        Route::get('/{id?}/item/{slug?}', ['as' => 'internshipDetail', 'uses' =>'InternshipController@internshipDetail']);   //Internship Details

        Route::get('/add/{type?}', ['as' => 'addInternship', 'uses' =>'InternshipController@addinternship']);   //Add Internship (Normal and Linked)

        Route::post('/add/submit', ['as' => 'addInternshipSubmit', 'uses' =>'InternshipController@addInternshipSubmit']);   //Add Internship Submit (Normal and Linked)

        Route::get('/edit/{type?}/{id?}', ['as' => 'editInternship', 'uses' =>'InternshipController@editInternship']);   //Edit Internship (Normal and Linked)

        Route::post('/edit/submit', ['as' => 'editInternshipSubmit', 'uses' =>'InternshipController@editInternshipSubmit']);   //Edit Internship Submit (Normal and Linked)

        Route::get('/edit/{id?}', ['as' => 'editInternship', 'uses' =>'InternshipController@editInternship']);   //Edit Internship (Normal and Linked)

        Route::post('/edit/submit', ['as' => 'editInternshipSubmit', 'uses' =>'InternshipController@editInternshipSubmit']);   //Edit Internship Submit (Normal and Linked)

        Route::post('/update/status', ['as' => 'updateInternshipStatus', 'uses' =>'InternshipController@updateInternshipStatus']);   //Edit Product Submit
});