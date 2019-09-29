<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Citie;
use App\Countrie;
use App\Region;
use App\Shiping ;
use Carbon\Carbon ;

class Shipings extends Controller
{

    public function get_user_shiping(Request $request)
    {
     $shipings = Shiping::where('user_id' , $request->user_id )->get() ;
	 $data = array() ;
	  foreach($shipings as $key=>$value){
		  array_push($data , $value->citie_id) ;
	  }
	 $cities = Citie::where("countrie_id",$request->countrie)->whereNotIn('id' , $data  )->get();
    // dd($shipings) ;
     return view(ad.'.shipings.list',["shipings"=>$shipings  , 'cities' => $cities]);
    }

    public function index()
    {
        $shipings = Shiping::all();
        
        return view(ad.'.shipings.index',compact('shipings'));
    }
    /**
     * show function just read onlu
     */
    public function show($id)
    {
        $region = Region::find($id) ;
        return view(ad.'.shipings.show' , compact('region')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shiping $shiping)
    {
        $countries = Countrie::all();
        return view(ad.'.shipings.add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request , Shiping $shiping )
    {
       $this->validate($request, [
            'seller_id' => 'required',
            'countrie_id' => 'required',
        ]);

        if(!empty($request->citie_ids))
        {
            $data = array();
            foreach ($request->citie_ids as $key=>$city) {

                array_push($data , [
                    'user_id' =>  $request->seller_id ,
                    'countrie_id' => $request->countrie_id ,
                    'citie_id' => $city  ,
                    'shiping_coast' =>$request->shiping_coast[$key] ,
                    'h_w_for_shiping_coast' =>(isset($request->h_w_for_shiping_coast[$key])) ? $request->h_w_for_shiping_coast[$key] : 0  ,
                    'coast_per_k_after_h_w' =>(isset($request->coast_per_k_after_h_w[$key])) ? $request->coast_per_k_after_h_w[$key] : 0   ,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    ]);

            };
        }
        $shiping->insert($data) ;

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
        $countries = Countrie::all();
        $shiping = Shiping::find($id);
        return view(ad.'.shipings.edite',['shiping'=>$shiping,'countries'=>$countries]);
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
            'seller_id' => 'required',
            'countrie_id' => 'required',
        ]);
       // $shiping = Shiping::where('user_id' , $id )->get() ;
        //
        if(!empty($request->citie_ids))
        {
            $data = array();
            foreach ($request->citie_ids as $key=>$city) {

                Shiping::updateOrCreate(
                    [
                        'user_id' =>  $request->seller_id ,
                        'countrie_id' => $request->countrie_id ,
                        'citie_id' => $city  ,
                    ],
                    [
                        'shiping_coast' =>$request->shiping_coast[$key] ,
                        'h_w_for_shiping_coast' =>(isset($request->h_w_for_shiping_coast[$key])) ? $request->h_w_for_shiping_coast[$key] : 0  ,
                         'coast_per_k_after_h_w' =>(isset($request->coast_per_k_after_h_w[$key])) ? $request->coast_per_k_after_h_w[$key] : 0   ,
                         'updated_at' => Carbon::now(),
                    ]
                );
            };
        }
        //
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
        $region = Region::find($id);

        $region->delete();
        return back();
    }
    /**
     * @param Request $request
     * @param Region region
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Region::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

    //ajax
    public function getShipingCities(Request $request)
    {
        $cities = Citie::where("countrie_id",$request->countrie)->get();
        $current = (isset($request->current)) ? $request->current : 0;
        return view(ad.'.shipings.list',["current"=>$current,"cities"=>$cities]);
    }
}
