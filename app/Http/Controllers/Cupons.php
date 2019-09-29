<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Cupon;
use App\User ;
use App\Product ;


class Cupons extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupons = Cupon::all();
        return view(ad.'.cupons.index',compact('cupons' ));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $cupon = Cupon::find($id);
        $dealers = User::where('level' , 'dealer')->get() ;
        $products = Product::where('active' , 'yes')->where('quantity' , '>' , 0 )->get() ;
        return view(ad.'.cupons.show' , compact('cupon' , 'products' , 'dealers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cupon $cupon)
    {
        $dealers = User::where('level' , 'dealer')->get() ;
        $products = Product::where('active' , 'yes')->where('quantity' , '>' , 0 )->get() ;
        return view(ad.'.cupons.add' , compact('dealers' , 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Cupon $cupon)
    {

       $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $cupon->start_date = $request->start_date ;
        $cupon->end_date = $request->end_date ;     
        $cupon->user_id = $request->user_id ;
       // $cupon->currencie_id = $request->currencie_id ;
       // $cupon->countrie_id = $request->countrie_id ;
       // $cupon->citie_id = $request->citie_id ;
        //$cupon->region_id = $request->region_id ;
        $cupon->product_id = $request->product_id ;
        $cupon->discount_percentage = $request-> discount_percentage;
        $cupon->discount_monay = $request->discount_monay ;
        $cupon->active = $request->active ;
        $cupon->cupon_code = time() ;

        $cupon->save();

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
        $cupon = Cupon::find($id);
        $dealers = User::where('level' , 'dealer')->get() ;
        $products = Product::where('active' , 'yes')->where('quantity' , '>' , 0 )->get() ;
        return view(ad.'.cupons.edite',['cupon'=>$cupon , 'dealers' => $dealers , 'products' => $products]);
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

        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $cupon = Cupon::find($id);

        $cupon->start_date = $request->start_date ;
        $cupon->end_date = $request->end_date ;
       // $cupon->min_price = null ;
        //$cupon->max_price = null ;
        $cupon->user_id = $request->user_id ;
       // $cupon->currencie_id = $request->currencie_id ;
       // $cupon->countrie_id = $request->countrie_id ;
       // $cupon->citie_id = $request->citie_id ;
       // $cupon->region_id = $request->region_id ;
        $cupon->product_id = $request->product_id ;
        $cupon->discount_percentage = $request-> discount_percentage;
        $cupon->discount_monay = $request->discount_monay ;
        $cupon->active = $request->active ;
        $cupon->cupon_code = time() ;

        $cupon->save();

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
        $cupon = Cupon::find($id);

        $cupon->delete();
        return back();
    }

    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Cupon::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
