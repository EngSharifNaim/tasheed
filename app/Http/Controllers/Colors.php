<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Color;


class Colors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        
        return view(ad.'.colors.index',compact('colors'));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $color = Color::find($id) ;
        return view(ad.'.colors.show' , compact('color'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Color $color)
    {
        return view(ad.'.colors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Color $color)
    {

       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'color_code' => 'required',
        ]);

        $color->name_ar = $request->name_ar;
        $color->name_en = $request->name_en;
        $color->color_code = $request->color_code ;



        $color->save();

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
        $color = Color::find($id);
        return view(ad.'.colors.edite',['color'=>$color]);
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
            'color_code' => 'required',
        ]);

        $color = Color::find($id);

        $color->name_ar = $request->name_ar;
        $color->name_en = $request->name_en;
        $color->color_code = $request->color_code ;

        $color->save();

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
        $color = Color::find($id);

        $color->delete();
        return back();
    }

    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Color::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
