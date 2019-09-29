<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Product ;
use App\Section ;
use App\Brand ;
use App\Color ;
use App\Size ;
use App\User ;
use App\Measurements_unit ;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterProduct(Request $request)
    {
        $products = Product::orderBy('id', 'DESC')->where('section_id' , $request->section_id  )->get();

        return view(ad.'.products.products_ajax',compact('products'));
    }
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();

        return view(ad.'.products.index',compact('products'));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $sections = Section::where('parent_id' , 0)->get() ;
        $brands = Brand::all() ;
        $colors = Color::all() ;
        $sizes = Size::all() ;
        $users = User::all() ;
        $product = Product::find($id) ;
        $measurements_units = Measurements_unit::all() ;
        return view(ad.'.products.show' , compact( 'measurements_units', 'product' ,'users' , 'sections' , 'brands' , 'colors' , 'sizes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $sections = Section::where('active' , 'yes')->where('parent_id' , 0)->get() ;
        $brands = Brand::where('active' , 'yes')->get() ;
        $colors = Color::all() ;
        $sizes = Size::all() ;
        $users = User::where('active' , 'yes')->get() ;
        $measurements_units = Measurements_unit::all() ;
        return view(ad.'.products.add' , compact('measurements_units' , 'users' , 'sections' , 'brands' , 'colors' , 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        //dd($request->parent_id) ;
        $this->validate($request, [
            'name_ar' => 'required|min:3',
            'description_ar' => 'required|min:30' ,
            'price' => 'required' ,
            'parent_id' => 'required|integer' ,
            'min_quantity' => 'required|integer' ,
            'product_owner_id' => 'required' ,
            'image'=>'bail|image|mimes:jpg,jpeg,png,gif' ,
            'manfacture_country' => 'required' ,
        ]);

        if(isset($request->sub_id)){
            $this->validate($request, [
                'sub_id' => 'required|integer',
            ]);
        }

        if(isset($request->sub_sub_section_id)){
            $this->validate($request, [
                'sub_id' => 'required|integer',
                'sub_sub_id' => 'required|integer',
            ]);
        }

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->description_ar = $request->description_ar ;
        $product->description_en = $request->description_en ;
        $product->keywords_ar = $request->keywords_ar ;
        $product->keywords_en = $request->keywords_en ;
        $product->brand_id = $request->brand_id ;
        $product->section_id = $request->parent_id ;
        $product->sub_section_id =(isset($request->sub_id )  ) ? $request->sub_id: 0;
        $product->sub_sub_section_id = (isset($request->sub_sub_id )  ) ? $request->sub_sub_id: 0 ;
        $product->product_owner_id = $request->product_owner_id ;
        $product->price = $request->price ;
        $product->weight =  (isset($request->weight )  ) ? $request->weight: 1 ;
        $product->min_price = $request->min_price ;
        $product->quantity = $request->quantity ;
        $product->min_quantity = $request->min_quantity ;
        $product->max_quantity = $request->max_quantity ;
        $product->active = $request->active ;
        $product->featured = $request->featured ;
        $product->manfacture_country =   (isset($request->manfacture_country )  ) ? $request->manfacture_country : 0;
        $product->measurements_unit_id =  (isset($request->measurements_unit_id )  ) ? $request->measurements_unit_id : 0;

        //upload one image
        if(!empty($request->file('image'))){
            $image = Storage::putFile('public', $request->file('image'));
            $product->image = Storage::url($image);
        }

        //uploaded many image
        $files = $request->file('images');
        if(!empty($request->hasFile('images')))
        {
            $files_list = array();
            foreach ($files as $key=>$file) {
                if($key == 5 ) { break ; }

                $photo = Storage::putFile('public' , $file);
                $original = Storage::url($photo);
                array_push($files_list,$original);

            }
            $product->images = implode(",",$files_list);
        }

        //save colors
        if(!empty($request->colors))
        {
            $colors = array();
            foreach ($request->colors as $color) {

                array_push($colors , $color);

            }
            $product->color_id = implode(",",$colors );
        }

        //save sizes
        if(!empty($request->sizes))
        {
            $sizes = array();
            foreach ($request->sizes as $size) {

                array_push($sizes , $size);

            }
            $product->size_id = implode(",",$sizes );
        }
        //option arabic
        if(!empty($request->details_ar))
        {
            $details_ar = array();
            foreach ($request->details_ar as $detail_ar) {

                array_push($details_ar , $detail_ar);

            }
            $product->details_ar = implode(",",$details_ar );
        }
        //option english
        if(!empty($request->details_en))
        {
            $details_en = array();
            foreach ($request->details_ar as $detail_en) {

                array_push($details_en , $detail_en);

            }
            $product->details_en = implode(",",$details_en );
        }



        $product->save();

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
        $product = Product::find($id);
        $sections = Section::where('parent_id' , 0)->get() ;
        $brands = Brand::all() ;
        $colors = Color::all() ;
        $sizes = Size::all() ;
        $users = User::all() ;
        $measurements_units = Measurements_unit::all() ;
        return view(ad.'.products.edite',compact( 'measurements_units' , 'product', 'users' , 'sections' , 'brands' , 'colors' , 'sizes'));
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
            'description_ar' => 'required|min:30' ,
            'description_en' => 'required' ,
            'price' => 'required' ,
            'parent_id' => 'required|integer' ,
            'product_owner_id' => 'required' ,
            'min_quantity' => 'required|integer' ,
            'image'=>'bail|image|mimes:jpg,jpeg,png,gif' ,
        ]);

        if(isset($request->sub_id)){
            $this->validate($request, [
                'sub_id' => 'required|integer',
            ]);
        }

        if(isset($request->sub_sub_section_id)){
            $this->validate($request, [
                'sub_id' => 'required|integer',
                'sub_sub_id' => 'required|integer',
            ]);
        }

        $product = Product::find($id) ;

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->description_ar = $request->description_ar ;
        $product->description_en = $request->description_en ;
        $product->keywords_ar = $request->keywords_ar ;
        $product->keywords_en = $request->keywords_en ;
        $product->brand_id = $request->brand_id ;
        $product->section_id = $request->parent_id ;
        $product->sub_section_id =(isset($request->sub_id )  ) ? $request->sub_id: 0;
        $product->sub_sub_section_id = (isset($request->sub_sub_id )  ) ? $request->sub_sub_id: 0 ;
        $product->product_owner_id = $request->product_owner_id ;
        $product->price = $request->price ;
        $product->weight =  (isset($request->weight )  ) ? $request->weight: 1 ;
        $product->min_price = $request->min_price ;
        $product->quantity = $request->quantity ;
        $product->min_quantity = $request->min_quantity ;
        $product->max_quantity = $request->max_quantity ;
        $product->active = $request->active ;
        $product->featured = $request->featured ;
        $product->manfacture_country =   (isset($request->manfacture_country )  ) ? $request->manfacture_country : 0;
        $product->measurements_unit_id =  (isset($request->measurements_unit_id )  ) ? $request->measurements_unit_id : 0;

        //upload one image
        if(!empty($request->file('image'))){
            $image = Storage::putFile('public', $request->file('image'));
            $product->image = Storage::url($image);
        }

        //uploaded many image
        $files = $request->file('images');
        if(!empty($request->hasFile('images')))
        {
            $files_list = array();
            foreach ($files as $key=>$file) {
                if($key == 5 ) { break ; }

                $photo = Storage::putFile('public' , $file);
                $original = Storage::url($photo);
                array_push($files_list,$original);

            }
            $product->images = implode(",",$files_list);
        }

        //save colors
        if(!empty($request->colors))
        {
            $colors = array();
            foreach ($request->colors as $color) {

                array_push($colors , $color);

            }
            $product->color_id = implode(",",$colors );
        }

        //save sizes
        if(!empty($request->sizes))
        {
            $sizes = array();
            foreach ($request->sizes as $size) {

                array_push($sizes , $size);

            }
            $product->size_id = implode(",",$sizes );
        }

        //option arabic
        if(!empty($request->details_ar) || $request->details_ar != null  )
        {
            $details_ar = array();
            foreach ($request->details_ar as $detail_ar) {
               if(isset($detail_ar)){
                   array_push($details_ar , $detail_ar);
               }
            }
            $product->details_ar = implode(",",$details_ar );
        }else{
            $product->details_ar = null ;
        }
        //option english
        if(!empty($request->details_en) || isset($request->details_en))
        {
            $details_en = array();
            foreach ($request->details_en as $detail_en) {
              if(isset($detail_en) ||  $detail_en != " " ){
                  array_push($details_en , $detail_en);
              }
            }
            $product->details_en = implode(",",$details_en );
        }else{
            $product->details_en = null ;
        }


        $product->save();

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
        $product = Product::find($id);

        $product->delete();
        return back();
    }

    /**
     * @param Request $request  delete many products
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Product::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
