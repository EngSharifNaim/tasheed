<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Product ;
use App\Brand ;
use App\Section ;
use App\Color ;
use App\Size ;
use App\user ;
use App\Order ;
use Carbon\Carbon ;
use App\Companie ;
use App\Tracker ;

class Admin extends Controller
{
 public function index()
    {

        $total_product = Product::where('deleted_at' , null )->count() ;
        $total_product_active = Product::where('deleted_at' , null )->where('active' , 'yes')->count() ;
        $total_product_in_active = Product::where('deleted_at' , null )->where('active' , 'no')->count() ;
        $total_brands = Brand::where('deleted_at' , null )->count() ;
        $total_user = User::where('deleted_at' , null )->where('level' , 'user')->count() ;
        $total_dealer = User::where('deleted_at' , null )->where('level' , 'dealer')->count() ;
        $total_section = Section::where('deleted_at' , null )->count() ;
        $total_main_section = Section::where('deleted_at' , null )->where('parent_id' , 0 )->count() ;
        $total_sub_section = Section::where('deleted_at' , null )->where('parent_id' , '>' , 0 )->count() ;
        //$today = Carbon\Carbon::now()->format('Y-m-d').'%';
        $total_today_order = Order::where('deleted_at' , null )->where('created_at', '>=', Carbon::today())->count() ;
        $total_order = Order::where('deleted_at' , null )->count() ;
        $total_company = Companie::where('deleted_at' , null )->count() ;
        $visitor_today = Tracker::where('date', '>=', Carbon::today() )->count() ;
        $products = Product::where('deleted_at' , null )->orderBy('created_at', 'desc')->take(30)->get() ;
        $orders  = Order::where('deleted_at' , null )->orderBy('created_at', 'desc')->take(30)->get() ;
        return view(ad.'.home' , compact(   'orders' , 'products' , 'visitor_today' , 'total_company' ,'total_order' ,'total_today_order' ,'total_sub_section' ,'total_main_section' ,'total_section' ,'total_dealer' ,'total_user' ,'total_brands' ,'total_product_in_active' ,'total_product_active' ,'total_product'));
    }
    /**
     * Display a login page.
     *
     * @return view
     */
    public function login(){
        return view(ad.'.login',['title'=>trans('admin.login')]);
    }
    /**
     * check login data.
     *
     * @return view
     */
    public function postlogin(Request $request){
        $rules = [
                'email'=>'required|email',
                'password'=>'required|min:5'
        ];
        $validate = Validator::make($request->all(),$rules);

        $validate->setAttributeNames([
                                    'email'=>'البريد الالكترونى',
                                    'password'=>'كلمة المرور'
                                ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            
            if($request->input('remember')){
                $remember = true;
            }else{
                $remember = false;
            }
            if(auth()->attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'active'=>'yes'],$remember)){
                return redirect(ADMIN);
            }else{
                session()->flash('error',__('admin.login_wrong_data_title'));
                return redirect()->back();
            }
        }
    }

    public function logout()

    {

        Auth::logout();

        //session()->put('success','تم تسجيل خروجك بنجاح');

        return redirect(ADMIN.'/login');

    }
}
