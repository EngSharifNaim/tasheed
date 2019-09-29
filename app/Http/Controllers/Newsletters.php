<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Newsletter ;
use Mail ;
use App\Setting ;

class Newsletters extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	   public function __construct()
    {
        $settings = Setting::all();
        $variables = array();
        foreach ($settings as $key=>$val){
            $variables[$val->key] = $val->value;
        }

        $this->settings = $variables;
    }
    public function index()
    {
        $newsletters = Newsletter::all();
        
        return view(ad.'.newsletters.index',compact('newsletters'));
    }
    /**
     * show function show  data for country
     */

    public  function show($id)
    {
        $newsletter = Newsletter::find($id) ;
        return view(ad.'.newsletters.show' , compact('newsletter'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
   public function create(Newsletter $newsletter)
    {
        return view(ad.'.newsletters.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Newsletter $newsletter)
    {
       $this->validate($request, [
            'email' => 'required',
        ]);

        $newsletter->email = $request->email ;

        $newsletter->save();
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
        $newsletter = Newsletter::find($id);
        return view(ad.'.newsletters.edite',['newsletter'=>$newsletter]);
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
            'email' => 'required',
        ]);

        $newsletter = Newsletter::find($id);
        $newsletter->email = $request->email;

        $newsletter->save();
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
        $newsletter = Newsletter::find($id);

        $newsletter->delete();
        return back();
    }

    public function mass_delete(Request $request , Newsletter $country)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', 'الرجاء تحديد من تريد ارسال الرسايل له ');
            return back();
        }
      //  $country->destroy($request->checkboxes);
	  foreach($request->checkboxes as $key=>$id){
		   $newsletter = Newsletter::find($id);
		   $newsletter = $newsletter->toArray() ;
		   $newsletter['text'] = $request->text ;
		   $newsletter['title'] = $request->title ;
		   $newsletter['name'] = 'رساله من موقع تشيد' ;
		  $request->session()->flash('alert-success',  __('site.message_success'));
		   Mail::send('emails.contact', $newsletter, function($message) use ($newsletter) {
                $message->from($this->settings['site_email'] , $newsletter['title'] );
                $message->to($newsletter['email']);
                $message->subject($newsletter['text'] );
            });
	  }
			
		//dd($user['name']) ;
        
       // return back();


        $request->session()->flash('alert-success','تم ارسال رساله لكل الاعضاء المحددين' );
        return back();
    }
}
