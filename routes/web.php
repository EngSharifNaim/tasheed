<?php

define('ad','admin');//admin theme path
define('ADMIN','admin');//admin route short cut
define('ASSETS',url('resources/views/admin/assets'));//admin assets path
Theme::set('default');

Route::DELETE(ADMIN.'/paidacounts','Paidacounts@mass_delete');
Route::resource(ADMIN.'/paidacounts','Paidacounts');;

Route::DELETE(ADMIN.'/paidacounttypes','Paidacounttypes@mass_delete');
Route::resource(ADMIN.'/paidacounttypes','Paidacounttypes');
Route::get(ADMIN.'/paidacounttypes/{id}/edit','Paidacounttypes@edit');
Route::post(ADMIN.'/paidacounttypes/{id}','Paidacounttypes@update');


Route::get('/paidacounts/{todo}/{id}','Paidacounts@activate');


Route::group(['middleware'=>'localization'],function(){
    Route::post('get_shipings_cities','Shipings@getShipingCities');
    Route::post('get_user_shiping','Shipings@get_user_shiping');
    Route::group(['middleware'=>'admin'],function(){


        Route::get(ADMIN,'Admin@index');
        Route::get(ADMIN.'/logout','Admin@logout');
        Route::get(ADMIN.'/settings','Settings@index', ['only' => [
            'update','index'
        ]]);
        Route::patch(ADMIN.'/settings','Settings@update');
        Route::DELETE(ADMIN.'/moderators_mass_delete','Moderators@mass_delete');
        Route::resource(ADMIN.'/moderators','Moderators');
        Route::DELETE(ADMIN.'/roles_mass_delete','Roles@mass_delete');
        Route::resource(ADMIN.'/roles','Roles');
        Route::get(ADMIN.'/users/dealers','Users@getdealers');
        Route::get(ADMIN.'/users/another','Users@getanother');
        Route::DELETE(ADMIN.'/users_mass_delete','Users@mass_delete');
        Route::resource(ADMIN.'/users','Users');
        Route::DELETE(ADMIN.'/userlevels_mass_delete','Userlevels@mass_delete');
        Route::resource(ADMIN.'/userlevels','Userlevels');
		Route::get(ADMIN.'/mobilymessages','Mobilymessages@index');
        Route::patch(ADMIN.'/mobilymessages','Mobilymessages@update');
		Route::DELETE(ADMIN.'/pages_mass_delete','Pages@mass_delete');
        Route::resource(ADMIN.'/pages','Pages');
        Route::DELETE(ADMIN.'/sections_mass_delete','Sections@mass_delete');
        Route::resource(ADMIN.'/sections','Sections');
        Route::DELETE(ADMIN.'/sliders_mass_delete','Sliders@mass_delete');
        Route::resource(ADMIN.'/sliders','Sliders');
        Route::post(ADMIN.'/ckeditor/upload','ckEditorUploader@upload');
        Route::get(ADMIN.'/contact_messages/archived','Contact_Messages@archive');;
        Route::resource(ADMIN.'/contact_messages','Contact_Messages');
        Route::DELETE(ADMIN.'/contact_messages_mass_delete','Contact_Messages@mass_delete');
        Route::resource(ADMIN.'/chat','Chat');
        Route::DELETE(ADMIN.'/chat_mass_delete','Chat@mass_delete');
        //city & country & regions
        Route::resource(ADMIN.'/countries','Countries');
        Route::DELETE(ADMIN.'/countries_mass_delete','Countries@mass_delete');
        Route::resource(ADMIN.'/cities','Cities');
        Route::post(ADMIN.'/cities_list','Cities@cities_list');
        Route::DELETE(ADMIN.'/cities_mass_delete','Cities@mass_delete');
        Route::resource(ADMIN.'/regions','Regions');
        Route::post(ADMIN.'/regions_list','Regions@regions_list');
        Route::DELETE(ADMIN.'/regions_mass_delete','Regions@mass_delete');
        // backend functions --zezo
        Route::post(ADMIN.'/sections_lists','Sections@sections_list');
        Route::post(ADMIN.'/sections_lists_subsub','Sections@sections_list_subsub');
        Route::DELETE(ADMIN.'/brands_mass_delete','Brands@mass_delete');
        Route::get(ADMIN.'/brands_list','Brands@brands_list');
        Route::resource(ADMIN.'/brands','Brands');
        Route::DELETE(ADMIN.'/questionsandanswers_mass_delete','Questionsandanswers@mass_delete');
        Route::resource(ADMIN.'/questionsandanswers','Questionsandanswers');
        Route::DELETE(ADMIN.'/measurements_units_mass_delete','Measurements_units@mass_delete');
        Route::resource(ADMIN.'/measurements_units','Measurements_units');
        //colors
        Route::resource(ADMIN.'/colors','Colors');
        Route::DELETE(ADMIN.'/colors_mass_delete','Colors@mass_delete');
        //sizes
        Route::resource(ADMIN.'/sizes','Sizes');
        Route::DELETE(ADMIN.'/sizes_mass_delete','Sizes@mass_delete');
        //products
        Route::get('/filter-product' , 'Products@filterProduct') ;
        Route::DELETE(ADMIN.'/products_mass_delete','Products@mass_delete');
        Route::resource(ADMIN.'/products','Products');
        //reviews
        Route::DELETE(ADMIN.'/reviews_mass_delete','Reviews@mass_delete');
        Route::resource(ADMIN.'/reviews','Reviews');
        //currencies
        Route::DELETE(ADMIN.'/currencies_mass_delete','Currencies@mass_delete');
        Route::resource(ADMIN.'/currencies','Currencies');
        //advertismnet
        Route::DELETE(ADMIN.'/advertisments_mass_delete','Advertisments@mass_delete');
        Route::resource(ADMIN.'/advertisments','Advertisments');
        //orders
        Route::DELETE(ADMIN.'/orders_mass_delete','Orders@mass_delete');
        Route::post(ADMIN.'/sub_order/{id}','Orders@subOrderEdit');
        Route::resource(ADMIN.'/orders','Orders');
        //cupons
        Route::DELETE(ADMIN.'/cupons_mass_delete','Cupons@mass_delete');
        Route::resource(ADMIN.'/cupons','Cupons');
        //shipings
        Route::DELETE(ADMIN.'/newsletters_mass_delete','Newsletters@mass_delete');
        Route::resource(ADMIN.'/newsletters','Newsletters');
        //user addresses
        Route::DELETE(ADMIN.'/users_addresses_delete','Users_addresses@mass_delete');
        Route::resource(ADMIN.'/users_addresses','Users_addresses');


        Route::DELETE(ADMIN.'/siteprofits','Siteprofits@mass_delete');
        Route::resource(ADMIN.'/siteprofits','Siteprofits');


        Route::DELETE(ADMIN.'/shipings_mass_delete','Shipings@mass_delete');
        Route::resource(ADMIN.'/shipings','Shipings');
        //get reports ajax
        Route::get(ADMIN.'/reports','Reports@create');
        Route::post('/get-reports', 'Reports@getReport');
        //end reports

        //end


    });

    Route::get(ADMIN.'/login','Admin@login');
    Route::post(ADMIN.'/login','Admin@postlogin');

	Route::get('/language/{locale}', 'LanguageController@index');
	//api 
	Route::get('/api/get-base-url', 'Sitecontoller@getBaseUrl');
	Route::get('/api/get-section', 'Sitecontoller@getMenu');
	Route::get('/api/get-menu', 'Sitecontoller@getMenu');
	Route::get('/api/get-subsection/{id}', 'Sitecontoller@getSubSection');
	Route::get('/api/get-subsubsection/{id}', 'Sitecontoller@getSubSubSection');
	Route::get('/api/get-getuserlevel',  'Sitecontoller@getUserLevel');
	Route::get('/api/get-pages',  'Sitecontoller@getPages');
	Route::get('/', 'Sitecontoller@index');
	/*zezo routes frontend-------->*/
	Route::get('/page/{slug}/{id}' , 'Sitecontoller@page') ;
    Route::get('/register-client', 'Sitecontoller@register_client');
//    Route::get('/register-dealer', 'Sitecontoller@register_dealer');
    Route::get('/register-dealer',function (){

        return view('auth.register-new-dealer') ;

    });
    Route::get('map',function (){
        return view('map');
    });
    Route::get('/register-another', 'Sitecontoller@registerAnother');
    Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');
   // Route::get('/logout','Sitecontoller@logout');
    Route::post('/newsletters','Sitecontoller@newsletters');
    Route::get('/get-product-in-ajax','Sitecontoller@product_ajax_model_request');
    Route::get('/get-products-in-slider','Sitecontoller@product_slider_list');
    Route::get('/get-products-in-slider_min_last','Sitecontoller@product_slider_list_lastmin');
    Route::get('/sections','Sitecontoller@sections');
    Route::get('/main-section/{slug}/{id}','Sitecontoller@section');
    Route::post('/search_sidebar_in_section','Sitecontoller@searchSectionByName');
    Route::get('/section','Sitecontoller@section_products');
    Route::get('/section/{section}/{subsection}/{id}','Sitecontoller@section_products_sub');
    Route::get('/section/{section}/{subsection}/{slug}/{id}','Sitecontoller@section_products_sub_sub');
    Route::get('/brand/{slug}/{id}','Sitecontoller@brand_products');
    Route::post('product-favourite','Sitecontoller@add_product_to_favourite');
    Route::get('/contact','Sitecontoller@contact');
    Route::get('/search','Sitecontoller@search');
    Route::get('/search-filter','Sitecontoller@searchFilter');
    Route::post('/send_contact','Sitecontoller@send_contact');
    //ajax requests  cities_list  , regions_list
    Route::post('/cities/cities_list', 'Sitecontoller@cities_list');
    Route::post('/cities_list', 'Sitecontoller@cities_list');
    Route::post('/regions/regions_list', 'Sitecontoller@regions_list');
    Route::post('/regions_list', 'Sitecontoller@regions_list');
    Route::get('/search-in-dealer','Sitecontoller@searchInDealerProducts');
    Route::get('/getcartcount','Sitecontoller@getCartCount');
    Route::get('/additionalacount/userlevel/{id}','Sitecontoller@Userlevel');
    // end

    //cart functions
    //session_cart ajax request save when Guest
    Route::post('/cart-guest', 'Sitecontoller@session_cart');
    Route::get('/cart-popup-items', 'Sitecontoller@cart_popup_items');
    Route::post('/update_cart', 'Sitecontoller@update_cart');
    Route::post('/delete-cart-item', 'Sitecontoller@cart_delete');
    Route::get('/delete-from-cart-guest/{id}', 'Sitecontoller@delete_product_from_session');
    Route::get('/checkout', 'HomeController@cart_checkout');
    Route::get('/dealer-profile/{slug}/{id}','Sitecontoller@dealer_profile');
      //Route::get('password/reset/{token?}', 'Auth\ForgotPasswordController@showLinkRequestForm');

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/dashborad', 'HomeController@index');
	Route::get('/my-favourite-products', 'HomeController@favourite_products');
	Route::get('/edit-profile', 'HomeController@update_personal_data');
	Route::get('/paid-acount', 'HomeController@paid_acount');
	Route::post('/paidacounts_new', 'HomeController@paid_acount_new');
	Route::post('/save-user-data/{id}', 'HomeController@edit_profile');
	Route::get('/my-addresses', 'HomeController@addresses_settings');
	route::post('/delete_addresse' , 'HomeController@delete_user_addresse') ;
	route::post('/use-addresse' , 'HomeController@active_an_addresse') ;
	route::post('/update-addresse' , 'HomeController@update_addresse') ;
	Route::get('/my-orders', 'HomeController@myOrders');
	Route::get('/email-list', 'HomeController@emaillist');
	Route::get('/conservation', 'HomeController@conservation');
	Route::get('/my-cupons', 'HomeController@cupons');
	Route::get('/cart', 'Sitecontoller@Cart');
	Route::post('/save-order', 'HomeController@save_cart_items');
	Route::get('/check-out-final/{id}', 'HomeController@final_checkout_step');
	Route::get('/track-order/{id}', 'HomeController@final_checkout_step');
	Route::get('/shiping-details', 'HomeController@add_shiping');
	Route::post('/add_shiping_data', 'HomeController@add_shiping_data');
	//dashborad products functions  create_product
    Route::get('/add-product', 'HomeController@create_product');
    Route::post('/save_product', 'HomeController@save_product');
    Route::get('/my-products', 'HomeController@dealer_products');
    Route::get('/edit-product/{id}/edit ', 'HomeController@product_edit');
    Route::patch('/save_edit_product/{id} ', 'HomeController@product_update');
    Route::get('/product/{id} ', 'HomeController@show_product');
    Route::DELETE('/products_mass_delete','HomeController@products_mass_delete');
    Route::get('/user_profile','HomeController@user_profile');
    Route::get('/edit-company','HomeController@edit_company');
    Route::post('/save_company_data','HomeController@save_company_data');
    Route::get('/acount/orders','HomeController@dealerOrders');
    Route::get('/acount/orders_type1','HomeController@dealerOrders');
    Route::get('/acount/orders_type2','HomeController@dealerOrders');
    Route::get('/acount/orders_type3','HomeController@dealerOrders');
	//ajax functions in home controller
    Route::post('/add-addresses' , 'HomeController@add_addresses') ;
    Route::post('/remove-item-favourite' , 'HomeController@remove_favourite_product') ;
    Route::post('/add-favourite-to-cart' , 'HomeController@add_favourite_to_cart') ;
    //chat
    Route::get('/account/messages', 'HomeController@getMessages');
    Route::get('/account/conversation/{id}', 'HomeController@getConversation');
    Route::get('/account/conversation/{id}/check', 'HomeController@checkConversation');
    Route::post('/account/send_chat_messages', 'HomeController@sendChatMessages');
    Route::post('/account/get_chat_messages', 'HomeController@getChatMessages');;
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout') ;
    Route::post('/dologin', 'Sitecontoller@doLogin') ;
   // Route::get('/destroycart' , 'HomeController@destroycart') ;
    //product add ajax function
    Route::get('/brands_list','Brands@brands_list');
    Route::post('/sections_lists','Sections@sections_list');
    Route::post('/sections_lists_subsub','Sections@sections_list_subsub');
    //dealer order
    Route::get('/order/{id}/edit' , 'HomeController@editOrder') ;
    Route::post('/edit-order/{id}' , 'HomeController@editOrderData') ;
    Route::post('/update-dealer-order/{id}' , 'HomeController@updateDealerOrder') ;
    Route::get('acount/updatedealerorder/{id}' , 'HomeController@showOrderForupdatedealer') ;
    Route::get('/client-order/{id}' , 'HomeController@clientOrder') ;
    Route::get('/search-order' , 'HomeController@orderSearch') ;
    Route::post('/update-client-order' , 'HomeController@updateCleintOrder') ;
    //dealer cupons   dealerCupons
    Route::get('/acount/cupons' , 'HomeController@dealerCupons') ;
    Route::get('/acount/add-cupon' , 'HomeController@addCupons') ;
    Route::post('/acount/save-cupon' , 'HomeController@saveCupon') ;
    Route::get('/edit-cupon/{id}/edit' , 'HomeController@editCupon') ;
    Route::post('/edit-cupon/{id}' , 'HomeController@saveEditCupon') ;
    Route::post('/send_chat_message','HomeController@sendDellerMessage');
    Route::post('/send-rate','HomeController@sendRate');
    Route::get('/use-cupon','Sitecontoller@useCupon');
    Route::get('/check-cupon-valid','Sitecontoller@checkCuponValid');
    Route::get('/read-json','Sitecontoller@readJsonCode');
    Route::get('/getcartdata','Sitecontoller@getCartData');
   // Route::get('/company-page','Sitecontoller@companyPage');
    Route::get('/company-page/{id}','Sitecontoller@companyPage');
    Route::get('/addational-register','Sitecontoller@newRegister');
    Route::get('/company_cat','Sitecontoller@companyCategory');
    Route::get('/userviamobile/mobilecode','Sitecontoller@mobileactive');
    Route::post('saveactivemobilecode','Sitecontoller@savemobileactive');
    Route::get('/userviamobile/sendanothercode','Sitecontoller@sendanothercode');
    Route::get('/{slug}/{id}','Sitecontoller@product');

});

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
