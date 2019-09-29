<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting; 

class Settings extends Controller
{

        public function index()
        {

            $settings = Setting::all();
            $variables = array();
            foreach ($settings as $key=>$val){
            $variables[$val->key] = $val->value;
            }

            return view(ad.'.settings.settings',compact('variables'));
        }


        public function update(Request $request)
        {
            //dd($request->data) ;
            $data = array();
            foreach ($request->data as $key=>$val){
               if( $val != null ){
                   array_push($data, array('key'=>$key,'value'=>$val));
               }
            }
            if(!empty($data)){
               Setting::truncate();
            }
            Setting::insert($data);
            $request->session()->flash('alert-success', 'تم حفظ الاعدادات بنجاح');
            return back();
        }
}
