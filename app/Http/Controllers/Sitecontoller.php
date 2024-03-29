<?php

namespace App\Http\Controllers;
use Carbon;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
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
use App\Color ;
use App\Size ;
use App\Tracker;
use Auth ;
use App\Newsletter ;
use App\Countrie ;
use App\Citie ;
use App\Region ;
use App\Contact_Message ;
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
use Illuminate\Support\Facades\DB;

class Sitecontoller extends Controller
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
    /**
        1=> advertisments_beside_slider
        2=> advertisments_up_newest_product
       3=> advertisments_up_most_view
       4=> advertisments_inside_section
       5=> advertisments_inside_section_beside_page
       6" >  advertisments_inside_product
       7" >  advertisments_in_last_descount
     */
    //function for homepage
    public function index()
    {

        Tracker::hit();
		$userlevels = Userlevel::all() ;
        $sliders = Slider::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->orderBY('id','desc')->get() ;
        $main_sections = Section::where('deleted_at' , null )->where('active' , 'yes')->where('parent_id' , 0)->where('sub_section' , 0)->orderBY('id','desc')->get() ;
        $brands = Brand::where('deleted_at' , null )->orderBY('id','desc')->where('active' , 'yes')->orderBy('created_at', 'desc')->take(10)->get() ; ;
        $features_products = Product::where('active' , 'yes')->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->take(10)->get() ;
        $minimum_products                = Product::inRandomOrder()->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->orderBy('min_price', 'ASC')->where( 'min_price' , '>' , 0 )->where('active' , 'yes')->take(10)->get() ;
        $last__featured_products         = Product::inRandomOrder()->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->orderBy('price', 'ASC')->where('featured' , 'yes')->where('active' , 'yes')->take(10)->get() ;
        $most_views_products             = Product::inRandomOrder()->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->orderBy('views', 'desc')->where('active' , 'yes')->take(10)->get() ;
        $last_products                   = Product::inRandomOrder()->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->orderBy('created_at', 'desc')->where('active' , 'yes')->take(10)->get() ;
        $adverstisment1_beside_slider    =    Advertisment::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->where('location' , 1)->take(2)->get() ;
        $adverstisment2_up_last_products = Advertisment::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->where('location' , 2 )->take(1)->get() ;
        $adverstisment3_up_most_views    =    Advertisment::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->where('location' , 3 )->take(2)->get() ;
        $adverstisment4_up_discounts     =     Advertisment::where('deleted_at' , null )->inRandomOrder()->where('active' , 'yes')->where('location' , 7  )->take(3)->get() ; ;

        return view('index' , ['main_sections' => $main_sections , 'brands' => $brands , 'features_products' => $features_products
            , 'minimum_products' => $minimum_products , 'last_features_products' => $last__featured_products , 'most_views_products' => $most_views_products
            ,'adverstisment1_beside_slider' => $adverstisment1_beside_slider ,'adverstisment2_up_last_products' => $adverstisment2_up_last_products ,'adverstisment3_up_most_views' => $adverstisment3_up_most_views ,'adverstisment4_up_discounts' => $adverstisment4_up_discounts
            , 'sliders' => $sliders , 'last_products' => $last_products  ]) ;

   //end
    }
    /**product page */
    public function product( $slug , $id )
    {
       if(! isset($id)){
            abort('404') ;
        }
        $product = Product::find($id) ;
        $review_data = null ;
        $sizes =Size::all() ;
        $colors  =Color::all() ;
        if(Auth::user()){
            $review_data = Review::where('user_id' ,  Auth::user()->id)->where('reviewable_id' , $id)->first() ;
        }
        //
         /*
           echo  $product->reviews->sum('rating') / count($product->reviews);

       dd() ;*/
        //
        if(empty($product) ){
            abort('404') ;
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
        return view('product' , ['product' => $product  ,'colors'=>$colors , 'sizes'=>$sizes, 'review_data' => $review_data  ,  'similar_products' => $similar_products  ]) ;

    }
    /**
    sections
     */
    public function sections()
    {

        $sections = Section::where('active' , 'yes')->where('parent_id' , 0)->where('sub_section' , 0 )->get() ;
        return view('sections' , compact('sections')) ;

    }
    /**
     * main section page
     */
    public function section($slug , $id)
    {


        $section = Section::find(intval($id)) ;
        if(empty($section)  ){
            abort('404') ;
        }
        $main_sections = Section::where('parent_id' , 0)->where('sub_section' , 0)->get() ;
        $products = Product::where('active' , 'yes')->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where('section_id', intval($id) )->paginate(12) ;
        $adverstisments = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 4  )->take(3)->get() ;
        $adverstisments2 = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 5 )->take(1)->get() ;

        return view('mainsection' , ['adverstisments'=>$adverstisments , 'adverstisments2' => $adverstisments2  , 'main_sections' => $main_sections ,  'section' => $section , 'products' => $products ]) ;

    }

    // get sub section data
    public function section_products_sub($section , $sub_section , $id )
    {
       $section = Section::find($id);
       $products = Product::where('active' , 'yes')->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where('sub_section_id'  , $id )->paginate(12) ;
       $adverstisments2 = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 5 )->take(1)->get() ;

       return view('section_products' , ['section'=>$section , 'adverstisments2' => $adverstisments2  , 'products'=>$products]) ;
    }
    //get sub sub data
    public function section_products_sub_sub($section , $sub_section , $sub_sub_section , $id )
    {

        $section = Section::find($id);
        $products = Product::where('active' , 'yes')->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where('sub_sub_section_id' , $id)->paginate(12) ;
        $adverstisments2 = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 5 )->take(1)->get() ;

        return view('section_products' , ['section'=>$section ,  'adverstisments2' => $adverstisments2  , 'products'=>$products , 'sub_sub' => 1 ]) ;

    }

    //
    public function section_products(Request $request)
    {

        if(isset($request->i)){
            $where = ""  ;
            $section = Section::find($request->i);
            if($section->parent_id > 0 && $section->sub_section > 0 ){
                $where = [ 'sub_sub_section_id' => intval($request->i) ] ;
            }
            elseif($section->parent_id > 0){
                $where = [ 'sub_section_id' => intval($request->i) ] ;
            }else{
                $where = [ 'section_id' => intval($request->i) ] ;
            }
            $products = Product::where('active' , 'yes')->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where($where)->paginate(12) ;
            return view('section_products' , ['section'=>$section , 'products'=>$products]) ;
        }else{
            abort('404') ;
        }

    }

    /***
     * brands
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brand_products($slug , $id )
    {

        $brand = Brand::find($id) ;

        $products = Product::where('brand_id' , $id )->orderBY('id','desc')->orderBy('price', 'ASC')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where('active' , 'yes')->paginate(2);
        $adverstisments2 = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 8 )->take(1)->get() ;

        return view('brands' , ['products'=>$products , 'brand'=>$brand , 'adverstisments2'=>$adverstisments2 ]);

    }
    /*
     * dynamic page
     */
    public function page($title , $id)
    {

        $page = Page::find($id) ;
        if(empty($page) ){
            abort('404') ;
        }
        return view('page' ,compact('page')) ;

    }
    /**
     * contact us
     */
    public function contact()
    {

        $pages = Page::inRandomOrder()->where('page_location' , 'contact_page')->take(5)->get() ;
        return view('contact_us' , ['pages' => $pages ]);

    }
    public function send_contact(Request $request,Contact_Message $message)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
