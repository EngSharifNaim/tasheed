<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
   'update_cart'  , 'use-cupon' , 'sections_lists' , 'sections_lists_subsub' , 'get-reports' , 'send_chat_message'    , 'get_user_shiping' , 'get_shipings_cities' , 'search_sidebar_in_section' , 'account/send_chat_messages' , 'account/get_chat_messages' , 'remove-item-favourite' , 'add-favourite-to-cart'  , 'delete-cart-item' , 'use-addresse' , 'update-addresse' , 'delete_addresse'  , 'add-addresses' , 'regions_list' , 'cities_list'  , 'cart-guest' , 'product-favourite' ,  'cities/cities_list' , 'regions/regions_list' ,   'send_email' ,  'admin/ckeditor/upload' , 'admin/sections_lists' , 'admin/cities_list' , 'admin/sections_list_subsub'
    ];
}
