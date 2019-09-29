<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Message;
use App\Conversation;
use App\User;
use Mobily ;

class Mobilymessages extends Controller
{
   	public function index()
    {
		$balance = Mobily::Balance(); ; //  echo $balance ; dd() ;//dd($balance) ;
        return view(ad.'.mobilymessages.index' , ['balance' =>$balance]);
   	}

   	public function update(Request $request)
    {
		try{
        $users = User::where('phone' ,'!=' , null )->where('deleted_at' , null)->get() ;
        if(isset($request->all)){
            $mobile_number = array() ;
            foreach ($users as $user){
                if(!empty($user->phone)){
                    array_push($mobile_number , $user->phone ) ;
                }

            }


            $message = Mobily::send(implode(",",$mobile_number) , $request->messages );
			

        }
        if(isset($request->phones)){ 
            $message = Mobily::send($request->phones , $request->messages );
			//dd($message) ;
		if(!$message){
			$request->session()->flash('alert-success', 'حدث خطا ');
		}
           
        }
   		$request->session()->flash('alert-success', 'تم ارسال الرسايل بنجاح');
   		return back();
		}catch(Exception $e)
		{
			$request->session()->flash('alert-success', 'حدث خطا ');
		}
   	}
}
