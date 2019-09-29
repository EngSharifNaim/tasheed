<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Review;


class Reviews extends Controller
{

    public function index()
    {
        $reviews = Review::all();
        return view(ad.'.reviews.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id) ;
        return view(ad.'.reviews.show' , ['review' => $review]) ;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $review = Review::find($id);

        $review->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Review::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
