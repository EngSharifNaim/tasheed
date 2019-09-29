<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Order;
use App\Product;
use App\Size ;
use App\User;
use App\Order_product ;
use Mail;
use Symfony\Component\HttpFoundation\Request;
use DB;
use App\Siteprofit ;


class Orders extends Controller
{

    public function __construct()
    {
        $this->order_status =  array(
            'in_progress' => 'جارى عرض الطلب',
            'in_prepration' => 'جارى التجهيز' ,
            'on_delevery' => 'جارى التوصيل',
            'delevried' => 'تم التوصيل',
            'cancelled' => 'ملغى',
            'refunded' => 'مرتجع',
        ) ;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('parent_id' , 0 )->get();

        return view(ad.'.orders.index',compact('orders'));
    }

    public function getfinished()
    {
        $orders = Order::where('order_status' , 'delevried')->orderBy('created_at', 'DESC')->get();

        return view(ad.'.orders.index',compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view(ad.'.orders.show',compact('order'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id) ;
        return view(ad.'.orders.edite' , ['order' => $order]);
    }

    public function update(Request $request, $id , Siteprofit $siteProfit)
    {
        $order = Order::find($id) ;
        $user = $order->user->toArray() ; ;
        $user_email = $order->user->email ;
        $user_name = $order->user->name ;
        $order->order_status = $request->order_status ;
        if($order->order_status == 'delevried'){
        $sitePercentage = $order->dealer->sitepercentage ;
        $siteprofit = array() ;
        foreach($order->has_orders as $key=>$order_dealer){
            $siteprofitmonaey = (( (intval($order_dealer->total)) - intval($order_dealer->tax) ) * $order_dealer->dealer->sitepercetage )/ 100 ;
          $data = array(
              'user_id' => $order_dealer->product_owner ,
              'order_id' => $order_dealer->id,
              'total' => $order_dealer->total ,
              'parent_order_id' => $order_dealer->parent_id	 ,
              'site_percentage' => $order_dealer->dealer->sitepercetage,
              'site_profit' => $siteprofitmonaey ,
              'status' => 0 ,
              'created_at' => '' ,
              'updated_at' => '' ,
              );
          array_push($siteprofit  , $data ) ;
         }
         //dd($siteprofit) ;
         $siteProfit::insert($siteprofit) ;

        }

        if(isset($request->sub_order)){
            if($order->save()){
                //send email
                Mail::send('emails.product', $user, function ($m) use ($user_email , $user_name , $user) {
                    $m->from('no-replay@tsheed.com', $user_name);
                    $m->to($user_email, $user_name)->subject('تم تغير حاله الطلب الخاصه بكم ');
                });
                //end sending email
                /* $notify =  User::find($order->user_id);
                 @$notify->notify(new StatusChanged($order));
                 @$notify->notify(new StatusChangedonesignal($order));*/

                $request->session()->flash('alert-success', 'تم حفظ البيانات بنجاح');
            }else{
                $request->session()->flash('alert-error', 'فشلت العمليه');
            }
            return back();

        }else{

        DB::table('orders')
            ->where('parent_id', $id )
            ->update(['order_status' => $request->order_status ]);

        if($order->save()){
            //send email
            Mail::send('emails.product', $user, function ($m) use ($user_email , $user_name , $user) {
                $m->from('no-replay@tsheed.com', $user_name);
                $m->to($user_email, $user_name)->subject('تم تغير حاله الطلب الخاصه بكم ');
            });
            //end sending email
           /* $notify =  User::find($order->user_id);
            @$notify->notify(new StatusChanged($order));
            @$notify->notify(new StatusChangedonesignal($order));*/

            $request->session()->flash('alert-success', 'تم حفظ البيانات بنجاح');
        }else{
            $request->session()->flash('alert-error', 'فشلت العمليه');
        }

        return back();
        }

    }

    //subOrderEdit
    public function subOrderEdit(Request $request,$id)
    {
        $order = Order::find($id) ;
        $order->order_status = $request->order_status ;
        $order->save() ;
        $request->session()->flash('alert-success', 'تم حفظ البيانات بنجاح');
        return back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $order = Order::find($id);

        $order->delete();
        $request->session()->flash('alert-success', 'تمت عملية الحذف بنجاح');
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Order::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
