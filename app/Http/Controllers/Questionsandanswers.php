<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Questionsandanswer;
use Auth;

class Questionsandanswers extends Controller
{

    public function index()
    {
        $questionsandanswers = Questionsandanswer::all();
        return view(ad.'.questionsandanswers.index',compact('questionsandanswers'));
    }
    /*********
     * function show question and his answers
     */
    public function show($id)
    {
        $questionsandanswer = Questionsandanswer::find($id) ;
        return view(ad.'.questionsandanswers.show',["question"=>$questionsandanswer]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Questionsandanswer $questionsandanswer)
    {
        return view(ad.'.questionsandanswers.add');
    }
    /**
     * Store a newly created resource in storage.
     *store new news
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Questionsandanswer $questionsandanswer)
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required' ,
            'description_en' => 'required' ,
        ]);
        $questionsandanswer->name_ar = $request->name_ar;
        $questionsandanswer->name_en = $request->name_en;
        $questionsandanswer->description_ar = $request->description_ar;
        $questionsandanswer->description_en = $request->description_en;
        $questionsandanswer->active = $request->active;

        $questionsandanswer->save();
        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $questionsandanswer = Questionsandanswer::find($id) ;
        return view(ad.'.questionsandanswers.edite',["question"=>$questionsandanswer]);
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
            'description_ar' => 'required' ,
            'description_en' => 'required' ,
        ]);

        $questionsandanswer = Questionsandanswer::find($id);

        $questionsandanswer->name_ar = $request->name_ar;
        $questionsandanswer->name_en = $request->name_en;
        $questionsandanswer->description_ar = $request->description_ar;
        $questionsandanswer->description_en = $request->description_en;
        $questionsandanswer->active =$request->active ;

        $questionsandanswer->save();
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
        $questionsandanswer = Questionsandanswer::find($id);
        $questionsandanswer->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

    public function mass_delete(Request $request )
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Questionsandanswer::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

}
