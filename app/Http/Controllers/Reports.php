<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\size;
use App\Order ;


class Reports extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(ad.'.reports.add');
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $size = Size::find($id) ;
        return view(ad.'.reports.show' , compact('size'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(ad.'.reports.add');
    }

    public function getReport(Request $request)
    {
     if($request->type == 1 ){
         $orders = Order::where('order_status' , 'delevried')->get() ;
         return view(ad.'.reports.finished_orders' , compact('orders'));
     }else if($request->type == 1 ){

     }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Size $size)
    {

        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'size_code' => 'required',
        ]);

        $size->name_ar = $request->name_ar;
        $size->name_en = $request->name_en;
        $size->size_code = $request->size_code ;



        $size->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);
        return view(ad.'.reports.edite',['size'=>$size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //  dd($request) ;
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'size_code' => 'required',
        ]);

        $size = Size::find($id);

        $size->name_ar = $request->name_ar;
        $size->name_en = $request->name_en;
        $size->size_code = $request->size_code ;

        $size->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);

        $size->delete();
        return back();
    }

    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Size::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
