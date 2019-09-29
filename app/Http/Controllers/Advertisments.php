<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Advertisment;
use App\Section ;

class Advertisments extends Controller
{

    public function index()
    {
        $advertisments = Advertisment::all();
        return view(ad.'.advertisments.index',compact('advertisments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertisment = Advertisment::find($id) ;
        $sections = Section::all() ;
        return view(ad.'.advertisments.show' , ['advertisment' => $advertisment , 'sections' =>  $sections]) ;
    }
    /*
     *
     */
    public function create(Advertisment $advertisment)
    {
        $sections = Section::all() ;
        return view(ad.'.advertisments.add' , compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Advertisment $advertisment)
    {
        if(!empty($request->link)){
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'link' => 'url',
                'location' => 'required',
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);
        }else{
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'location' => 'required',
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);
        }



        $advertisment->name_ar = $request->name_ar;
        $advertisment->name_en = $request->name_en;
        $advertisment->link = $request->link;
        $advertisment->location = $request->location;
        $advertisment->adverise_code = $request->adverise_code;
        $advertisment->section_id = $request->section_id;
        $advertisment->start_date = $request->start_date;
        $advertisment->end_date = $request->end_date;
        $advertisment->active = $request->active;

        if(!empty($request->file('image'))){
            $photo = Storage::putFile('public', $request->file('image'));
            $advertisment->image = Storage::url($photo);
        }

        $advertisment->save();
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
        $advertisment = Advertisment::find($id) ;
        $sections = Section::all() ;
        return view(ad.'.advertisments.edite',["advertisment"=>$advertisment , 'sections' => $sections ]);
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
        if(!empty($request->link)){
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'link' => 'url',
                'location' => 'required',
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);
        }else{
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'location' => 'required',
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);
        }

        $advertisment = Advertisment::find($id);

        $advertisment->name_ar = $request->name_ar;
        $advertisment->name_en = $request->name_en;
        $advertisment->link = $request->link;
        $advertisment->location = $request->location;
        $advertisment->adverise_code = $request->adverise_code;
        $advertisment->section_id = $request->section_id;
        $advertisment->start_date = $request->start_date;
        $advertisment->end_date = $request->end_date;
        $advertisment->active = $request->active;

        if(!empty($request->file('image'))){
            $photo = Storage::putFile('public', $request->file('image'));
            $advertisment->image = Storage::url($photo);
        }

        $advertisment->save();

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
        $advertisment = Advertisment::find($id);

        $advertisment->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Advertisment::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
