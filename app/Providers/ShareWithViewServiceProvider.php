<?php

namespace App\Providers;

use App\Section;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Lang;
use App\Setting;
use App\Role;
use App\Page ;
use App\Countrie ;
use App\Currencie ;
use App\User ;
use App\Advertisment ;
use App\Userlevel ;

class ShareWithViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        if (Schema::hasTable('settings'))
        {
            //get top bar pages
            $topbar_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->where('page_location' ,'=' ,  'top_bar')->get() ;
            //get menu pages
            $menu_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->where('page_location' , 'menu')->get() ;
            //get footer pages
            $footer_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->where('page_location' , 'footer')->get() ;
            //get help pages
            $help_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->where('page_location' , 'help')->take(5)->get() ;
            $condition = Page::where('deleted_at' , null )->where('active' , 'yes')->where('page_location' , 'page_condition_snodd')->first() ;
            $all_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->get() ;
            //seller
            $sellers = User::where('active' , 'yes')->where('level' , 'dealer')->get() ;
            //get main sections
            $sections = Section::where('deleted_at' , null )->where('active' , 'yes')->where('parent_id' , 0 )->where('sub_section' , 0)->get() ;
            $all_sections = Section::where('deleted_at' , null )->where('parent_id' , 0 )->get() ;
            $userlevels = Userlevel::all() ; 
            $countireslist = Countrie::all();
            $settings = Setting::all();
            $variables = array();
            foreach ($settings as $key=>$val){
                $variables[$val->key] = $val->value;
            }
            $currencies = Currencie::all() ;
            $top_main_advertise = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' ,9 )->first() ;

            view()->share([ 'userlevels' => $userlevels ,  'condition' => $condition , 'top_main_advertise'=> $top_main_advertise,'all_sections' => $all_sections , 'all_pages'=>$all_pages , 'sellers' => $sellers ,'help_pages' => $help_pages, 'currencies'=>$currencies , 'countireslist' => $countireslist , 'sections'=>$sections , 'settings'=>$variables , 'topbar_pages' => $topbar_pages , 'menu_pages' => $menu_pages , 'footer_pages' => $footer_pages ]);

        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
