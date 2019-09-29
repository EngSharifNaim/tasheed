<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use PhpParser\ParserAbstract;

class Pages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        
        return view(ad.'.pages.index',compact('pages'));
    }
    /**
     * show function
     */
    public function show($id)
    {
        $page = Page::find($id) ;
        return view(ad.'.pages.show' , ['page'=>$page]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        $parents = Page::where('parent_id',0)->get();
        return view(ad.'.pages.add',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Page $page)
    {
       $this->validate($request, [
            'name_ar' => 'required|unique:pages',
            'name_en' => 'required|unique:pages',
        ]);
       if($request->url) {
           $this->validate($request, [
                'url' => 'url',
           ]);
       }

        $page->parent_id = $request->parent_id;
        $page->name_ar = $request->name_ar;
        $page->name_en = $request->name_en;
        $page->url = $request->url;
        $page->description_ar = $request->description_ar;
        $page->description_en = $request->description_en;
        $page->active = $request->active;
        $page->page_location = $request->page_location;
        $page->sorting = $request->sorting;
        $page->menu = $request->menu;

        $page->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(Page $page)
    {
         $parents = Page::where('parent_id',0)->get();
        return view(ad.'.pages.edite',['page'=>$page,'parents'=>$parents]);
    }*/

    public function edit(Page $page)
    {
         $parents = Page::where('parent_id',0)->get();
        return view(ad.'.pages.edite',['page'=>$page,'parents'=>$parents]);
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
            'name_ar' => 'required|unique:pages,name_ar,'.$id,
            'name_en' => 'required|unique:pages,name_en,'.$id,
        ]);
        if($request->url) {
            $this->validate($request, [
                'url' => 'url',
            ]);
        }
        $page = Page::find($id);
        $page->parent_id = $request->parent_id;
        $page->name_ar = $request->name_ar;
        $page->name_en = $request->name_en;
        $page->url = $request->url;
        $page->description_ar = $request->description_ar;
        $page->description_en = $request->description_en;
        $page->active = $request->active;
        $page->page_location = $request->page_location;
        $page->sorting = $request->sorting;
        $page->menu = $request->menu;
		$page->menu = $request->menu;
		
        $page->save();

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
        $Page = Page::find($id);

        $Page->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Page::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
