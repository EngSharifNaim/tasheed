<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact_Message;

class Contact_Messages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = Contact_Message::where('archive','no')->get();
        return view(ad.'.contact_messages.index',compact('messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $messages = Contact_Message::where('archive','yes')->get();
        
        return view(ad.'.contact_messages.index',compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Contact_Message::find($id);
       return view(ad.'.contact_messages.show',compact('message'));
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function mass_delete( Request $request )
    {

       if( empty($request->checkboxes) ){
            $request->session()->flash('alert-success', __('admin.contact_us_error_selection'));
        }

        if(!empty($request->archive) ) {

            Contact_Message::whereIn('id' ,  $request->checkboxes)->update(['archive' => 'yes' ]);
            return back() ;
        }

        if(!empty($request->unarchive) ) {

            Contact_Message::whereIn('id' ,  $request->checkboxes)->update(['archive' => 'no' ]);
            return back() ;
        }

        if(!empty($request->delete)){

            Contact_Message::destroy($request->checkboxes);
            return back()  ;
        }



      //  return redirect('/admin/contact_messages/archived');
    }

    public function destroy(Request $request,$id)
    {
        $message = Contact_Message::find($id);

        $message->delete();
        $request->session()->flash('alert-success', 'تمت عملية الحذف بنجاح');
        return back();
    }


}
