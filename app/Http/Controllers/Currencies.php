<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Currencie;

class Currencies extends Controller
{

    public function index()
    {
        $currencies = Currencie::all();
        return view(ad.'.currencies.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currencie = Currencie::find($id) ;
        return view(ad.'.currencies.show' , ['currencie' => $currencie]) ;
    }
    /*
     *
     */
    public function create(Currencie $currencie)
    {
        return view(ad.'.currencies.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Currencie $currencie)
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'label_ar' => 'required',
            'label_en' => 'required',
            'value_to_dollar' => 'required|numeric',
            'icon' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);


        $currencie->name_ar = $request->name_ar;
        $currencie->name_en = $request->name_en;
        $currencie->label_ar = $request->label_ar;
        $currencie->label_en = $request->label_en;
        $currencie->value_to_dollar = $request->value_to_dollar;

        if(!empty($request->file('icon'))){
            $photo = Storage::putFile('public', $request->file('icon'));
            $currencie->icon = Storage::url($photo);
        }

        $currencie->save();
        $request->session()->flash('alert-success',  __('admin.alerts_success_adding'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $currencie = Currencie::find($id) ;

        return view(ad.'.currencies.edite',["currencie"=>$currencie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'label_ar' => 'required',
            'label_en' => 'required',
            'value_to_dollar' => 'required|numeric',
            'icon' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        $currencie = Currencie::find($id);

        $currencie->name_ar = $request->name_ar;
        $currencie->name_en = $request->name_en;
        $currencie->label_ar = $request->label_ar;
        $currencie->label_en = $request->label_en;
        $currencie->value_to_dollar = $request->value_to_dollar;

        if(!empty($request->file('icon'))){
            $photo = Storage::putFile('public', $request->file('icon'));
            $currencie->icon = Storage::url($photo);
        }

        $currencie->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
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
        $currencie = Currencie::find($id);

        $currencie->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Currencie::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
