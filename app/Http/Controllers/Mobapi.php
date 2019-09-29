<?php

namespace App\Http\Controllers;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Section ;
use App\Slider ;
use App\Brand ;
use App\Setting ;
use App\Product ;
use App\Review ;
Use App\Questionsandanswer ;
use App\Page ;
Use App\Currencie ;
Use App\Advertisment ;
use Illuminate\Support\Facades\Lang ;
use Auth ;
use App\Countrie ;
use App\Citie ;
use App\Region ;
use App\Products_view ;
use App\Users_favourites_product ;
use App\Favoriteable ;
use Cart ;
use App\Users_addresse ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session ;
use App\Shiping ;
use App\User ;
use App\Helpers\AdvancedSearch;
use Mail ;
use App\Userlevel ;
use App\Cupon ;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;
use Mobily ;
use DB ;
use App\Order_product ;
use App\Order ;
use App\Conversation;
use App\Message;
class Mobapi extends Controller
{
	
    public function __construct()
    {
        $settings = Setting::all();
        $variables = array();
        foreach ($settings as $key=>$val){
            $variables[$val->key] = $val->value;
        }

        $this->settings = $variables;
    }
	
	//user functions 
	 public function login(Request $request  )
    {
		
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'  ,
            'passowrd' => 'required' ,
        ]); 
        if($validator->fails()){ 
            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 3,
                'message' => $errors_list
            ]); 
        }else {   
            $username = $request->email;
            $password = $request->passowrd; 
			$dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
             );
            if (Auth::attempt(['email' => $request->email ,'password' => $password])) {

                 if(Auth::user()->active == 'no'){
                      return response()->json([
                          'status' => 2,
                          'message' => 'الحساب غير مفعل'
                      ]);
                  }else{   //
               $client =  new Client(['base_uri' => $this->settings['site_path']]);
                $response = $client->request('POST', $this->settings['site_path'].'oauth/token', [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => '3',
                        'client_secret' => 'fsKHIlhbRNaFuC3FyXElwvJ7iu37xAhbnwjnf9Qi',
                        'username' => $request->email,
                        'password' => $request->passowrd,
                        'scope' => '*',
                    ],
                ]);  
				if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody());                
                   
                    //end savinf device id
					if(empty(Auth::user()->photo)){
						$photo = $this->settings['site_path'].'public/default/imagedefault.jpg' ;
					}else{
						$photo = url('/public').Auth::user()->photo ;
					}  
				    if(Auth::user()->level == 'user'){
						return response()->json([
                        'status' => 1,
                        'message' => '',
                        'data' => array([
                             'AccessToken' => $data->access_token,
                             'id' => Auth::user()->id , 
                             'first_name' => Auth::user()->first_name ,
							 'last_name' =>Auth::user()->last_name ,
							 'name' =>Auth::user()->name ,
							 'email' =>Auth::user()->email ,
							 'photo' =>$photo ,
                        ]),
                    ]);
					}else{
						 return response()->json([
                        'status' => 3,
                        'message' => 'لا تسطيع تسجل الدخول من الموبيل حيث ان حسابك ليس مشترى '
                    ]);
					}
                    
                } else {
                    return response()->json([
                        'status' => 3,
                        'message' => 'الايميل او الباسورد خطا '
                    ]);
                }

               }

            } else {
                return response()->json([
                    'status' => 3,
                    'message' => 'الايميل او الباسورد خطا'
                ]);
            }
        }  
    }
    /*
    *
    */
    public function register(User $user,Request $request)
    {
	
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);
        if($validator->fails()){

            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 0,
                'message' => $errors_list
            ]);

        }else {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name ;
            $user->name = $request->first_name." ".$request->last_name ;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->level = 'user';
			$token = rand(1, 10000) ;
			$user->token = $token ;
          //  $user->active = 'yes';
           if ($request->file('photo')) {
                 $photo = Storage::putFile('public', $request->file('photo')); //base64_decode(
                 $user->photo = Storage::url($photo);
             } 
            if (!$user->save()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'فشل عمليه التسجيل'
                ]);
            }
			
			$message = Mobily::send( $user->phone , ' كود تفعيل حسابك في تشييد هو :'.$token );
            $username = $request->email ;
            $password = $request->passowrd;  
			$dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
             ); 
            if (Auth::attempt($dataAttempt)) { 
                 if(Auth::user()->active == 'no'){
                      return response()->json([
                          'status' => 2,
                          'message' => 'الحساب غير مفعل'
                      ]);
                  }else{   //
               $client =  new Client(['base_uri' => $this->settings['site_path']]);
                $response = $client->request('POST', $this->settings['site_path'].'oauth/token', [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => '3',
                        'client_secret' => 'fsKHIlhbRNaFuC3FyXElwvJ7iu37xAhbnwjnf9Qi',
                          'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*',
                    ],
                ]);
				if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody()); 
                   
                    //end savinf device id
                   	if(empty(Auth::user()->photo)){
						$photo = $this->settings['site_path'].'public/default/imagedefault.jpg' ;
					}else{
						$photo = url('/public').Auth::user()->photo ;
					} 
                    return response()->json([
                        'status' => 1,
                        'message' => '',                       
                    ]);
                } else {
                    return response()->json([
                        'status' => 3,
                        'message' => 'الايميل او الباسورد خطا '
                    ]);
                }

               }

            }  
   
        }
    }
	
	public function activeAcount(Request $request)
	{ //dd(Auth::user()->first_name) ;
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'token' => 'required|string',
        ]);
        if($validator->fails()){

            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 0,
                'message' => $errors_list
            ]);

        }else {
			$user = User::where('email' , $request->email)->first() ;
			if($user->token == $request->token){
				$user->active = 'yes' ;
				$user->save() ;
			$dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
             ); 
            if (Auth::attempt($dataAttempt)) { 
                 if(Auth::user()->active == 'no'){
                      return response()->json([
                          'status' => 2,
                          'message' => 'الحساب غير مفعل'
                      ]);
                  }else{   //
               $client =  new Client(['base_uri' => $this->settings['site_path']]);
                $response = $client->request('POST', $this->settings['site_path'].'oauth/token', [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => '3',
                        'client_secret' => 'fsKHIlhbRNaFuC3FyXElwvJ7iu37xAhbnwjnf9Qi',
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*',
                    ],
                ]);
				if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody()); 
                   
                    //end savinf device id
                   	if(empty(Auth::user()->photo)){
						$photo = $this->settings['site_path'].'public/default/imagedefault.jpg' ;
					}else{
						$photo = url('/public').Auth::user()->photo ;
					} 
                   	return response()->json([
                        'status' => 1,
                        'message' => '',
                        'data' => array([
                             'AccessToken' => $data->access_token,
                             'id' => Auth::user()->id , 
                             'first_name' => Auth::user()->first_name ,
							 'last_name' =>Auth::user()->last_name ,
							 'name' =>Auth::user()->name ,
							 'email' =>Auth::user()->email ,
							 'photo' =>$photo ,
                        ]),
                    ]);
                } else {
                    return response()->json([
                        'status' => 3,
                        'message' => 'الايميل او الباسورد خطا '
                    ]);
                }

               }

            } 
			}else{
				  return response()->json([
                'status' => 0,
                'message' => 'الكود غير صحيح'
               ]);
			}
		}
	}
	
	public function getMyProfile()
	{ //dd(Auth::user()) ;
		if(empty(Auth::user()->photo)){
						$photo = $this->settings['site_path'].'public/default/imagedefault.jpg' ;
					}else{
						$photo = url('/public').Auth::user()->photo ;
					} 
		return response()->json([
                        'status' => 1,
                        'message' => '',
                        'data' => array([
                             'id' => Auth::user()->id , 
                             'first_name' => Auth::user()->first_name ,
							 'last_name' =>Auth::user()->last_name ,
							 'name' =>Auth::user()->name ,
							 'email' =>Auth::user()->email ,
							 'photo' =>$photo  ,
                        ]),
                    ]);
	}
	//end users functions 
	//api
    public function getSlider()
	{
		
		  $sliders = Slider::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->orderBY('id','desc')->take(5)->get() ;
		  
		  $data = array() ;
		  foreach($sliders  as $slider){
			  $slideData = array(
			  'name_ar' => $slider->name_ar ,
			  'name_en' => $slider->name_en ,
			  'description_ar' => strip_tags($slider->description_ar) ,
			  'description_en' => strip_tags($slider->description_en) ,
			  'photo' => url('/public').$slider->photo , 			  
			  ) ;
			  array_push($data ,$slideData ) ;
			  
		  }
		   return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]); 
      
	}
	public function lastProduct(Request $request)
	{
		$last_products = Product::orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->where('active' , 'yes')->paginate(10) ;
        $data = array() ;	      
		  foreach($last_products as $key=>$value){
			  $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			  //rating
			  $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}	  
     		  return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]); 
	}
	public function mostView(Request $request)
	{
		 $most_views_products = Product::inRandomOrder()->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->orderBy('views', 'desc')->where('active' , 'yes')->take(10)->get() ;
		  $data = array() ;	      
		  foreach($most_views_products as $key=>$value){
			    $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			   $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}	  
     		  return response()->json([
                'status' => 1,
				'urlforimage' => url('/public') ,
                'data' =>  $data , 				
            ]);         
	}
     //اخر  التخفيضات
	public function minPrice(Request $request)
	{
		 $minimum_products = Product::inRandomOrder()->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->orderBy('min_price', 'ASC')->where( 'min_price' , '>' , 0 )->where('active' , 'yes')->take(10)->get() ;
       
		  $data = array() ;	      
		  foreach($minimum_products as $key=>$value){
			    $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			   $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}	  
     		  return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]);         
	}
	//sectios products
	public function sectionProducts(Request $request)
	{     //dd($request->section_id) ;
		  $where = array() ;
          if(isset($request->section_id)){
			// $products->where('section_id' , intval($request->section_id) ) ;  //dd($request->section_id) ;
			 array_push($where , ['section_id'  , $request->section_id]  ) ;
		  }
		  
		  if(isset($request->sub_section_id) && $request->sub_section_id > 0 ){ //dd(2) ;
			  //$products->where('sub_section_id' , intval($request->sub_section_id) ) ; 
            //  array_push($where , array('sub_section_id'=> intval($request->sub_section_id))) ;	
             array_push($where , ['sub_section_id' , $request->sub_section_id]  ) ;			  
		  }
		  
		  if(isset($request->sub_sub_section_id) && $request->sub_sub_section_id > 0){
			//array_push($where , ['sub_sub_section_id'=>intval($request->sub_sub_section_id)]) ;
			array_push($where , ['sub_sub_section_id'  , $request->sub_sub_section_id]  ) ;
			// $products->where('sub_sub_section_id' , intval($request->sub_sub_section_id) ) ;  
		  } //dd($where) ;
		  $products = Product::where($where)->where('active' , 'yes')->take(40)->get();
		 // $products = $products->paginate(10) ; //dd($products) ;
		  $data = array() ;	      
		  foreach($products as $key=>$value){
			    $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			   $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}	  
     		return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]);         
	}
 
    public function product(  $id )
    {
      
        $product = Product::find($id) ;
		if(empty($product)){
			return response()->json([
                'status' => 2,
                'data' => ""
				]) ;
		}
		$productdatas = array(
		'id' => $product->id ,
		'name_ar' => $product->name_ar ,
		'name_en' => $product->name_en ,
		'description_ar' => strip_tags(trim($product->description_ar)) ,
		'description_en' => strip_tags(trim($product->description_en)) ,
		'keywords_ar' => $product->keywords_ar ,
		'section_id' => $product->section_id ,
		'image' => $product->image ,
		'images' => $product->images ,
		'price' => $product->price ,
		'min_price' => $product->min_price ,
		'views' => $product->views ,
		'quantity' => $product->quantity ,
		'min_quantity' => $product->min_quantity ,
		'max_quantity' => $product->max_quantity ,
		
		) ;
		
        $review_data = null ;
        if(Auth::user()){
            $review_data = Review::where('user_id' ,  Auth::user()->id)->where('reviewable_id' , $id)->first() ;
        }       
        //increment views by one
        $product->views = $product->views + 1 ;
        $product->save() ;
        // get similar products
        $where = array() ;
       if($product->sub_sub_section_id > 0 ){
            array_push($where , ['sub_sub_section_id' , '=' , $product->sub_sub_section_id]) ;
        }elseif($product->sub_section_id > 0){
            array_push($where , ['sub_section_id' , '=' , $product->sub_section_id]) ;
        }else{
            array_push($where , ['section_id' , '=' , $product->section_id]) ;
        }

        $similar_products = Product::where($where)->where('active' , 'yes')->where('id' , '!=' , $product->id)->orderBY('id','desc')->take(10)->get() ;

        if(count($similar_products) < 2  ){
            $similar_products = Product::where('section_id' , '=' , $product->section_id)->where('active' , 'yes')->where('id' , '!=' , $product->id)->orderBY('id','desc')->take(10)->get() ;
        }
		   $data = array() ;	      
		  foreach($similar_products as $key=>$value){
			  $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			  //rating
			  $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}	
       // dd(Products_view::product()) ;
        //get last view product
        $views_where = array() ;
        if(Auth::user()){
            array_push($views_where , ['user_id' , '=' ,  Auth::user()->id ] ) ;
        }else{
            array_push($views_where , ['ip' , '=' ,  $_SERVER['REMOTE_ADDR'] ] ) ;
        }

        $favourite_product_flag = 0 ;
        if(Auth::user()){
           // $check = Products_view::where('product_id' , $id)->where('user_id' , Auth::user()->id)->first() ;
            Products_view::hit( $id , Auth::user()->id) ;
        }else{
            Products_view::hit($id , 0) ;
        }
		//$product['describtion_arr'] =  ;
		//$product['describtion_enn'] = strip_tags($product->description_ar) ;
		 return response()->json([
                'status' => 1,
                'data' =>  ['urlimage'=>url('/public') , 'product' => $productdatas  , 'review_data' => $review_data  ,  'similar_products' => $data  ], 				
                 ]);
      
    }
	//end home page 
	public function addToFavourite(Request $request , Favoriteable $favorate)
	{
		$validator = Validator::make($request->all(), [
            'product_id' => 'required|integer'  ,
        ]); 
        if($validator->fails()){ 
            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 3,
                'message' => $errors_list
            ]); 
        }else {
	 	if ( isset($request->product_id)) {
             $favouriteProduct = Favoriteable::where('favoriteable_id' , Auth::user()->id )->where('product_id' , '=' , intval($request->product_id))->first();

        if( !empty($favouriteProduct) || $favouriteProduct != null   ) {
                $favouriteProduct->delete() ;
				 return response()->json([
                'status' => 1,
                'message' =>  __('site.delete_from_favourite_products'), 				
                 ]);

       }else{

            $favorate->product_id = $request->product_id;
            $favorate->favoriteable_id = Auth::user()->id ; 
            $favorate->favoriteable_type = 'App\User';
            if($favorate->save()){
				 return response()->json([
                'status' => 1,
                'message' =>  __('site.product_add_to_your_favourite'), 				
                 ]) ;              
            }else{
				 return response()->json([
                'status' => 3,
                'message' =>  __('site.unknow_error_happen'), 				
                 ]) ;
            }
          }
      }else{
		   return response()->json([
                'status' => 3,
                'message' =>  __('site.unknow_error_happen'), 				
                 ]) ;
        }
		}
	}
	public function favouriteProducts()
    {     
	
        $products = Favoriteable::where('favoriteable_id', Auth::user()->id)->paginate(20); 
		
		$data  = array() ;
		foreach($products as $key=>$value ){
		     if(empty($value)){
				 continue ;
			 }
			  $name = "" ; 
			  if(!empty($value->product->user->name)){
				  $name = $value->product->user->name ;
			  }
			  //rating
			  $rating  = 0 ;
			  if(count($value->product->reviews) > 0 ){
				 $rating =  $value->product->reviews->sum('rating')/count($value->product->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->product->id ,
			  'name_ar' => $value->product->name_ar ,
			  'name_en' => $value->product->name_en ,
			  'price' => $value->product->price ,
			  'min_price' => $value->product->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->product->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
		   }  
        return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]); 	   
           
    }

    //delete an item from favourite   // favourite_product_ajax
    public function removeFavouriteProduct(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'product_id' => 'required|integer'  ,
        ]); 
        if($validator->fails()){ 
            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 3,
                'message' => $errors_list
            ]); 
        }else {
        if (!empty($request->product_id)) {
                $product = Favoriteable::where('product_id', intval($request->product_id))->first();
                if (!empty($product)) {
                    $product->delete();
					return response()->json([
						'status' => 1,
						'message' =>  __('site.favourite_product_delete'), 				
						 ]) ;
                }
             else {
                return response()->json([
                'status' => 3,
                'message' => 'المنتج غير موجود فى المفضله', 				
                 ]) ;
            }

        } else {
            return response()->json([
                'status' => 3,
                'message' =>  __('site.unknow_error_happen'), 				
                 ]) ;
        }
		}
    }



	public function editProfile(Request $request)
    {
      

        try {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required|min:3',
                'sitepercetage' => 'integer',
            ]);
            $user = User::find(Auth::user()->id);
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            if (!empty($request->full_name)) {
                $this->validate($request, [
                    'full_name' => 'required|min:3|max:30',
                ]);
                $user->name = $request->full_name;
            }
            if (!empty($request->first_name) && !empty($request->last_name)) {

                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->sitepercetage = 0 ;
                $user->describtion = $request->describtion;
                // $user->name = $request->first_name . ' ' . $request->last_name;
            }
            $user->phone = $request->phone;
            if (!empty($request->file('photo'))) {
                $photo = Storage::putFile('public', $request->file('photo'));
                $user->photo = Storage::url($photo);
            }
            return response()->json([
                'status' => 1,
                'message' =>  "" , 				
                 ]) ;
        } catch (Exception $e) {
            return response()->json([
                'status' => 3,
                'message' =>  __('site.unknow_error_happen'), 				
                 ]) ;
        }
    }
	
	//public
	public function getShipingPriceForCart()
	{
		
	}

	//cart  functions 
	  /**
     * ajax user and dealer functions
     */
	public function getAllCountrie()
	{
		$countrie = Countrie::all() ;	
		$data = array() ;
		foreach($countrie as $value){
			$countryData = array(
			'id' => $value->id ,
			'name_ar' => $value->name_ar ,
			'name_en' => $value->name_en 
			) ;
			array_push($data , $countryData) ;
		}
		 return response()->json([
                'status' => 1,
                'data' =>  $data, 				
            ]); 
	}
    public function citiesList($id)
    {
        $cities = Citie::where("countrie_id",$id)->get();
		$data = array() ;
		foreach($cities as $value){
			$citiesData = array(
			'id' => $value->id ,
			'name_ar' => $value->name_ar ,
			'name_en' => $value->name_en 
			) ;
			array_push($data , $citiesData) ;
		}
		 return response()->json([
                'status' => 1,
                'data' =>  $data, 				
            ]);
    }
    public function regionsList($id)
    {
        $regions = Region::where("citie_id",$id)->get();
		$data = array() ;
		foreach($regions as $value){
			$regionsData = array(
			'id' => $value->id ,
			'name_ar' => $value->name_ar ,
			'name_en' => $value->name_en 
			) ;
			array_push($data , $regionsData) ;
		}
		return response()->json([
                'status' => 1,
                'data' =>  $data, 				
            ]);
    }	
    public function addAddresses(Request $request, Users_addresse $users_addresse)
    {

        $validator = Validator::make($request->toArray(), [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'required|integer',
        ]);
        if (!$validator->fails()) {
            try {

                $region_id = (isset($request->region_id)) ? $request->region_id : 0;
                $users_addresse->user_id = Auth::user()->id;
                $users_addresse->addresse_ar = $request->name_ar;
                $users_addresse->addresse_en = $request->name_en;
                $users_addresse->countrie_id = $request->countrie_id;
                $users_addresse->citie_id = $request->citie_id;
                $users_addresse->region_id = $request->region;
                $users_addresse->active = 'no';
                $users_addresse->save();

                return response()->json([
                    'status' => 1,
					'data' =>  ['id' => $users_addresse->id ], 				
				   ]);
            } catch (Exception $e) {
				return response()->json([
                    'status' => 3,
					'message' =>  __('site.unknow_error_happen'), 				
				   ]);
              //  return ;
            }
        } else {
			return response()->json([
                    'status' => 3,
					'message' =>  $validator->errors()->all(), 				
				   ]);
        }
    }

    //delete user addresse
    public function deleteUserAddresse($id)
    {
        if (!empty($id) && $id > 0 ) {

            $user_addreese = Users_addresse::find(intval($id));
			if(!empty($user_addreese)){
            $user_addreese->delete();;
              return response()->json([
                'status' => 1,
                'data' =>  "", 				
            ]); 
			}else{
				  return response()->json([
                'status' => 3,
                'data' =>  "لا يوجد عنوان مسجل ", 				
            ]); 
			}


        } else {

              return response()->json([
                'status' => 3,
                'data' =>  "حدث خطاء ماء ", 				
            ]); 
        }
    }

    //active an addresse for user and make another addresse false
    public function activeAnAddresse($id)
    {

        if (!empty($id) && $id > 0 ) {

            $user_addreeses = Users_addresse::where('user_id', Auth::user()->id)->get();

            foreach ($user_addreeses as $user_addreese) {

                if ($user_addreese->id == $id ) {
                    $value = 'yes';
                } else {
                    $value = 'no';
                }

                DB::table('users_addresses')
                    ->where('id', $user_addreese->id)
                    ->update(array('active' => $value));

            }

             return response()->json([
                'status' => 1,
                'data' =>  "", 				
            ]); 

        } else {

            return response()->json([
                'status' => 3,
                'data' =>  "حدث خطا ماء ", 				
            ]);
        }

    }  
	public function userAddresse(Request $request)
    {
		
        $userAddreeses = Users_addresse::where('user_id', Auth::user()->id)->get();
		$data  = array() ;
		foreach($userAddreeses as $key=>$value){
			if(isset($value->active)){
				$active = 'no';
			}else{
				$active = 'yes';
			}	
			if(empty($value->region->name_ar)){
				$region = '';
			}else{
				$region = $value->region->name_ar;
			}
			$addreese = array(
			'id' => $value->id ,
			'countrie_id' => $value->countrie_id ,
			'countrie_name' => $value->countrie->name_ar ,
			'citie_id' => $value->citie_id ,
			'citie_name' => $value->citie->name_ar ,
			'region_id' => $value->region_id ,
			'region_name' => $region ,
			'addresse_ar' => $value->addresse_ar ,
			'addresse_en' => $value->addresse_en ,
			'active' => $value->active ,
			);
			array_push($data , $addreese ) ;
		}
        return response()->json([
                'status' => 1,
                'data' => $data , 				
                 ]) ;

    }	
	public function userActiveAddresse(Request $request)
    {
		
        $userAddreeses = Users_addresse::where('user_id', Auth::user()->id)->where('active' , 'yes')->take(1)->get();
		$data  = array() ;
		foreach($userAddreeses as $key=>$value){
			if(isset($value->active)){
				$active = 'no';
			}else{
				$active = 'yes';
			}	
			if(empty($value->region->name_ar)){
				$region = '';
			}else{
				$region = $value->region->name_ar;
			}
			$addreese = array(
			'id' => $value->id ,
			'countrie_id' => $value->countrie_id ,
			'countrie_name' => $value->countrie->name_ar ,
			'citie_id' => $value->citie_id ,
			'citie_name' => $value->citie->name_ar ,
			'region_id' => $value->region_id ,
			'region_name' => $region ,
			'addresse_ar' => $value->addresse_ar ,
			'addresse_en' => $value->addresse_en ,
			'active' =>$active ,
			);
			array_push($data , $addreese ) ;
		}
        return response()->json([
                'status' => 1,
                'data' => $data , 				
                 ]) ;

    }

    //update an addresse
    public function updateAddresse(Request $request)
    {
		 $validator = Validator::make($request->toArray(), [
		    'addresse_id' => 'required|integer', 
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ]);
        if (!$validator->fails()) {
            $region_id = (isset($request->region_id)) ? $request->region_id : 0;
            $addresse = Users_addresse::find(intval($request->addresse_id));
            $addresse->user_id = Auth::user()->id;
            $addresse->addresse_ar = $request->name_ar;
            $addresse->addresse_en = $request->name_en;
            $addresse->countrie_id = $request->countrie_id;
            $addresse->citie_id = $request->citie_id;
            $addresse->region_id = $region_id;
            if ($addresse->save()) {
                 return response()->json([
                'status' => 1,
                'data' =>  "", 				
            ]); 
            } else {
				 return response()->json([
                'status' => 1,
                'message' =>  __('site.unknow_error_happen'), 				
            ]); 
            } 
		}

    }


	public function getShipingPrice(Request $request)
	{
	    $shiping_price = 0;
		$data = array() ;
        $user_addresse = Users_addresse::where('user_id', Auth::user()->id)->first();
        if (!empty($user_addresse)) {
            foreach ($request->products as $key=>$row) {
                $product_data = Product::where('id', $row[$key+1]['product_id'])->first();
                $shiping_data = Shiping::where('user_id', $product_data->product_owner_id)->where('citie_id', $user_addresse->citie_id)->first();
                if (!empty($shiping_data)) {
                    $shiping_price += $shiping_data->shiping_coast * intval($row[$key+1]['qty']) ;
					$product = array(
					'id' => $row[$key+1]['product_id'] ,
					'qty' => $row[$key+1]['qty'] ,
					'shiping_price' => $shiping_data->shiping_coast  ,
				    ) ;
					array_push($data ,$product ) ;
                   
                }
            }
			 return response()->json([
					'status' => 1,
					'data' => ['shiping_price' => $shiping_price , 'products' =>  $data ] , 				
			]);
        }else{
			 return response()->json([
					'status' => 3,
					'data' => 'لابد من وجود عنوان للتوصيل او وجود عنوان مفعل ', 				
			]);
		}	
	}
	public function saveCartItems(Request $request, Order_product $order_details)
    { 
        $request->pay_type = 'oncash' ;
        try{
          if ( isset($request->pay_type)) { 
            $email = (isset($this->settings['site_email'])) ?   $this->settings['site_email'] : 'no-replay@tsheed.com';
            $user = Auth::user()->toArray(); 
            // get delivery addresse
            $addesse_data = Users_addresse::where('user_id', Auth::user()->id)->where('active', 'yes')->first();
            if(empty($addesse_data)){
					 return response()->json([
					'status' => 1,
					'message' => 'حدث خطا الرجاء تحديد العنوان' , 				
				]); 
            }  
            //get dealers data
            $product_owner_ids = array();
			$total = 0 ;
            foreach ($request->products  as $key=>$row) { 
				$product = Product::find($row[$key+1]['product_id']) ;
				$total = ($product->min_price > 0 &&  $product->min_price < $product->price ) ? $product->min_price :$product->price ;
                array_push($product_owner_ids, [$product->product_owner_id]);
            }
            
            $vendor = User::distinct('id')->whereIn('id', $product_owner_ids)->get(); 
            //save parent order 
            if ($request->pay_type == 'transfer_bank') {
                //if payment online validate data first
                $this->validate($request, [
                    'acount_owner_name' => 'required|string',
                    'bank_user_number' => 'required',
                    'dealer_bank_number' => 'required',
                    'total_transfer_maney' => 'required',
                    'image' => 'required|bail|image|mimes:jpg,jpeg,png,gif',
                    'bank_name' => 'required',
                    'pay_notes' => 'required',
                ]);
            } 
			//
            $mainordershipingprice = $request->shiping_price ;    			
            //save main order data
            $parent_order = new Order(); 
            $parent_order->user_id = Auth::user()->id;
            $parent_order->product_owner = 1;
            $parent_order->parent_id = 0;
            $parent_order->total = $total + $mainordershipingprice + intval(( $total * 5 ) / 100 );
            $parent_order->tax = intval(( $total * 5 ) / 100 );
            $parent_order->tax_percentage = '5';
            $parent_order->discount = 0;
            $parent_order->order_note = $request->checkout_notes;;
            $parent_order->payment_type = $request->pay_type;
            $parent_order->order_status = 'in_progress';
            $parent_order->shiping_price = $mainordershipingprice;
            $parent_order->addresse_id = $addesse_data->id;

            $parent_order->save();
            //start saving bank transfer type details
           
            //end save payment type transfer 
            //end saving parenet order 
            //save product order for every different deller
            foreach ($vendor as $key => $user_data) { 
                $order = new Order();
                	$total = 0 ;
            foreach ($request->products  as $key=>$row) { 
				$product = Product::find($row[$key+1]['product_id']) ;
				if($user_data->id == $product->product_owner_id ){
					$total = ($product->min_price > 0 &&  $product->min_price < $product->price ) ? $product->min_price :$product->price ;
				}
				
            }
                $shiping_price = 0;
                $tax_total = 0;
                // $checkout_notes = $request->checkout_notes;
                $order->user_id = Auth::user()->id;
                $order->total = $total + $mainordershipingprice + intval(( $total * 5 ) / 100 );
                $order->parent_id = $parent_order->id;
                $order->tax =  intval(( $total * 5 ) / 100 );
                $order->tax_percentage = 5;
                $order->discount = 0;
                $order->product_owner = $user_data->id;
                $order->order_status = 'in_progress';
                $order->order_note = $request->checkout_notes;
                $order->addresse_id = $addesse_data->id;
                $order->payment_type = $request->pay_type;
                $order->shiping_price = 0; 
                //$order->save() ;
                $vendor_email = $user_data->email; 
                if ($order->save()) { 
                    $data = array(); 
                    foreach (Cart::content() as $row) { 
                        if ($row->options->product_owner == $user_data->id) {
                            //calc total for this product
                            $tax_total += $row->tax * $row->qty;
                            $shiping_price += $row->qty * $row->options->shiping_price;
                            $total += $row->total + $shiping_price;
                            $item = array(
                                'order_id' => $order->id,
                                'product_id' => $row->model->id,
                                'qty' => $row->qty,
                                'price' => $row->price * $row->qty,
                                'user_id' => Auth::user()->id,
                                'shiping' => 0,
                                'dicount' => 0,
                            ); 
                            array_push($data, $item); 
                            $product = Product::find($row->model->id);                        
                            //calculate shiping
                            /* $shiping_data = Shiping::where('user_id', $product->product_owner_id)->where('citie_id', $addesse_data->citie_id)->first();
                             if (!empty($shiping_data)) {
                                 $shiping_price += $shiping_data->shiping_coast * $row->qty;
                             } */
                            //end calcalcation shiping 
                            //decrease product qty by 1
                            $product->quantity = $product->quantity - $row->qty ;
                            $product->save();
							 $datas = array('text'  =>__('site.no_products_items_become_zero' ) ) ;
                                              //send email if product qty == 0
                            if ($product->quantity == 0) {
                                @Mail::send('emails.order',   $user, function ($m) use ($vendor_email  ,$datas  , $user) {
                                    $m->from('no-replay@tsheed.com', 'موقع تشيد');
                                    $m->to($vendor_email, 'مرحبا رساله مهمه من تشيد')->subject(__('site.no_products_items_become_zero'));
                                });
                            } 
                        }
                    }
                    //send email to deller
                    $id = $order_details->insert($data);
                    $datas = array('text'  =>__('site.please_check_dashborad_for_Accepted'  )) ;					
                    @Mail::send('emails.order', $user, function ($m) use ($vendor_email , $datas , $user) {
                        $m->from('no-replay@tsheed.com', 'مرحبا');
                        $m->to($vendor_email, 'مرحبا')->subject(__('site.please_check_dashborad_for_Accepted'));
                    });
                   $datas = array('text'  => __('site.please_check_dashborad_for_Accepted' ) ) ;
                    @Mail::send('emails.order',$user, function ($m) use ($email , $datas  , $user) {
                        $m->from('no-replay@tsheed.com', $user['name']);
                        $m->to($user['email'], $user['name'])->subject(__('site.please_check_dashborad_for_Accepted'));
                    });

                    $order->total = $total;
                    $order->tax = $tax_total;
                    $order->shiping_price = $shiping_price;
                    $order->save();
                    //end dealer sending email

                    //when finishing order without no error

                }
            }

            Cart::destroy();
             return response()->json([
					'status' => 1,
					'message' => "تم خفظ الطلب وتم ارسال رساله للبائع" , 				
			]);

        } else {
            return redirect('checkout');
        }
        }catch (Exception $e) {
			 return response()->json([
					'status' => 1,
					'message' => "حدث خطا غير متوقع" , 				
			]);
         
        }

        /*return redirect('my-orders');*/
    }

	//end 	
	 	
	public function search(Request $request)
    {

        try{
		 $validator = Validator::make($request->all(), [
            'search' => 'string|required|min:2',
        ]);
		if($validator->fails()){ 
            $errors_list = array();
            foreach ($validator->errors()->toArray() as $message) {
                array_push($errors_list, $message);
            }
            return response()->json([
                'status' => 3,
                'message' => $errors_list
            ]); 
        }
        else {	
        if(Lang::locale() == 'ar'){
            $title = 'name_ar' ;
        }elseif(Lang::locale() == 'en'){
            $title = 'name_en' ; 
        }else{
            $title = 'name_ar' ;
        }
        $where = array() ;
       // $search_name = "" ;
        $products  =  "" ;
        $search_name = strip_tags($request->search) ;
        $products = Product::where('quantity' , '>' , 0)->where('deleted_at' , null )->where('name_ar' , 'like' , '%'.$search_name.'%')->take(20)->get() ;      
        $data = array() ;	      
		  foreach($products as $key=>$value){
			    $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			   $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}

		  return response()->json([
                'status' => 1,
                'data' =>  $data , 				
            ]); 
		}
        }catch (Exception $e) {
            return response()->json([
                'status' => 3,
                'data' =>  "", 				
            ]); 
        }

    }
  
  	 public function getMenu()
	 {
		  $userlevels = Userlevel::all() ; 
		  $sections = Section::where('deleted_at' , null )->where('active' , 'yes')->where('parent_id' , 0 )->where('sub_section' , 0)->get() ;
		  if(!empty($sections ))  
		  {       
		$data = array() ; 
		array_push($data , ['home_page' => URL::to('')]) ;  //homepage
		//sections 
		$sectiondata = array() ;
		foreach($sections as $section )
		{
			$subdata = array() ;
			if($section->has_sub){
				
				foreach($section->has_sub as $subsection )
				{
				$subsingliedata = array(
				 'id' => $subsection->id ,
				 'link' => URL::to('').'/section/'.str_slug($section ->name_en , '_').'/'.str_slug($subsection ->name_en , '_').'/'.$subsection->id ,
				 'title_arabic' => $subsection->name_ar ,
				 'title_english' => $subsection->name_en ,
				) ;
				array_push($subdata ,  $subsingliedata ) ;	
				}
				
			}
		
			$sectiondataa = array(
			 'id' => $section->id ,
			 'link' =>URL::to('').'/mainsection/'.str_slug($section ->name_en , '_').'/'.$section->id ,
			 'title_arabic' => $section->name_ar ,
			 'title_english' => $section->name_en ,
			 'subsection' => $subdata
			) ;
			array_push($sectiondata ,  $sectiondataa ) ;
		}
		array_push($data ,  $sectiondata ) ;
		$level = array() ;
		foreach($userlevels as $userlevel){
			$userleveldata = array(
			'id' => $userlevel->id ,
			'title_ar' => $userlevel->name_ar ,
			'title_en' => $userlevel->name_en ,
			'link' =>URL::to('').'/additionalacount/userlevel/'.$userlevel->id
			) ;
			array_push($level,  $userleveldata ) ;
		}
		array_push($data ,  $level ) ;
		$topbar_pages = Page::where('deleted_at' , null )->where('menu' , 'yes')->where('active' , 'yes')->get() ;
		$pages = array() ;
		foreach($topbar_pages as $page){
			$pagedata = array(
			'id' =>     $page->id ,
			'name_ar' => $page->name_ar ,
			'name_en' => $page->name_en ,
			'link' =>  URL::to('').'/page/'.str_slug($page ->name_en , '_').'/'.$page->id ,
			) ;
			array_push($pages , $pagedata) ;
		}
			$menudata = array(
			'home_page' =>URL::to('') ,
			'sectiondata' => $sectiondata ,
			'levels' => $level ,
			'pages' => $pages
			) ;
			array_push($data ,  $pages  ) ;
		//
		 return response()->json([
							'status' => 1,
							'data' => $menudata 
						]);
		  }else{
			   return response()->json([
							'status' =>0,
						 'data' => ''
						]);
		  }
		}
		
	public function userLevel()
	{
		
		$userlevels = Userlevel::paginate(20) ;
		$level = array() ;
		foreach($userlevels as $userlevel){
			if(empty($userlevel->image)){
				$image = null ;
			}else{
				$image =  url('/public').$userlevel->image ;
			}
				$userleveldata = array(
				'id' => $userlevel->id,
				'title_ar' => $userlevel->name_ar ,
				'title_en' => $userlevel->name_en ,
				'link' =>URL::to('').'/additionalacount/userlevel/'.$userlevel->id ,
				'photo' =>$image 
				) ;
				array_push($level,  $userleveldata ) ;
		}
		return response()->json([
							'status' =>1,
						    'data' => $level 
						]);
						
	}	

    //get user level data 
	public function getUserLevelData($id)
	{
		
		  $userlevel = Userlevel::find($id) ; 
		  if(empty($userlevel)){
			   return response()->json([
							'status' =>404,
						    'message' => "no data"
						]);
		  }
	      if(empty($userlevel->image)){
				$image = null ;
			}else{
				$image =  url('/public').$userlevel->image ;
			}	
			
		  	$userleveldata = array(
				'title_ar' => $userlevel->name_ar ,
				'title_en' => $userlevel->name_en ,
				'link' =>URL::to('').'/additionalacount/userlevel/'.$userlevel->id ,
				'photo' =>$image 
				);
				
		  $users = User::where('level' , $userlevel->slug)->paginate(20) ; 
		  
		  $data = array() ;
		  foreach($users as $user){
			  
			if(empty($user->image)){
				$imageuser = null ;
			}else{
				$imageuser =  url('/public').$user->image ;
			}
			
		    $userData = array(
			  'name' => $user->name ,
			  'first_name' => $user->first_name ,
			  'last_name' => $user->last_name ,
			  'email' => $user->email ,
			  'image' => $imageuser ,
			  ) ;
		    array_push( $data ,  $userData ) ;
			
		  }
		  
		  return response()->json([
							'status' =>1,
						    'data' => ['userlevel' => $userlevel  , 'users' => $data] 
						]);
		  
	}
	    //dealer profile page
    public function dealerProfile($id )
    {  
	
 	  $products = Product::where('product_owner_id' , intval($id) )->orderBy('price', 'ASC')->where('active' , 'yes')->where('quantity' , '>' , 0 )->paginate(9) ;
       
        $user = User::find(intval($id)) ;
		  if(empty($user)){
			   return response()->json([
							'status' =>404,
						    'message' => "no data" 
						]);
		  }	  
	
		  
		if(empty($user->image)){
				$imageuser = null ;
			}else{
				$imageuser =  url('/public').$user->image ;
			}
			
		$data = array() ;	      
		foreach($products as $key=>$value){
			    $name = "" ;
			  if(!empty($value->user->name)){
				  $name = $value->user->name ;
			  }
			   $rating  = 0 ;
			  if(count($value->reviews) > 0 ){
				 $rating =  $value->reviews->sum('rating')/count($value->reviews) ;
			  }
			  
			  $productData = array(
			  'id' => $value->id ,
			  'name_ar' => $value->name_ar ,
			  'name_en' => $value->name_en ,
			  'price' => $value->price ,
			  'min_price' => $value->min_price ,
			  'productowner' => $name ,
			  'product_owner_id' => $value->product_owner_id ,
			  'photo' => url('/public').$value->image ,
			  'rating' => $rating  ,
			  ) ;
				array_push( $data , $productData ) ;
			}
			
		    $userData = array(
			  'name' => $user->name ,
			  'first_name' => $user->first_name ,
			  'last_name' => $user->last_name ,
			  'email' => $user->email ,
			  'image' => $imageuser ,
			  ) ;
			  
		  return response()->json([
							'status' =>1,
						    'data' => ['products' => $data , 'user' => $user ] 
						]);		
						
						
    }
	//chat
	  //chats
    public function conservation()
    {
        $messages = Auth::user()->conversation_from()->orderBy('id', 'desc')->paginate(15);
        if (count($messages) == 0) {

            $messages = Auth::user()->conversation_to()->orderBy('id', 'desc')->paginate(15);
        }
		return response()->json([
							'status' =>1,
						    'data' => $messages
						]);
    }

    public function getMessages(Request $request)
    {

        $type = $request->type;
        $messages = "";

        if ($type == 'inbox') {

            $messages = Auth::user()->message_to()->orderBy('id', 'desc')->paginate(15);

        } elseif ($type == 'conversations') {

            $messages = Auth::user()->conversation_from()->orderBy('id', 'desc')->paginate(15);

        } elseif ($type == 'outbox') {

            $messages = Auth::user()->message_from()->orderBy('id', 'desc')->paginate(15);
        }

        Auth::user()->unreadNotifications->markAsRead();
		return response()->json([
							'status' =>1,
						    'data' => ['type' => $type, 'messages' => $messages]
						]);
    }

    public function conversations(Request $request, $id)
    {

        $messages = Conversation::find($id);
        $conversations = Auth::user()->conversation_from()->get();
        $conversations_with = Auth::user()->conversation_to()->get();
		return response()->json([
							'status' =>1,
						    'data' => ['conversations' => $conversations, 'messages' => $messages, 'conversations_with' => $conversations_with]
						]);
    }

    public function getConversation( $id)
    {
       $messages = Conversation::find($id);
        $conversations = Auth::user()->conversation_from()->get();
        $conversations_with = Auth::user()->conversation_to()->get();
        $messages_contacts = Auth::user()->conversation_list()->orderBy('id', 'desc')->paginate(15);
	return response()->json([
							'status' =>1,
						    'data' =>['messages' => $messages, 'conversations' => $conversations, 'conversations_with' => $conversations_with, 'messages_contacts' => $messages_contacts]
						]);
   }


    public function checkConversation(Conversation $conversation, Request $request, $id)
    {
        $useri = Auth::user()->id;
        //$conversations = Conversation::where('by',$id)->orWhere('with',$id)->first();
        $conversations = Conversation::where(function ($query) use ($id, $useri) {
            $query->where('by', '=', $id)->Where('with', '=', $useri);
        })->orwhere(function ($query) use ($id, $useri) {
            $query->where('with', '=', $id)->Where('by', '=', $useri);
        })->first();

        if (count($conversations) == 0) {

            $conversation->by = Auth::user()->id;
            $conversation->with = $id;
            $saved = $conversation->save();

            $us = User::find($id)->toArray();
            //Mail::send('emails.global', $us, function($message) use ($us) { $message->to($us['email']); $message->subject('يريد '.Auth::user()->name.' التحدث معك'); });

            return redirect('account/conversation/' . $conversation->id);
        } else {
            return redirect('account/conversation/' . $conversations->id);
        }
    }

    public function sendChatMessages(Message $message, Request $request)
    {
        $counter = Message::where('message_from', Auth::user()->id)->count();
        $message->conversation_id = $request->conversation_id;
        $message->message_from = Auth::user()->id;
        $message->message_to = $request->conversation_with;
        $message->details = $request->message;
        $message->save();

        $noty = User::find($request->conversation_with);
        //$noty->notify(new MessagesNotes($message));
		   //send dealer  email with new message
            $user = User::find($request->conversation_with);
            $user_email = $user->email;
            $user_name = $user->name;
            $message = $request->message;
            $user_data = Auth::user()->toArray();
            //send email
            Mail::send('emails.product', $user_data, function ($m) use ($user_email, $user_name, $message, $user_data) {
                $m->from($user_data['email'], $user_data['name']);
                $m->to($user_email, $user_name)->subject($message . 'تم ارسال رساله جديده');
            });

       return response()->json([
							'status' =>1,
						    'data' =>""
							]);
    }

    public function getChatMessages( Request $request)
    {
        $messages = Conversation::find($request->conversation_id);
		 return response()->json([
							'status' =>1,
						    'data' =>$messages
							]);
        return [
            'messages' => view('cp.conversations_ajax', [
                'messages' => $messages,
            ])->render(),
            'last_message' => $messages->message->last()->details,
            'total' => count($messages->message)
        ];
    }
	
	public function addresses_settings()
    {
       

    }
		public function company()
	{
		
		$userlevels = Userlevel::paginate(20) ;
		$campanies = \App\Companie::paginate(20) ; 
		$level = array() ;
		foreach($campanies as $campanie){
			 $levelcompany = null ;
		        $user = User::find($campanie->user_id) ;
					$level_name_ar = null;
				$level_name_en = null;
				if(!empty($user)){
					$levelcompany = $user->level ;
					$levelData = Userlevel::where('slug' , $user->level)->first()  ;
						if(!empty($levelData)){
					$level_name_ar = $levelData->name_ar;
				$level_name_en = $levelData->name_en;
				}
				}
				
			
			if(empty($campanie->image)){
				$image = null ;
			}else{
				$image =  url('/public').$campanie->image ;
			}
				$campaniedata = array(
				'id' => $campanie->id,
				'title_ar' => $campanie->name_ar ,
				'title_en' => $campanie->name_en ,
				'level' => $levelcompany,
				'level_name_ar' => $level_name_ar,
				'level_name_en' => $level_name_en,
					//'link' =>URL::to('').'/additionalacount/userlevel/'.$campanie->id ,
				'photo' =>'https://tsheed.com/public/default/images/logo.png' 
				//'photo' =>$image 
				) ;
				array_push($level,  $campaniedata ) ;
		}
		return response()->json([
							'status' =>1,
						    'data' => $level 
						]);
						
	}
	public function companyPage($id)
	{
		$campanies = \App\Companie::find($id) ; 
		  if(empty($campanies)){
			   return response()->json([
							'status' =>404,
						    'message' => "no data" 
						]);
		  }
		        $level = null ;
		        $user = User::find($campanies->user_id) ;
				if(!empty($user)){
					$level = $user->level ;
				}
				$levelData = Userlevel::where('slug' , $user->level)->first()  ;
				$level_name_ar = null;
				$level_name_en = null;
				if(!empty($levelData)){
					$level_name_ar = $levelData->name_ar;
				$level_name_en = $levelData->name_en;
				}
				$campaniedata = array(
				'id' => $campanies->id,
				'title_ar' => $campanies->name_ar ,
				'title_en' => $campanies->name_en ,
				'phone' => $campanies->phone ,
				'email' => $campanies->email ,
				'level' => $level ,
				'level_name_ar' => $level_name_ar,
				'level_name_en' => $level_name_en,
				'commercial_register' => $campanies->commercial_register ,
				'company_website' => $campanies->company_website , 				
				//'link' =>URL::to('').'/additionalacount/userlevel/'.$campanie->id ,
				'photo' =>'https://tsheed.com/public/default/images/logo.png' 
				) ;
				
		
		
		 
		 return response()->json([
							'status' =>1,
						    'data' =>$campaniedata
							]);
	}
	
	public function companyData()
	{
		
	}

   public function myOrders()
   {
	     $orders = Order::orderBY('id','desc')->where('user_id' , Auth::user()->id)->where('parent_id' , 0)->where('deleted_at' , null )->paginate(6) ;
          $data = array() ;
		  foreach($orders as $order){
			  $orderData = array(
			  'id' => $order->id ,
			  'created_at' => $order->created_at->diffforhumans() ,
			  'order_status' => __('admin.'.$order->order_status.'') ,
			  'total' => $order->total ,
			  'payment_type' => $order->payment_type ,
			  'shiping_price' => $order->shiping_price ,
			  'order_note' => $order->order_note ,
			  'tax_percentage' => $order->tax_percentage 
			  ) ;
			  array_push($data , $orderData) ;
		  }
		  return response()->json([
							'status' =>1,
						    'data' =>$data
							]);
   }   
   public function logout()
   {
	$accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
          return response()->json([
							'status' =>1,
						    'data' =>""
							]);
   }
   
    public function sendRate(Request $request, Review $rating)
    {
		
		$review_data = Review::where('user_id' ,  Auth::user()->id)->where('reviewable_id' , $request->product_id)->first() ;
        if(!empty($review_data)){
            $review_data->user_id = Auth::user()->id;
            $review_data->reviewable_id = intval($request->product_id);
            $review_data->reviewable_type = 'App\Product';
            $review_data->rating = intval($request->rating);
            $review_data->comment = 'dd';
            $review_data->save() ;
            //return  ;
			 return response()->json([
							'status' =>1,
						    'data' =>__('site.rating_updated_well')
							]);

        } else{
           $rating->user_id = Auth::user()->id;
            $rating->reviewable_id = intval($request->product_id);;
            $rating->reviewable_type = 'App\Product';
            $rating->rating = intval($request->rating);
            $rating->comment = 'dd';
            $rating->save() ;
			 return response()->json([
							'status' =>1,
						    'data' =>__('site.rating_updated_well')
							]);
        }	
	

    }

}
