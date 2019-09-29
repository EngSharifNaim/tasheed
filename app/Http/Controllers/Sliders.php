<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Slider;

class Sliders extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view(ad.'.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $slider = Slider::find($id) ;
     return view(ad.'.sliders.show' , ['slider' => $slider]) ;
    }
    /*
     *
     */
    public function create(Slider $slider)
    {
        return view(ad.'.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Slider $slider)
    {
       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        if($request->url) {
            $this->validate($request, [
                'link' => 'url',
            ]);
        }

        $slider->name_ar = $request->name_ar;
        $slider->name_en = $request->name_en;
        $slider->description_ar = $request->description_ar;
        $slider->description_en = $request->description_en;
        $slider->active = $request->active;
        $slider->link = $request->link;

        if(!empty($request->file('image'))){
        $photo = Storage::putFile('public', $request->file('image'));
            $slider->photo = Storage::url($photo);
        }

        $slider->save();
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
        $slider = Slider::find($id) ;

        return view(ad.'.sliders.edite',["slider"=>$slider]);
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
            'name_ar' => 'required' ,
            'name_en' => 'required' ,
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        if($request->url) {
            $this->validate($request, [
                'link' => 'url',
            ]);
        }

        $slider = Slider::find($id);

        $slider->name_ar = $request->name_ar;
        $slider->name_en = $request->name_en;
        $slider->description_ar = $request->description_ar;
        $slider->description_en = $request->description_en;
        $slider->active = $request->active;
        $slider->link = $request->link;

        if(!empty($request->file('image'))){
        $photo = Storage::putFile('public', $request->file('image'));
            $slider->photo = Storage::url($photo);
        }

        $slider->save();
        
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
         $slider = Slider::find($id);

         $slider->delete();
         $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
       
       Slider::destroy($request->checkboxes);
         $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
