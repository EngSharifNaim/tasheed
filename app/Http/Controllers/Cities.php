<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Citie;
use App\Countrie;

class Cities extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities_list(Request $request)
    {
        $cities = Citie::where("countrie_id",$request->countrie)->get();
        $current = (isset($request->current)) ? $request->current : 0;
        $current_region = (isset($request->current_region)) ? $request->current_region : 0;
        return view(ad.'.cities.list',["current"=>$current,"cities"=>$cities,"current_region"=>$current_region]);
    }  
    public function index()
    {
        $cities = Citie::all();
        
        return view(ad.'.cities.index',compact('cities'));
    }
    /**
     * show city data
     */
    public function show($id)
    {
        $city = Citie::find($id) ;
        return view(ad.'.cities.show' , compact('city')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Citie $citie)
    {
        $countries = Countrie::all();
        return view(ad.'.cities.add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Citie $citie)
    {
       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $citie->countrie_id = $request->countrie_id;
        $citie->name_en = $request->name_en;
        $citie->name_ar = $request->name_ar;

      
        $citie->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding') );
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
        $city = Citie::find($id);
        return view(ad.'.cities.edite',['city'=>$city,'countries'=>$countries]);
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
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);
        $citie = Citie::find($id);
      
        $citie->countrie_id = $request->countrie_id;
        $citie->name_ar = $request->name_ar;
        $citie->name_en = $request->name_en;

        $citie->save();

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
        $citie = Citie::find($id);

        $citie->delete();
        return back();
    }

    /**
     * @param Request $request
     * @param Countrie $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_delete(Request $request , Citie $city)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        $city->destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