/*
        $message->name = $request->name;
        $message->email = $request->email;
        $message->mobile = $request->mobile;
        $message->title = $request->title;
        $message->text = $request->text;
        $message->save();
		*/
		$user = array(
		'name' => $request->name ,
		'email' => $request->email ,
		'title' => $request->title ,
		'text' => $request->text
		) ;
		//dd($user['name']) ; $user['text']
        $request->session()->flash('alert-success',  __('site.message_success'));
		   Mail::send('emails.contact', $user , function($message) use ($user) {
                $message->from($user['email'], $this->settings['site_title'] );
                $message->to($this->settings['site_email']);
                $message->subject( $this->settings['site_title'] );
            });
        return back();

    }

    public function register_client()
    {

         return view('auth.register-new-client') ;

    }

    public function register_dealer()
    {
        $config['center'] = 'المملكة العربية السعودية , جدة';
        $config['zoom'] = '14';
        $config['map_height'] = '14';
        $config['scrollwheel'] = false;

        GMaps::initialize($config);

        $map = GMaps::create_map();
         return view('auth.register-new-dealer',compact('map')) ;

    }
    
	public function registerAnother()
	{
		return view('auth.register_another') ;
	}
    public function logout()
    {

        auth()->logout();
        return back() ; //return redirect('/');

    }

    //end users functions
    /*
     * site newsletter
     */
    public function newsletters(Request $request , Newsletter $newsletter )
    {

        $this->validate($request, [
            'email' => 'required|email',
        ]);
       $data = Newsletter::where('email' , $request->email )->get();
        if(count($data) > 0  )
        {
             return __('site.email_newsletter_already_saved') ;

        }
        else
        {
            $newsletter->email = $request->email ;
            $newsletter->save() ;
            return __('site.email_newsletter_saved') ;

        }

    }
    //end news letters

    /**
     * search functions
     */
       public function search(Request $request)
    {

        try{
        if(Lang::locale() == 'ar'){
            $title = 'name_ar' ;
        }elseif(Lang::locale() == 'en'){
            $title = 'name_en' ;

        }else{
            $title = 'name_ar' ;
        }
        $where = array() ;
        $search_name = "" ;
        $products  = Product::where('name_ar' , '=' , '0')->get() ;
        //dd($products) ;

        if(isset($request->search) && $request->search != null  ){
            $search_name = strip_tags($request->search) ;
            $products = Product::where('quantity' , '>' , 0)->where('deleted_at' , null )->where('name_ar' , 'like' , '%'.$search_name.'%')->orWhere('name_en' , 'like' , '%'.$search_name.'%')->paginate(16) ;  //->orderby('created_at' , 'desc')

//            $products = DB::table('products')
//                ->join('users','users.id','products.product_owner_id')
//                ->join('paidacounts','users.id','paidacounts.user_id')
//                ->where('paidacounts.active','=','yes')
//                ->select('products.*')->get();
        }
        if(isset($request->i) && is_numeric($request->i)){
            array_push($where , ['section_id' , '=' , $request->i ]) ;
            $search_name = strip_tags($request->i) ;
        }
        if(isset($request->b) && is_numeric($request->b)){
            array_push($where , ['brand_id' , '=' , $request->b ]) ;
            $search_name = strip_tags($request->b) ;
        }
        if(isset($request->i) || isset($request->b ) ) {
            $products = Product::where($where)->orderby('created_at' , 'desc')->where('quantity' , '>' , 0)->where('deleted_at' , null )
                ->paginate(16) ;

        }
        if(isset($request->search) && $request->search != null ) {
            $url = url('/') . '/search?search=' . $search_name;
        }
        if(isset($request->i) && is_numeric($request->i)){
            $url = url('/').'/search?search='.$search_name.'&i='.$request->i ;
        }
        if(isset($request->b) && is_numeric($request->b)){
            $url = url('/').'/search?search='.$search_name.'&b='.$request->b ;
        }
        if( !$products->isEmpty() ){
            $products->setPath($url);
        }

        return view('search' , ['products' => $products , 'search_title' => $search_name ]) ;
        }catch (Exception $e) {
            abort('/404' ) ;
        }

    }



    public function searchFilter(Request $request)
    {
      //  $advancedSearch = new AdvancedSearch($request);
       // $paginator = $advancedSearch->get(12);
        
     // $searchCreiteria = $advancedSearch->getSearchCriteria();
        //$title = $advancedSearch->getMainTitle();
	//	  //dd($products) ;
      /*    

		*/$where = array() ;
		 if(isset($request->price_max) ){
            array_push($where , ['price' , '<' , $request->price_max ]) ;
        } 
		if(isset($request->section_id) ){
            array_push($where , ['section_id' , '=' , $request->section_id ]) ;
        }
		if(isset($request->sub_section_id) ){
            array_push($where , ['sub_section_id' , '=' , $request->sub_section_id ]) ;
        }
		if(isset($request->sub_sub_section_id) ){
            array_push($where , ['sub_sub_section_id' , '=' , $request->sub_sub_section_id ]) ;
        }
		if(isset($request->price_min) ){
            array_push($where , ['price' , '>' , $request->price_min ]) ;
        } //dd($where) ;
		//$products = Product::where($where)->where('active' , 'yes')->get() ;; dd($products) ;
		 if(isset($request->order) ){
			  switch ($request->order)
        {

            case 'old':
			array_push($where , ['created_at' , '>' , $request->price_max ]) ;
               $products = Product::where($where)->orderBY('created_at' , 'desc')->where('active' , 'yes')->take(20)->get() ;;
			
            break;

            case 'new':
                $products = Product::where($where)->orderBY('created_at' , 'asc')->where('active' , 'yes')->take(20)->get() ;;
			
            break;
            case 'low_price':
               $products = Product::where($where)->orderBY('created_at' , 'asc')->where('active' , 'yes')->take(20)->get() ;;
			
            break;

            case 'height_price':
               $products = Product::where($where)->orderBY('price' , 'desc')->where('active' , 'yes')->take(20)->get() ;;
			
            break;            
            default:
			$products = Product::where($where)->where('active' , 'yes')->take(20)->get() ;;
			    break ;
              //  $this->builder->orderBy(DB::raw('`products`.`created_at`'), 'DESC');
            break;
        }
            
        }
		// dd($products) ;
		//$products = Product::where($where)->where('active' , 'yes')->get() ;;
		return view('filter_search' , ['products' => $products  ]) ;
    }

   public function searchSectionByName(Request $request)
    {
     $section = Section::find($request->section) ;
     $section_results = Section::find($request->section)->where('name_ar' , 'like' ,'%'.$request->sorting_by.'%' )->orwhere('name_en' , 'like' ,'%'.$request->sorting_by.'%')->get() ;
     return view('sidebarsearchsectionresult' , ['section' => $section , 'section_results' => $section_results ]) ;
    }
    //end search filter functions
     /*
     * ajax functions
     */
    public function cities_list(Request $request)
    {

        $cities  =   Citie::where("countrie_id",$request->countrie)->get();
        $current = (isset($request->current)) ? $request->current : 0;
        $current_region = (isset($request->current_region)) ? $request->current_region : 0;
        return view('cp.cities_list',["current"=>$current,"cities"=>$cities,"current_region"=>$current_region]);

    }
    public function regions_list(Request $request)
    {

        $regions = Region::where("citie_id",$request->citie)->get();
        $current = (isset($request->current)) ? $request->current : 0;
        return view('cp.regions_list',["current"=>$current,"regions"=>$regions]);

    }
    /*
  * get product data using id and slug for popup model
  */
    public function product_ajax_model_request(Request $request)
    {

        $product = Product::find($request->product) ;
        return view('product_model_ajax' , compact('product')) ;

    }
    /*
     * get products data for slider
     */
    public function product_slider_list(Request $request)
    {
        $where = array()  ;
        if(isset($request->main_section)){
            array_push($where,['section_id' , '=' , intval($request->main_section) ]);
        }
        if(isset($request->sub_section)){
            array_push($where,['sub_section_id', '=' , intval($request->sub_section) ]);
        }
        if(isset($request->min)){
            array_push($where,['min_price','>',0]);
        }

        $products = Product::distinct()->orderBY('id','desc')->where('active' , 'yes')->where($where)->take(10)->get() ;
        return view('product_slider_list' , compact('products')) ;

    }
    public function product_slider_list_lastmin(Request $request)
    {
        $where = array()  ;
        if(isset($request->main_section)){
            array_push($where,['section_id' , '=' , intval($request->main_section) ]);
        }
        if(isset($request->sub_section)){
            array_push($where,['sub_section_id', '=' , intval($request->sub_section) ]);
        }
        if(isset($request->min)){
            array_push($where,['min_price','>',0]);
        }

        $products = Product::distinct()->orderBY('id','desc')->where('active' , 'yes')->where($where)->take(10)->get() ;
        return view('product_slider_list_min' , compact('products')) ;

    }

    //add_product_to_favourite
    public function add_product_to_favourite(Request $request, Favoriteable $favorate  )
    {

        if ( isset($request->product)) {
             $profile = Favoriteable::where('favoriteable_id' , Auth::user()->id )->where('product_id' , '=' , intval($request->product))->first();

            if( !empty($profile) || $profile != null   ) {
                $profile->delete() ;
                $button_name =   '' ;
                return response()->json(['success'=>__('site.delete_from_favourite_products') , 'button_name' => __('site.add_prodcut_to_favourite') ]);


                /*if(empty($profile->deleted_at) || $profile->deleted_at == null ) {
                    $profile->deleted_at = Carbon::now()->toDateTimeString();
                    if ($profile->save()) {
                        $button_name = '' ;
                        return response()->json(['success' => __('site.delete_from_favourite_products') , 'button_name' => __('site.delete_from_favourite') ]);
                    } else {
                        return response()->json(['success' => __('site.unknow_error_happen')]);
                    }

                }else{

                    $profile->deleted_at = null ;
                    Favoriteable::where('product_id',30)
                        ->where('favoriteable_id', 1)
                        ->update(['deleted_at' => null ]);
                    $button_name =   '' ;
                    return response()->json(['success'=>__('site.product_add_to_your_favourite') , 'button_name' => __('site.add_prodcut_to_favourite') ]);

                }*/
       }else{

            $favorate->product_id = $request->product;
            $favorate->favoriteable_id = Auth::user()->id ; //$current->id;
            $favorate->favoriteable_type = 'App\User';
            if($favorate->save()){
                $button_name =   __('site.delete_from_favourite') ;
                return response()->json(['success'=> __('site.product_add_to_your_favourite') , 'button_name' => __('site.delete_from_favourite') ]);

            }else{
                return response()->json(['success'=> __('site.unknow_error_happen') ]);
            }

          }
      }else{
            return response()->json(['success'=> __('site.unknow_error_happen') ]);
        }
    }
    //save  cart items in session if user not register
    public function session_cart(Request $request)
    {

     $product_id = intval(strip_tags($request->product)) ;
     if(is_numeric($product_id)){
         $product = Product::find(intval($request->product)) ;
         if(empty($product) ){
             return __('site.unknow_error_happen' ) ;
         }  //store in sessions
         $data = array(
             "id" => $product->id,
             "name" => $product->name_ar,
             "qty" => ($product->min_quantity > 0  ) ? $product->min_quantity : 1 ,  // make quantity min
             "price" => (isset($product->min_price) ) ? $product->min_price : $product->price ,
             "options" => ['product_owner' => $product->product_owner_id ,'shiping_price' => 0 , 'cupon_code' => 0 ] ,
         );
         foreach (Cart::content() as $row){
             if($product_id == $row->id ){
                 if($row->qty < $product->quantity){
                     Cart::add($data)->associate(Product::class); ;
                     return __('site.add_one_more_product_item') ;
                 }else{
                     return 'تم نفاذ كميه المنتج' ;
                 }

             }
         }
         Cart::add($data)->associate(Product::class);
         return  __('site.product_add') ;//response()->json(['success'=>'تم اضافه المنتج'  ] );
      }else{
         return __('site.unknow_error_happen' ) ; //response()->json(['success'=>'حدث خطا غير متوقع']);
     }
    }
   //delete from cart
    public function cart_delete(Request $request)
    {

        Cart::remove($request->row_id);
        $shiping_price = 0 ;
        return view('cp.cart_ajax' , compact('shiping_price') ) ;
    }
    //cart update
    public function update_cart(Request $request)
    {
        $productCart = Cart::get($request->row_id);
        $productData = Product::where('id' , $productCart->id )->first() ;
        if($productData->min_quantity > $request->qty){
            return "" ;
         }else{
        $shiping_price = 0 ;
        if(Auth::user()){
            Cart::update($request->row_id, intval($request->qty) );
            $shiping_price = 0 ;
            $user_addresse = Users_addresse::where('user_id' , Auth::user()->id )->where('active' , 'yes' )->first() ;

            foreach(Cart::content() as $row ){
                $product_data = Product::where('id' , $row->id )->first() ;
                $shiping_data = Shiping::where( 'user_id' , $product_data->product_owner_id )->where('citie_id' , $user_addresse->citie_id )->first() ;
                if(!empty($shiping_data)){
                    $shiping_price+= $shiping_data->shiping_coast * $row->qty ;
                }
            }

            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price] ) ;
        }else{
            Cart::update($request->row_id, intval($request->qty) );
            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price]) ;
        }
        }
        //return 'تم تعديل  الكميه' ;
    }
    public function getCartData()
    {
        $shiping_price = 0 ;
        if(Auth::user()){
            $user_addresse = Users_addresse::where('user_id' , Auth::user()->id )->where('active' , 'yes' )->first() ;

            foreach(Cart::content() as $row ){
                $product_data = Product::where('id' , $row->id )->first() ;
                $shiping_data = Shiping::where( 'user_id' , $product_data->product_owner_id )->where('citie_id' , $user_addresse->citie_id )->first() ;
                if(!empty($shiping_data)){
                    $shiping_price+= $shiping_data->shiping_coast * $row->qty ;
                }
            }

            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price] ) ;
        }else{
            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price]) ;
        }
    }
    //delete from session
    public function delete_product_from_session($id)
    {  //echo Session()->exists('cart') ; dd() ;
     /*   echo Session::has('cart[8]') ; dd(1) ;
        if( in_array($id , Session()->get('cart')) == 'true' ){echo 1 ; }
        dd(Session::get('cart')) ;*/

      /*  $id = strip_tags($id) ;
        $id = intval($id) ;
        if(is_numeric($id)){
            //get all session saved products
            $products  = Session::pull('cart') ; dd($products) ;
             Session::forgot('cart') ; dd($products) ;
             if(count($products) > 0 ) {
                 $cart = array() ;
                foreach ($products as $product )
                {
                    // echo $product['id'] ; dd() ; // echo intval($product['id']) ;
                   // echo $product['id'] ; echo $id ;
                      // echo intval(intval($product['id']) == $id) ; dd() ;
                    if( intval($product['id'])  == intval($id) ){
                        continue ;
                    }else{

                        $data = array(
                            "id" => $product['id'],
                            "name" => $product['name'],
                            "qty" => 1,
                            "price" => $product['price'],
                           );
                        array_push($cart , $data) ;

                    }
                    //dd($cart) ;
                }*/
                // Session::push('cart', $cart );
                 /*dd( count(Session()->get('cart'))) ;
                 if( count(Session()->get('cart')) == 0 ){
                     Session::put('cart', $cart );
                 }else{

          /*       }*/
          /*  }

            return response()->json(['success'=>'تم حذف  المنتج'  ] );
        }else{
            return response()->json(['success'=>'حدث خطا غير متوقع']);
        }*/

      //  dd( $products ) ;
    }
   //cart popup
    public function cart_popup_items()
    {
        return view('cart_popup_items'  ) ;
    }
    //
    protected function validator(array $data)
    {

        return $validator =  Validator::make($data , [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ] );
    }
    public function add_addresses(Request $request ,Users_addresse $users_addresse )
    {
        $input = $request->all();
        $validator = $this->validator($input);

       /* $validator =  Validator::make($request , [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ] );*/

        if ( $validator->passes()) {
            try{

            $region_id = (isset($request->region_id)) ? $request->region_id : 0 ;
            $users_addresse->user_id = 1  ;
                $users_addresse->addresse_ar = $request->name_ar ;
                $users_addresse->addresse_en = $request->name_en ;
                $users_addresse->countrie_id = $request->countrie_id ;
                $users_addresse->citie_id = $request->citie_id ;
                $users_addresse->region_id = $region_id ;
            //return 1 ;

            $users_addresse->save() ;

            return response()->json(['success'=>__('site.add_addresses_success') ]);

            }
            catch(\Exception $e){

                // do task when error
                return response()->json(['success'=>__('site.unknow_error_happen')]);   // show error

            }
        } else{

            return response()->json(['success'=>$validator->errors()->all()]);

        }

    }
    //dealer profile page
    public function dealer_profile($slug , $id )
    {
        $products = Product::where('product_owner_id' , $id )->orderBy('price', 'ASC')->where('active' , 'yes')->where('quantity' , '>' , 0 )->paginate(9) ;
        $sections = Section::where('parent_id' , '=',0)->get() ;
        $brands = Brand::all() ;
        $user = User::find($id) ;
        $adverstisment2_up_last_products = Advertisment::inRandomOrder()->where('active' , 'yes')->where('location' , 2 )->take(1)->get() ;

        return view('cp.dealer_profile' , [ 'adverstisments2' =>$adverstisment2_up_last_products , 'products' => $products , 'user' => $user ,'sections' => $sections , 'brands' => $brands ]) ;
    }
    public function searchInDealerProducts(Request $request)
    {
        if(isset($request->dealer_id) && isset($request->search))
       {
        if(Lang::locale() == 'ar'){
            $title = 'name_ar' ;
        }elseif(Lang::locale() == 'en'){
            $title = 'name_en' ;

        }else{
            $title = 'name_ar' ;
        }
        $search_name = strip_tags($request->search) ;
        $products = Product::where('product_owner_id' , $request->dealer_id )->where('name_ar' , 'like' , '%'.$search_name.'%')->orderBy('price', 'ASC')->where('active' , 'yes')->where('quantity' , '>' , 0 )->paginate(9) ;
        $url = url('/').'/search-in-dealer?dealer_id='.$request->dealer_id.'&search='.$search_name ;
        $products->setPath($url);
        $sections = Section::where('parent_id' , '=',0)->get() ;
        $brands = Brand::all() ;
        $user = User::find($request->dealer_id) ;
        return view('cp.dealer_profile' , ['products' => $products , 'user' => $user ,'sections' => $sections , 'brands' => $brands ]) ;
       }else{
           abort('404') ;
        }
    }
    public function getCartCount()
    {
		$i = 0 ;
		foreach (Cart::content() as $row) {
             $i++ ;  
            }
        return $i ;
    }
	public function companyPage($id)
	{
		$user = User::find($id) ;
		return view('company_page' , ['user' => $user ]) ; 
	}	
	public function companyCategory()
	{
		return view('company_page') ; 
	}	
	public function newRegister()
	{
		return view('auth.newregister') ; 
	}
	    //cart funstions
    public function cart()
    {
		 $shiping_price = 0 ;
		if(Auth::user())
		{
			if( Auth::user()->level === 'admin' || Auth::user()->level === 'dealer'){
            abort('404') ;
			}

			if (Auth::user()->level != 'user') {
				return redirect('/');
			}
			   $shiping_price = 0;
        $user_addresse = Users_addresse::where('user_id', Auth::user()->id)->where('active', 'yes')->first();
        if (!empty($user_addresse)) {
            foreach (Cart::content() as $row) {
                $product_data = Product::where('id', $row->id)->first();
                $shiping_data = Shiping::where('user_id', $product_data->product_owner_id)->where('citie_id', $user_addresse->citie_id)->first();
                if (!empty($shiping_data)) {
                    $shiping_price += $shiping_data->shiping_coast * $row->qty;
                }
            }
        }
		}
	
 

     

        //  dd($shiping_price) ;
        return view('cp.cart', ['shiping_price' => $shiping_price]);
    }
	public function Userlevel($id )
	{
		  $userlevel = Userlevel::find($id) ;  
		  $users = User::where('level' , $userlevel->slug)->paginate(20) ; 
		  return view('userlevel' , ['userlevel' => $userlevel  , 'users' => $users] );
	}

     public function checkCuponValid(Request $request)
    {
      // dd(date("m-d-Y h:i:s")) ;
        $cupon = Cupon::where('cupon_code' , $request->cupon)->first() ;
        //dd($cupon) ;
        if(!empty($cupon)){           
           
            if(!empty($cupon->product_id) &&  $cupon->product_id !=0){
                foreach(Cart::content() as $row) {
                    if($row->id == $cupon->product_id  ){
                        return 1 ;
                    }
                }
                return 'الكبون غير موجهه للمنتجات المراد شرائها' ;
            }
            return 1 ;
        }else{
            return 'الكبون غير صالح' ;
        }

    }
	 public function useCupon(Request $request)
    {
        $shiping_price = 0 ;
		$total_descount = 0 ;
		$final_commission = 0 ;
		$product_price = 0 ;
            //$shiping_price = 0 ;

            //$user_addresse = Users_addresse::where('user_id' , Auth::user()->id )->where('active' , 'yes' )->first() ;
            $cupon = Cupon::where('cupon_code' , $request->cupon)->first() ;
            // dd($cupon) ;
			//dd(Cart::content()) ;
            foreach(Cart::content() as $row ) {
                $product_data = Product::where('id', $row->id)->first();
            // $s = $row->options->cupon_code ;
               // if ($s !=  0){ //this mean use only one cupon
//dd('dddddddddd') ;  dd
                    $product_price = ($row->price - (($row->price * $cupon->discount_percentage) / 100));   
                         $desccount = $row->price - $product_price ; 
						 $final_commission +=$desccount ;
                 /*   if($cupon->discount_monay > 0 ){
                        if($product_price > $cupon->discount_monay){
                            $final_commission = $row->price  -  $cupon->discount_monay ;
                        }
                    }else{
						 $product_price = ($row->price - (($row->price * $cupon->discount_percentage) / 100));   
                         $final_commission += $row->price - $product_price ; //dd($final_commission) ;
					}  */

                  /*  if (!empty($cupon->product_id) && $cupon->product_id != 0) {
                        if ($row->id == $cupon->product_id) {

                            $produc_cart = array(
                                'price' => $product_price ,
                                "options" => ['product_owner' => $row->model->product_owner_id, 'cupon_code' => $cupon->cupon_code]
                            );
							 Cart::update($row->rowId, $produc_cart);
                        }
                    } else { */
                        $total_descount += $row->price -  $final_commission ;
                        $produc_cart = array(
                            'price' => $product_price ,
                            "options" => ['product_owner' => $row->model->product_owner_id, 'discount' =>  $desccount  , 'cupon_code' => $cupon->cupon_code]
                        );
						 Cart::update($row->rowId, $produc_cart);
                   // }

             //  }
		

               // Cart::update($row->rowId, $produc_cart);
                //
            }
            //get cupon data
            //$cupon = Cupon::where('active' , 'yes')->where('deleted_at' , null )->where('id' , $request->cupon)->first() ;
            //end cupon function
           // dd($final_commission) ;
            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price , 'total_descount' => $final_commission  , 'final_commission' => $final_commission ] ) ;
        
    }
		//mobile activation 
	public function mobileactive()
	{
		return view('auth.activemobile') ;
	}
	public function savemobileactive(Request $request)
	{
		$user = User::where('token' ,  $request->token)->first() ;
		if(!empty($user)){
			if($user->active == 'yes' ){
				  return redirect()->to('login')
                ->with('success', 'الحساب مفعل من قبل ');
			
			}else{
				if(isset($this->settings['activetype'])){
				if($this->settings['activetype'] == 'yes' ){
				$user->active = 'yes' ; 
				$user->save() ;
				  return redirect()->to('login')
                ->with('success', 'تم تفعيل حسابك');
				}else{
					 return redirect()->to('login')
                ->with('success', 'تم تاكيد رقم جوالك فى انتظار تفعيل حسابك من  الاداره');
				}
				}else{
					$user->active = 'yes' ; 
				$user->save() ;
				  return redirect()->to('login')
                ->with('success', 'تم تفعيل حسابك');
				}
			}
			
		}else{  
			$request->session()->flash('alert-success', 'لا يوجد حساب مسجل  او الحساب مفعل مسبقا ');
			return back() ;
		}
		
	}
		 public function doLogin(Request $request){ 
		  try{
			  
		 
		 if (Auth::attempt(['email' => $request->email , 'password' => $request->password , 'active' => 'yes'])) { //dd(1) ;
			 	 return redirect()->to('/')
                ->with('success','مرحبا بك' ); 
			
    // The user is active, not suspended, and exists.
			}else{
				 return redirect()->to('login')
                ->with('success','الاكونت غير مفعل الرجاء التواصل مع الاداره او فحص الايميل الخاص بك عن ايميل التفعيل' ); 
			}
			 }catch(Exception $e){
				 		 return redirect()->to('login')
                ->with('success','حدث خطا الرجاء المحاوله مره اخرى' ); 
		
			 }
       
       
    }
	public function getBaseUrl()
{
	 return response()->json([
                        'status' => 1,
                        'url' =>URL::to('')
                    ]);
	
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
 public function getSubSection($id)
 {
	  $sections = Section::where('deleted_at' , null )->where('parent_id' , $id )->where('active' , 'yes')->where('sub_section' , 0)->get() ;
      if(!empty($sections ))  
	  {     
	 return response()->json([
                        'status' => 1,
						 'link_view' => URL::to('').'section/slug for main section  arabic or english /sulg for sub section  /  sub section id' ,
                        'data' => $sections
                    ]);
	  }else{
		   return response()->json([
                        'status' =>0,
					 'data' => ''
                    ]);
	  }
 } 
 public function getSubSubSection($id)
 {
	  $sections = Section::where('deleted_at' , null )->where('sub_section' , $id )->where('active' , 'yes')->where('sub_section' , 0)->get() ;
      if(!empty($sections ))  
	  {	  return response()->json([
                        'status' => 1,
						 'link_view' => 'baseur/section/slug for main section  arabic or english /sulg for sub section  /slug for sub sub section  / sub  sub section id' ,
                        'data' => $sections
                    ]);
}else{
	 return response()->json([
                        'status' =>0,
					 'data' => ''
                    ]);
}		  
 }
 public function getUserLevel()
 {
	 $userlevels = Userlevel::all() ; 
	   return response()->json([
                         'status' => 1,
						 'link_view' => URL::to('').'additionalacount/userlevel/ id' ,
                         'data' => $userlevels
                    ]);
 }
 public function getPages()
 {
	  $topbar_pages = Page::where('deleted_at' , null )->where('active' , 'yes')->get() ;
       return response()->json([
                         'status' => 1,
						 'link_view' => 'baseur/page/slug/ id' ,
                         'data' => $topbar_pages
                    ]);
 }
}
