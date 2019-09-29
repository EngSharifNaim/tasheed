<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Brand;
use App\Brand_section ;
use App\Section ;
use Carbon\Carbon;

class Brands extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        return view(ad.'.brands.index',compact('brands'));
    }
    /**
     * function for show
     */
    public function show($id)
    {
        $brand = Brand::find($id) ;
        return view(ad.'.brands.show' , compact('brand')) ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand)
    {
        $sections = Section::where('active' , '=' , 'yes')->get() ;
        return view(ad.'.brands.add' , compact('sections') );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Brand $brand)
    {
        $this->validate($request, [
            'name_ar' => 'required|unique:brands',
            'name_en' => 'required|unique:brands',
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);


        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->description_ar = $request->description_ar;
        $brand->description_en = $request->description_en;
        $brand->active = $request->active;

        if(!empty($request->file('image'))){
            $photo = Storage::putFile('public', $request->file('image'));
            $brand->photo = Storage::url($photo);
        }


        $brand->save();
        //save sections
        if(!empty($request->sections)){
            $data = array() ;
            foreach ($request->sections  as $section){
                $section_brand = array('section_id' => $section , 'brand_id' => $brand->id ) ;
                array_push($data , $section_brand) ;
            }
            Brand_section::insert($data) ;
        }

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
        $brand = Brand::find($id) ;
        $sections = Section::where('active' , '=' , 'yes')->get() ;
        $current_sections = array() ;
        foreach ($brand->brand_section_list as $section )
        {
            array_push( $current_sections , $section->section_id) ;
        }
        return view(ad.'.brands.edite',["brand"=>$brand , 'sections' =>$sections  , 'current_sections' => $current_sections   ]);
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
            'name_ar' => 'required|unique:brands,name_ar,'.$id,
            'name_en' => 'required|unique:brands,name_en,'.$id,
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        $brand = Brand::find($id);

        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->description_ar = $request->description_ar;
        $brand->description_en = $request->description_en;
        $brand->active = $request->active;

        if(!empty($request->file('image'))){
            $photo = Storage::putFile('public', $request->file('image'));
            $brand->photo = Storage::url($photo);
        }

        $brand->save();
        if(!empty($request->sections)){
            Brand_section::where('brand_id' , $id)->delete();
            $data = array() ;
            foreach ($request->sections  as $section){
                $section_brand = array('brand_id' => $id , 'section_id' => $section ) ;
                array_push($data , $section_brand) ;
            }
            Brand_section::insert($data) ;
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
    public function destroy(Request $request,$id)
    {
        $brand = Brand::find($id);
        $brand->delete() ;
        return back();
    }


    public function mass_delete(Request $request , Brand $brand)
    {

        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

       // $brand->destroy($request->checkboxes);
        $brand->whereIn('id', $request->checkboxes)->delete();

        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

    //brands list according to section
    public function brands_list(Request $request)
    {
        $brands = Section::find($request->section)->brands()->get();
        //return $request->current ;

        $current = (isset($request->current )  ) ? $request->current : 0;
        if(isset($request->brand) ){
            if($request->brand > 0 ) {
                $current = $request->brand ;
            }else{
                $current = 0 ;
            }
        }else{
            $current = 0 ;
        }
      //  return $current ;
        return view(ad.'.brands.list',["brands"=>$brands , 'brand_id'=> $current ]);
    }

}
