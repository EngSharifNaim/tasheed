<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use App;
class LanguageController extends Controller
{
    //

    public function index(Request $request,$locale)
    {
 		Session::put('locale', $locale); 
 		
 		return back();
    }
}
