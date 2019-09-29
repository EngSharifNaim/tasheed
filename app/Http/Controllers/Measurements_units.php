<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Measurements_unit;


class Measurements_units extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements_units = Measurements_unit::all();

        return view(ad.'.measurements_units.index',compact('measurements_units'));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $measurements_unit = Measurements_unit::find($id) ;
        return view(ad.'.measurements_units.show' , compact('measurements_unit'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Measurements_unit $measurements_unit)
    {
        return view(ad.'.measurements_units.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Measurements_unit $measurements_unit)
    {

        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $measurements_unit->name_ar = $request->name_ar;
        $measurements_unit->name_en = $request->name_en;



        $measurements_unit->save();

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
        $measurements_unit = Measurements_unit::find($id);
        return view(ad.'.measurements_units.edite',['measurements_unit'=>$measurements_unit]);
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
        ]);

        $measurements_unit = Measurements_unit::find($id);

        $measurements_unit->name_ar = $request->name_ar;
        $measurements_unit->name_en = $request->name_en;

        $measurements_unit->save();

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
        $measurements_unit = Measurements_unit::find($id);

        $measurements_unit->delete();
        return back();
    }

    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Measurements_unit::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
