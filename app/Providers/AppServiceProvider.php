<?php

namespace App\Providers;

use App\Paidacount;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use URL ;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
//		URL::forceScheme('https');
        View::composer('*', function() {

            $paidsetting = Setting::where('key','=','paidacount')->first();
            View::share('paidsetting', $paidsetting);

            if(Auth::check()) {
                $paid = Paidacount::where('user_id', '=', Auth::user()->id)->first();

                if ($paid) {
                    $paidStatus = 2;
                    $paidMsg = '';
                    if ($paid->active == 'no') {
                        $paidMsg = 'اشتراكك غير مفعل حتى الآن ...';
                        $paidStatus = 1;
                    }

                } else {
                    $paidStatus = 0;
                    $paidMsg = 'انت غير مشترك .. نرجو ترقية حسابك للاستفادة من خدماتنا';
                }



                View::share('paidStatus', $paidStatus);
                View::share('paidMsg', $paidMsg);

            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
