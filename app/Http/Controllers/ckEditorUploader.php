<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ckEditorUploader extends Controller
{
    public function upload(Request $request){

		$this->validate($request, [
            'upload' => 'bail|image|mimes:jpg,jpeg,png,gif'
        ]);
    	// Required: anonymous function number as explained above.
		$funcNum = $request->CKEditorFuncNum ;
		// Optional: instance name (might be used to load specific configuration file or anything else)
		$CKEditor = $request->CKEditor;
		// Optional: might be used to provide localized messages
		$langCode = $request->langCode ;
		
		if(!empty($request->file('upload'))){
        $photo = Storage::putFile('public', $request->file('upload'));
        $url = url('/public').Storage::url($photo);
        $message = 'تم الرفع';
        }else{
		$message = 'فشل الرفع';
        }
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	}

    public function browse(Request $request){
    	// Required: anonymous function number as explained above.
		$funcNum = $request->CKEditorFuncNum ;
		// Optional: instance name (might be used to load specific configuration file or anything else)
		$CKEditor = $request->CKEditor;
		// Optional: might be used to provide localized messages
		$langCode = $request->langCode ;

		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

	}
}
