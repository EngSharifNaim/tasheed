<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Setting;
use App\Users_addresse ;
use App\Companie ;
use Mobily ;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $settings = Setting::all();
        $variables = array();
        foreach ($settings as $key=>$val){
            $variables[$val->key] = $val->value;
        }

        $this->settings = $variables;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|
        $messages = [
            'password.regex' => "__('site.password_regex') ",
            'phone.regex' => "__('site.phone_regex')    "
        ];
        if($data['level'] == 'dealer'){
            return Validator::make($data, [
                'email' => 'required|email|max:200|regex:/([a-zA-Z0-9_-].+)@([a-zA-Z0-9_-].+)\.([a-zA-Z0-9_-].+)/i|unique:users',
                'password' => 'required|min:6|confirmed',
                'countrie_id' => 'integer|required',
                'citie_id' => 'integer|required',
                'region_id' => 'integer|required',
              // 'sitepercetage' => 'integer|required',
              //  'addresse_ar' => 'required|string|max:250',
                'phone' => 'required|numeric|min:5|regex:/^[0-9]*$/i',
                'photo' => 'bail|image|mimes:jpg,jpeg,png,gif' ,
              //  'webiste_another' => 'url' ,
            ], $messages);
        }else{
            //regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|
            return Validator::make($data, [
                'first_name' => 'required|min:3|max:100',
                'last_name' => 'required|min:3|max:100',
                'email' => 'required|email|max:200|regex:/([a-zA-Z0-9_-].+)@([a-zA-Z0-9_-].+)\.([a-zA-Z0-9_-].+)/i|unique:users',
                'password' => 'required|min:6|confirmed',
               // 'countrie_id' => 'required',
               // 'citie_id' => 'required',
               // 'region_id' => 'required',
               // 'addresse_ar' => 'required|string|max:250',
               // 'addresse_en' => 'string|max:250',
                'phone' => 'required|numeric|min:10|regex:/^[0-9]*$/i',
            ], $messages);
        }

    }

    protected function getRegister($referer) {


        return view('auth.register-new-client', compact('referer','user'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    { //&& !in_array($data['level'],['user','dealer'])
	$token = null ;
        if (empty($data['level']) ){
            $level = 'user';
        }else{
            $level = $data['level'];
        }
      
        if(!empty($data['photo'])){
            $photo = Storage::putFile('public', $data['photo']);
            $photo1 = Storage::url($photo);
        } 
//dd($token) ;
	//	$active= 'no' ;
		if(isset($this->settings['activetypea']))
		{
			if($this->settings['activetypea'] == 'yes'){
				$active = 'yes' ; 
			}else{
				$active= 'no' ;
			}
		}else{
			        if(isset($data['phone'])){
			if(isset($this->settings['site_activetsregister'])) {
				if($this->settings['site_activetsregister'] == 'yes' ) {
					$token = rand(1, 10000) ;
					$message = Mobily::send( $data['phone'] , ' كود تفعيل حسابك في تشييد هو :'.$token );
				}
			}
			 //$message = Mobily::send( $data['phone'] , $request->messages );
		}
			$active= 'no' ;
		}  
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['first_name']." ".$data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'sitepercetage' => (isset($data['sitepercetage'] )) ? $data['sitepercetage']  : 0,
            'countrie_id' => (isset($data['countrie_id'])) ? $data['countrie_id'] : 0,
            'citie_id' => (isset($data['citie_id'])) ? $data['citie_id'] : 0,
            'region_id' =>  (isset($data['region_id'])) ? $data['region_id'] : 0,
            'zip_code' => (isset($data['zip_code'] )) ? $data['zip_code']  : 0 ,
            'location' => (isset($data['company_location'])) ? $data['company_location']:null,
            'another_website_link' =>  (isset($data['webiste_another'])) ? $data['webiste_another'] : null,
            'describtion' =>  (isset($data['describtion'])) ? $data['describtion'] : null,
            'active' => $active ,
            'level' => $level,
            'photo' => (isset($photo1)) ? $photo1 : null,
            'password' => bcrypt($data['password']) ,
			'token' => $token
        ]);
       if($level == 'dealer'){
        $user_addresse = Users_addresse::create([
            'user_id' => $user['id'] ,
            'countrie_id' =>$data['countrie_id'] ,
            'citie_id' => $data['citie_id'],
            'region_id' => $data['region_id'],
             'addresse_ar' =>(isset($data['addresse_ar'])) ? $data['addresse_ar'] : 'e'  ,
            'lat' =>(isset($data['lat'])) ? $data['lat'] : null   ,
            'lang' =>(isset($data['lang'])) ? $data['lang'] : null   ,
            'addresse_en' =>(isset($data['addresse_en'])) ? $data['addresse_en'] : null    ,
            'location' => (isset($data['company_location'])) ? $data['company_location']:null,
            'restrict_name_ar' => (isset($data['restrict_name_ar'])) ? $data['restrict_name_ar'] : null ,
            'restrict_name_en' => (isset($data['restrict_name_en'])) ? $data['restrict_name_en'] : null ,
            'mail_number' => (isset($data['zip_code'])) ? $data['zip_code'] : null ,
            'active' => 'yes' ,
        ]);
	   }

        if($level != 'user'){
            Companie::create([
                'user_id' => $user['id'] ,
                'name_ar' => (isset($data['company_name_ar'])) ?  $data['company_name_ar'] : null  ,
                'name_en' => (isset($data['company_name_en'])) ?  $data['company_name_en'] : null  ,
                'phone' => (isset($data['company_phone'])) ?  $data['company_phone'] : null  ,
                'location' => (isset($data['company_location'])) ? $data['company_location']:null,
                'email' =>  $data['email'],
                'tax_number' => (isset($data['company_tax_number'])) ?  $data['company_tax_number'] : null  ,
                'commercial_register' => (isset($data['commercial_register'])) ?  $data['commercial_register'] : null  ,
                'bank_name' =>(isset($data['bank_name'])) ?  $data['bank_name'] : null  ,
                'acount_bank_number' => (isset($data['acount_bank_number'])) ?  $data['acount_bank_number'] : null  ,
                'company_website' => (isset($data['company_website'])) ?  $data['company_website'] : null  ,
            ]);
        }
        return $user;
    }
    /**
     * Register new user
     *
     * @param  array  $data
     * @return User
     */
    public function register(Request $request)
    {  

        $input = $request->all();
        $validator = $this->validator($input);
       //
        if ( ! $validator->fails()) {
            $user = $this->create($input)->toArray(); // dd($user) ;
			$userdataa = User::where('email' , $user['email'])->first() ;
		     if($userdataa->active == 'yes'){
				   return redirect()->to('login')
                    ->with('success','تم تفعيل الاكونت الخاص بكم عن طريق التفعيل المباشر يمكنكم الدخول');
			 } 
            $user['link'] = str_random(30);
           if(isset($this->settings['site_activetsregister'])){
			   if($this->settings['site_activetsregister'] == 'no' ){
				  DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);

				Mail::send('emails.activation', $user, function($message) use ($user) {
					$message->from($this->settings['site_email'], $this->settings['site_title']);
					$message->to($user['email']);
					$message->subject( __("site.snod_activation_message") );
				});

            return redirect()->to('login')
                ->with('success',__("site.activation_mail_message")); 
			   }else{
				     return redirect()->to('login')
                ->with('success','تم ارسال رساله التفعيل لك  على رقم الجوال الذى تم ادخاله ' ); 
			   }
		   }else{
			   DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);

            Mail::send('emails.activation', $user, function($message) use ($user) {
                $message->from($this->settings['site_email'], $this->settings['site_title']);
                $message->to($user['email']);
                $message->subject( __("site.snod_activation_message") );
            });

            
		   }
            return redirect()->to('login')
                ->with('success',__("site.activation_mail_message"));
        }
        return back()->with('errors',$validator->errors());

    }

    /**
     * Check for user Activation Code
     *
     * @param  array  $data
     * @return User
     */
    public function userActivation($token)
    {
        $check = DB::table('user_activations')->where('token',$token)->first();

        if(!is_null($check)){
            $user = User::find($check->id_user);
	  if(isset($this->settings['activetype'])){
		  
			if($this->settings['activetype'] == 'yes' ){
				 if($user->active == 'yes'){
                return redirect()->to('login')
                    ->with('success',__("site.acount_actived_befor"));
            }
            $user->active = 'yes';
            $user->update();
            DB::table('user_activations')->where('token',$token)->delete();

            return redirect()->to('login')
                ->with('success',__("site.acount_actived"));
			}
			else{
				 if($user->active == 'yes'){
                return redirect()->to('login')
                    ->with('success',__("site.acount_actived_befor"));
            }
            $user->active = 'no';
            $user->update();
            DB::table('user_activations')->where('token',$token)->delete();

            return redirect()->to('login')
                ->with('success','تم تفعيل حسابك وفى انتظار موافقه الادمن');
			}
	    }else{
			 if($user->active == 'yes'){
                return redirect()->to('login')
                    ->with('success',__("site.acount_actived_befor"));
            }
            $user->active = 'yes';
            $user->update();
            DB::table('user_activations')->where('token',$token)->delete();

            return redirect()->to('login')
                ->with('success',__("site.acount_actived"));
		}
           
        }

        return redirect()->to('login')
            ->with('warning',__("site.activation_message_error"));
    }
}
