<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Userlevel;

class Userlevels extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $userlevels = Userlevel::all();
        
        return view(ad.'.userlevels.index',compact('userlevels'));
    }
    /**
     * show userlevel data
     */
    public function show($id)
    {
        $userlevel = Userlevel::find($id) ;
        return view(ad.'.userlevels.show' , compact('userlevel')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Userlevel $userlevel)
    {
        return view(ad.'.userlevels.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Userlevel $userlevel)
    {
       $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
			'image'=>'bail|image|mimes:jpg,jpeg,png,gif' ,
        ]);

        $userlevel->name_en = $request->name_en;
        $userlevel->name_ar = $request->name_ar;
        $userlevel->slug =  str_slug($request->name_en, '_');

       if(!empty($request->file('image'))){
            $image = Storage::putFile('public', $request->file('image'));
            $userlevel->image = Storage::url($image);
        }
		
        $userlevel->save();

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
        $userlevel = Userlevel::find($id);
        return view(ad.'.userlevels.edite',['userlevel'=>$userlevel]);
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
			'image'=>'bail|image|mimes:jpg,jpeg,png,gif' ,
        ]);
        $userlevel = Userlevel::find($id);
      
        $userlevel->name_ar = $request->name_ar;
        $userlevel->name_en = $request->name_en;
        $userlevel->slug =  str_slug($request->name_en, '_');
  if(!empty($request->file('image'))){
            $image = Storage::putFile('public', $request->file('image'));
            $userlevel->image = Storage::url($image);
        }
        $userlevel->save();

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
        $userlevel = Userlevel::find($id);

        $userlevel->delete();
        return back();
    }

    /**
     * @param Request $request
     * @param Countrie $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_delete(Request $request , Userlevel $userlevel)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        $userlevel->destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
