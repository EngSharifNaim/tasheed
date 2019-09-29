<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Citie;
use App\Countrie;
use App\Region;

class Regions extends Controller
{

    public function regions_list(Request $request)
    {
        $regions = Region::where("citie_id",$request->citie)->get();
        $current = (isset($request->current)) ? $request->current : 0;
        return view(ad.'.regions.list',["current"=>$current,"regions"=>$regions]);
    }  
    public function index()
    {
        $regions = Region::all();
        
        return view(ad.'.regions.index',compact('regions'));
    }
    /**
     * show function just read onlu
     */
    public function show($id)
    {
        $region = Region::find($id) ;
        return view(ad.'.regions.show' , compact('region')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Region $region)
    {
        $countries = Countrie::all();
        return view(ad.'.regions.add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Region $region)
    {
       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $region->countrie_id = $request->countrie_id;
        $region->citie_id = $request->citie_id;
        $region->name_ar = $request->name_ar;
        $region->name_en = $request->name_en;
        $region->save();

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
        $region = Region::find($id);
        return view(ad.'.regions.edite',['region'=>$region,'countries'=>$countries]);
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

        $region = Region::find($id);

        $region->countrie_id = $request->countrie_id;
        $region->citie_id = $request->citie_id;
        $region->name_ar = $request->name_ar;
        $region->name_en = $request->name_en;

        $region->save();

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
}
