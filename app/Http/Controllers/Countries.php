<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Countrie;


class countries extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Countrie::all();
        
        return view(ad.'.countries.index',compact('countries'));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $country = Countrie::find($id) ;
        return view(ad.'.countries.show' , compact('country'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Countrie $countrie)
    {
        return view(ad.'.countries.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Countrie $countrie)
    {
       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'logo' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        $countrie->name_ar = $request->name_ar;
        $countrie->name_en = $request->name_en;

        if($request->file('logo')){
            $logo = Storage::putFile('public', $request->file('logo'));
            $countrie->logo = Storage::url($logo);
        }

        $countrie->save();
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
        $countrie = Countrie::find($id);
        return view(ad.'.countries.edite',['country'=>$countrie]);
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
            'logo' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        $countrie = Countrie::find($id);

        $countrie->name_ar = $request->name_ar;
        $countrie->name_en = $request->name_en;

        if($request->file('logo')){
            $logo = Storage::putFile('public', $request->file('logo'));
            $countrie->logo = Storage::url($logo);
        }

        $countrie->save();
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
        $countrie = Countrie::find($id);

        $countrie->delete();
        return back();
    }

    public function mass_delete(Request $request , Countrie $country)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        $country->destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
