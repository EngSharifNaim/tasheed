<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Message;
use App\Conversation;
class Messages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('conversation_id','0')->get();
        return view(ad.'.messages.index',compact('messages'));
    }


    public function conversations()
    {
        $conversations = Conversation::all();
        return view(ad.'.messages.conversations',compact('conversations'));
    }

    public function view_conversations($id)
    {
        $messages = Message::where('conversation_id',$id)->get();
        return view(ad.'.messages.show',compact('messages'));
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
}
