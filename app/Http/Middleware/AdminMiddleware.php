<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Lang;
use  Carbon\Carbon;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard = null)
    {  //dd(1) ;
        Carbon::setLocale(Config::get('app.locale'));
        $rout_action = str_replace('App\Http\Controllers\\', '', Route::getCurrentRoute()->getActionName());
        $roles_fixer = array(
            'index'=>'read',
            'create'=>'create',
            'store'=>'create',
            'show'=>'read',
            'edit'=>'update',
            'update'=>'update',
            'destroy'=>'delete',
            'mass_delete'=>'delete',
            'getdealers'=>'read',
            'getanother'=>'read',
            'logout'=>'logout' ,
            'updatearchive' => 'update' ,
            'archive' => 'read' ,
            'unarchive' => 'update' ,
            'conversations' => 'read' ,
            'view_conversations' => 'read' ,
            'sections_list' => 'read' ,
            'cities_list' => 'read' ,
            'sections_list_subsub' => 'read' ,
            'brands_list' => 'read' ,
            'get-reports' => 'read' ,
            'getReport' => 'read' ,
            'filterProduct' => 'read' ,
           // 'getShipingcities' => 'read' ,
        );

        $explode_rout = explode("@", $rout_action);

        $final = strtolower($roles_fixer[$explode_rout[1]].'-'.$explode_rout[0]);

        //dd($final);
        
        if (isset(Auth::user()->id) && Auth::user()->active == 'yes'&& Auth::user()->level == 'admin' && Auth::user()->can([$final]) == true) {
            return $next($request);
        }else{
            if($explode_rout[1] != 'logout'){
                return redirect(ADMIN.'/login')->withInput()->with('error', __('admin.you_have_no_permission'));
            }
        }

        
    }
}
