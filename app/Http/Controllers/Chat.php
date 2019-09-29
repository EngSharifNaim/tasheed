<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Message;
use App\Conversation;
class Chat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*   $messages = Message::where('conversation_id','0')->get();
        return view(ad.'.messages.index',compact('messages'));*/
        $conversations = Conversation::all();
        return view(ad.'.chat.conversations',compact('conversations'));
    }


  /*  public function conversations()
    {
        $conversations = Conversation::all();
        return view(ad.'.messages.conversations',compact('conversations'));
    }*/

    public function show($id)
    {
        $messages = Message::where('conversation_id',$id)->get();
        return view(ad.'.chat.show',compact('messages'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $message = Message::find($id);

        $message->delete();
        $request->session()->flash('alert-success', 'تمت عملية الحذف بنجاح');
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Message::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
