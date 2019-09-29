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


class Siteprofits extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteprofits = Siteprofit::orderBy('created_at', 'DESC')->get();

        return view(ad.'.siteprofits.index',compact('siteprofits'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siteprofit = Siteprofit::find($id);
        return view(ad.'.siteprofits.show',compact('siteprofit'));
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
        $siteprofit = Siteprofit::find($id);
        return view(ad.'.siteprofits.edite' , ['siteprofit' => $siteprofit]);
    }

    public function update(Request $request, $id , Siteprofit $siteProfit)
    {
        $siteprofit = Siteprofit::find($id);
        $user = $siteprofit->user->toArray() ; ;
        $user_email = $siteprofit->user->email ;
        $user_name = $siteprofit->user->name ;
        $siteprofit->status = $request->pay_status ;
        $siteprofit->status = $request->pay_status ;
        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back() ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $siteprofit = Siteprofit::find($id);

        $siteprofit->delete();
        $request->session()->flash('alert-success', 'تمت عملية الحذف بنجاح');
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Siteprofit::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
