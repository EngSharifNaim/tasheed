<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/getmenu', 'Mobapi@getMenu');
Route::post('/login', 'Mobapi@login');
Route::post('/register', 'Mobapi@register');
Route::post('/activeacount', 'Mobapi@activeAcount');
Route::get('/getslider' , 'Mobapi@getSlider') ;
Route::get('/lastproduct' , 'Mobapi@lastProduct') ;
Route::get('/mostview' , 'Mobapi@mostView') ;
Route::get('/minumproduct' , 'Mobapi@minPrice') ;
Route::post('/sectionproducts' , 'Mobapi@sectionProducts') ;
Route::post('/search' , 'Mobapi@search') ;
Route::get('/product/{id}' , 'Mobapi@product') ;
Route::get('/getallcountrie' , 'Mobapi@getAllCountrie') ;
Route::get('/citieslist/{id}' , 'Mobapi@citiesList') ;
Route::get('/regionslist/{id}' , 'Mobapi@regionsList') ;
Route::get('/userlevel' , 'Mobapi@userLevel') ;
Route::get('/userlevel/{id}' , 'Mobapi@getUserLevelData') ;
Route::get('/dealer-profile/{id}' , 'Mobapi@dealerProfile') ;
Route::get('/company-page/{id}','Mobapi@companyPage');
Route::get('/company','Mobapi@company');


Route::group(['middleware' => ['auth:api']], function ()
{ 
Route::post('/sendRate','Mobapi@sendRate');
Route::post('/logout','Mobapi@logout');
Route::post('/getmyprofilee' , 'Mobapi@getMyProfile'); 
Route::get('/my-orders', 'Mobapi@myOrders');
Route::post('/edit-profile' , 'Mobapi@editProfile'); 
Route::post('/addaddresses' , 'Mobapi@addAddresses'); 
Route::post('/updateaddresse' , 'Mobapi@updateAddresse'); 
Route::get('/user-addresse' , 'Mobapi@userAddresse'); 
Route::get('/user-active-addresse' , 'Mobapi@userActiveAddresse'); 
Route::get('/activeanaddresse/{id}' , 'Mobapi@activeAnAddresse'); 
Route::get('/deleteuseraddresse/{id}' , 'Mobapi@deleteUserAddresse'); 
Route::get('/my-addresses', 'Mobapi@addresses_settings');
Route::post('/addtofavourite' , 'Mobapi@addToFavourite') ;
Route::post('/favouriteproducts' , 'Mobapi@favouriteProducts') ; 
Route::post('/removefavouriteproduct' , 'Mobapi@removeFavouriteProduct') ; 
Route::post('/savecartitems' , 'Mobapi@saveCartItems') ; 
Route::post('/getShipingPrice' , 'Mobapi@getShipingPrice') ; 
    Route::get('/account/messages', 'Mobapi@getMessages');
    Route::get('/account/conversation/{id}', 'Mobapi@getConversation');
  //  Route::get('/account/conversation/{id}/check', 'Mobapi@checkConversation');
    Route::post('/account/send_chat_messages', 'Mobapi@sendChatMessages');
    Route::post('/account/get_chat_messages', 'Mobapi@getChatMessages');;
});
Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');