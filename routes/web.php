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

        Route::get('/inbox', ['as' => 'inbox', 'uses' =>'MainController@getMessages']);   //Messages List

        Route::get('/inbox/{id?}/conversation', ['as' => 'getMessagesConversation', 'uses' =>'MainController@getMessagesConversation']);   //Message Conversation

        Route::post('/message/send', ['as' => 'sendMessage', 'uses' =>'MainController@sendMessage']);   //Send Message

        Route::post('/upload/file', ['as' => 'uploadFiles', 'uses' =>'MainController@uploadFiles']);   //Upload File 

        Route::get('/download/{file?}', ['as' => 'downloadFile', 'uses' =>'MainController@downloadFile']);   //Download File

        Route::get('/search/{query?}', ['as' => 'search', 'uses' =>'MainController@search']);   //Search

        Route::get('/connections', ['as' => 'followers', 'uses' =>'MainController@followers']);   //Followers/Followings

});

//----------------------UserController----------------------------------------------
Route::group(['middleware' => 'auth'], function () {

        Route::get('/profile/u{id}', ['as' => 'userProfile', 'uses' =>'UserController@profile']);   //User Profile Page

        Route::post('/profile/changeimage', ['as' => 'updateProfilePic', 'uses' =>'UserController@updateProfilePic']);   //User Profile Page
        
        Route::get('/profile/info', ['as' => 'personalInformation', 'uses' =>'UserController@personalInformation']);   //User Profile Page

        Route::post('/profile/info/submit', ['as' => 'personalInformationSubmit', 'uses' =>'UserController@personalInformationSubmit']);   //Update Personal Information

        Route::post('/updatepassword', ['as' => 'updatePassword',   'uses' => 'UserController@updatePassword']);    //Account Information

        Route::get('/profile/sections/{id}/{section_id}', ['as' => 'profileSection ', 'uses' =>'UserController@profileSection']);   //User Profile Section

        Route::get('/profile/sectionsforms/{id}/{section_id}/{tok}', ['as' => 'profileSectionForm ', 'uses' =>'UserController@profileSectionForm']);   //User Profile Section Forms

        Route::get('/profile/savetypeitem', ['as' => 'saveTypeItem', 'uses' =>'UserController@saveTypeItem']);   //User Profile Page

        Route::post('/deleteexperience', ['as' => 'deleteExperience',   'uses' => 'UserController@deleteExperience']);    //Delete User Experience

        Route::post('/followuser', ['as' => 'followUser',   'uses' => 'UserController@followUser']);    //Follow/Unfollow User

        Route::get('/newsfeeds', ['as' => 'newsfeeds', 'uses' =>'UserController@newsfeeds']);   //Newsfeeds

        Route::get('/myactivity', ['as' => 'myActivity', 'uses' =>'UserController@myActivity']);   //My Activities

        Route::post('/newsfeeds/post/submit', ['as' => 'newsFeedPostSubmit', 'uses' =>'UserController@newsFeedPostSubmit']);   //Newsfeed Post Submit

        Route::post('/newsfeeds/imageupload', ['as' => 'addNewsFeedPostImageSubmit', 'uses' =>'UserController@addNewsFeedPostImageSubmit']);   //Add Image Upload Submit to Newsfeed
        
});

//----------------------GroupController----------------------------------------------
Route::group(['middleware' => 'auth'], function () {

        Route::get('/groups', ['as' => 'groups', 'uses' =>'GroupController@groups']);   //View Groups

        Route::post('/groups/create', ['as' => 'creategroup', 'uses' =>'GroupController@createGroup']); //Create Groups

        Route::post('/groups/changegroupimage', ['as' => 'changeGroupImage', 'uses' =>'GroupController@changeGroupImage']); //Update Group Image

        Route::post('/groups/updategroupinfo', ['as' => 'updateGroupInfo', 'uses' =>'GroupController@updateGroupInfo']); //Update Group Info

        Route::post('/groups/groupfollow', ['as' => 'groupfollow', 'uses' =>'GroupController@groupFollow']);    //Follow Groups

        Route::post('/groups/groupunfollow', ['as' => 'groupunfollow', 'uses' =>'GroupController@groupunfollow']);      //Unfollow Groups

        Route::get('/groups/g{id}', ['as' => 'groupdetail', 'uses' =>'GroupController@groupDetail']);   //View  Groups Detail

        Route::post('/group/imageupload', ['as' => 'addGroupPostImageSubmit', 'uses' =>'GroupController@addGroupPostImageSubmit']);   //Add Image Upload Submit

        Route::post('/group/post/submit', ['as' => 'groupPostSubmit', 'uses' =>'GroupController@groupPostSubmit']);   //Group POst Submit

        Route::get('/group/members/g{id}', ['as' => 'viewGroupMembers', 'uses' =>'GroupController@viewGroupMembers']);   //View Group Members

        Route::post('/group/post/forwardpost', ['as' => 'forwardPost', 'uses' =>'GroupController@forwardPost']);   //Group POst Submit
        
});


//----------------------MarketController----------------------------------------------
Route::group(['prefix' => 'market','middleware' => 'auth'], function () {

        Route::get('/{type?}', ['as' => 'marketplace', 'uses' =>'MarketController@marketplace']);   //Marketplace

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

        Route::get('/edit/{id?}', ['as' => 'editScholarship', 'uses' =>'ScholarshipController@editscholarship']);   //Edit Scholarship (Normal and Linked)

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