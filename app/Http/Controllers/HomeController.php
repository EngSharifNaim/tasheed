<?php

namespace App\Http\Controllers;

use App\Paidacount;
use App\paidacounttype;
use App\Userlevel;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector ;
use Carbon;
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
use App\Measurements_unit ;
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
use Mockery\Exception;
use Session;
use App\Users_addresse ;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Storage;
use App\Shipingcart ;
use DB;
use App\Order ;
use App\Order_product ;
use Mail ;
use App\Conversation;
use App\Message;
use App\Shiping ;
use App\Companie ;
use App\Transfer_detail ;
use App\Cupon ;
use App\Siteprofit ;
use App\Gallery;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    public $settings;
    public $order_status;
    public $payment_type;

    public function __construct()
    {
        Carbon::setLocale(Lang::locale());
        $this->middleware('auth');
        $settings = Setting::all();
        $variables = array();
        foreach ($settings as $key => $val) {
            $variables[$val->key] = $val->value;
        }
        $this->settings = $variables;
        $this->order_status = array(
            'in_progress' => 'جارى عرض الطلب',
            'in_prepration' => 'جارى التجهيز',
            'on_delevery' => 'جارى التوصيل',
            'delevried' => 'تم التوصيل',
            'cancelled' => 'ملغى',
            'refunded' => 'مرتجع',
        );
        $this->payment_type = array(
            'oncash' => 'الدفع عند التوصيل',
            'payfort' => 'وسيله دفع اون لاين',
            'transfer_maney' => 'تحويل بنكي',
        );

    }

    /** 
     * Show the application dashboard.
     *
     */
    public function index()
    {

        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }
        /*  if(count(Cart::content()) > 0 ){
              $data = Cart::restore(Auth::user()->id);
              if(count($data) > 0 ){

              }else{
                  Cart::store(Auth::user()->id);
              }
          }*/
        //check if user added in newsletter
        $news_letter_check = 0; //0 mean not joined
        $data = Newsletter::where('email', Auth::user()->email)->first();

        if (!empty($data)) {
            $news_letter_check = 1;
        }

        /////////// test paid acount///////////////////


        ///////////////////end test//////////////

        return view('cp.usercontrol', compact('news_letter_check'));
    }

    public function favourite_products()
    {
        if( Auth::user()->level === 'admin'   || Auth::user()->level === 'dealer' ){
            abort('404') ;
        }

        $products = Favoriteable::where('favoriteable_id', Auth::user()->id)->get(); //Auth::user()->favorited ;//()->paginate(10) ;
        return view('cp.favouritesproducts', ['products' => $products]);
    }

    //delete an item from favourite   // favourite_product_ajax
    public function remove_favourite_product(Request $request)
    {
        if (!empty($request->product_id)) {
                $product = Favoriteable::where('product_id', intval($request->product_id))->first();
                if (!empty($product)) {
                    $product->delete();
                    $request->session()->flash('alert-success', __('site.favourite_product_delete'));

                    $products = $products = Favoriteable::where('favoriteable_id', Auth::user()->id)->get();
                    return view('cp.favourite_product_ajax', ['products' => $products]);
                }
             else {
                return false;
            }

        } else {
            return false;
        }
    }

    // add favourite items to cart
    public function add_favourite_to_cart(Request $request)
    {
        try {
            $products_to_cart = Favoriteable::where('favoriteable_id', Auth::user()->id)->get();
            foreach ($products_to_cart as $product) {
                if ($product->quantity > 0 && $product->active = 'yes') {
                    $data = array(
                        "id" => $product->id,
                        "name" => $product->name_ar,
                        "qty" => 1,
                        "price" => (isset($product->min_price) ) ? $product->min_price : $product->price ,
                        "options" => ['product_owner' => $product->product_owner_id ,'shiping_price' => 0 , 'cupon_code' => 0],
                    );
                    Cart::add($data)->associate(Product::class);
                   /* $productt = Favoriteable::where('product_id', intval($product->product_id))->first();
                    $productt->delete()*/;

                } else {
                    continue;
                }
            }
            Favoriteable::where('favoriteable_id', Auth::user()->id)->delete() ;
            //cp.favourite_product_ajax
            $products = array();
            $request->session()->flash('alert-success', __('site.add_cart_in_favourite'));
            return view('cp.favourite_product_ajax', ['products' => $products]);
        } catch (Exception $e) {
            $request->session()->flash('alert-success', __('site.unknow_error_happen'));
            return view('cp.favourite_product_ajax', ['products' => $products]);
        }
    }

    /**
     * function for user profile
     */
    public function update_personal_data()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

        return view('cp.editprofile');
    }
    public function paid_acount()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }
        $paidacounts=Paidacounttype::where('user_type','=',Auth::user()->level)->get();
//        return \Illuminate\Support\Facades\Auth::user()->level;
        $testacount=Paidacount::where('user_id','=',Auth::user()->id)->first();
        $myacount = $testacount;
        $haseacount='';
        if($testacount){
            if($testacount->active == 'yes') {
//                return $testacount;
                $haseacount = 'انت مشترك بالفعل';
                return view('cp.paid_acount',compact('haseacount','myacount','paidacounts'));

            }
            else
            {
                $haseacount = 'اشتراكك بانتظار التفعيل';
                return view('cp.paid_acount',compact('haseacount','paidacounts','myacount'));

            }

        }

//        return $paidacounts;
        return view('cp.paid_acount',compact('paidacounts','myacount','haseacount'));
    }

    public function paid_acount_new(Request $request)
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }
        $paidacounts=new Paidacount();
        $paidacounts->user_id = Auth::user()->id;
        $paidacounts->type_id = $request->plan_id;
        $paidacounts->sender = $request->sender;
        $paidacounts->payId = $request->payId;
        $paidacounts->banck = $request->banck;
        $paidacounts->active = 'no';
        $paidacounts->paidlong = $request->paidlong;

//        return $request->file('image');
        if($request->hasFile('image')){
            $img = $request->file('image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $path=public_path('images');
            $img->move($path,$imgName);
            $paidacounts->image = $imgName;
//            return $imgName;
        }

        $paidacounts->save();
        $paidacounts=Paidacounttype::where('user_type','=',Auth::user()->level)->get();
//        return \Illuminate\Support\Facades\Auth::user()->level;
        $testacount=Paidacount::where('user_id','=',Auth::user()->id)->first();
        $myacount = $testacount;

        if($testacount){
            if($testacount->active == 'yes') {
//                return $testacount;
                $myacount = $testacount;
                $haseacount = 'انت مشترك بالفعل';
                return view('cp.paid_acount',compact('haseacount','myacount','paidacounts'));

            }
            else
            {
                $myacount = $testacount;

                $haseacount = 'اشتراكك بانتظار التفعيل';
                return view('cp.paid_acount',compact('haseacount','paidacounts','myacount'));

            }

        }

//        return $paidacounts;
        return view('cp.paid_acount',compact('paidacounts','myacount'));

        return back();
    }

    public function edit_profile(Request $request, $id)
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

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
            $user->save();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    //end user profile functions
    public function dealer_profile()
    {

        $products = Auth::user()->products()->paginate(10);
        return view('cp.dealer_profile', ['products' => $products]);
    }

    public function addresses_settings()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

        return view('cp.alladdresse');
    }

    public function myOrders()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

        $orders = Order::orderBY('id','desc')->where('user_id' , Auth::user()->id)->where('parent_id' , 0)->where('deleted_at' , null )->paginate(6) ;
        return view('cp.myorders' , ['orders' => $orders]);
    }

    public function emaillist()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

        return view('cp.emaillist');
    }

    //chats
    public function conservation()
    {
        $messages = Auth::user()->conversation_from()->orderBy('id', 'desc')->paginate(15);
        if (count($messages) == 0) {

            $messages = Auth::user()->conversation_to()->orderBy('id', 'desc')->paginate(15);
        }
        return view('cp.usermessages', ['messages' => $messages]);
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
        return view('cp.messages', ['type' => $type, 'messages' => $messages]);
    }

    public function conversations(Request $request, $id)
    {

        $messages = Conversation::find($id);
        $conversations = Auth::user()->conversation_from()->get();
        $conversations_with = Auth::user()->conversation_to()->get();
        return view('cp.conversations1', ['conversations' => $conversations, 'messages' => $messages, 'conversations_with' => $conversations_with]);
    }

    public function getConversation(Request $request, $id)
    {
        $messages = Conversation::find($id);
        $conversations = Auth::user()->conversation_from()->get();
        $conversations_with = Auth::user()->conversation_to()->get();
        $messages_contacts = Auth::user()->conversation_list()->orderBy('id', 'desc')->paginate(15);

        return view('cp.conversations', ['messages' => $messages, 'conversations' => $conversations, 'conversations_with' => $conversations_with, 'messages_contacts' => $messages_contacts]);
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

        return 1;
    }

    public function getChatMessages(Message $message, Request $request)
    {

        $messages = Conversation::find($request->conversation_id);
        return [
            'messages' => view('cp.conversations_ajax', [
                'messages' => $messages,
            ])->render(),
            'last_message' => $messages->message->last()->details,
            'total' => count($messages->message)
        ];
    }

    //end chats

    public function cupons()
    {
        if( Auth::user()->level === 'admin' ){
            abort('404') ;
        }

        return view('cp.discountcupons');
    }
    //products functions

    /** show product  */
    public function show_product($id)
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        $sections = Section::where('parent_id', 0)->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $users = User::all();
        $product = Product::find($id);
        $measurements_units = Measurements_unit::all();
        return view('cp.show_product', compact('measurements_units', 'product', 'users', 'sections', 'brands', 'colors', 'sizes'));
    }

    //first my products
    public function dealer_products()
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        $products = Product::orderBY('id','desc')->where('product_owner_id', Auth::user()->id)->get();

        return view('cp.myproducts', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_product(Product $product)
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        $sections = Section::where('parent_id', 0)->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $measurements_units = Measurements_unit::all();
        return view('cp.add_product', compact('measurements_units', 'sections', 'brands', 'colors', 'sizes'));
    }

    /**
     */

    public function save_product(Request $request, Product $product)
    {

        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        if (isset($request->max_quantity) && isset($request->min_quantity)) {
            $min_q = intval($request->max_quantity);
        }

        $this->validate($request, [
            'name_ar' => 'string|min:3|required',
            'min_quantity' => 'required|integer' ,
            'price' => 'required',
            'parent_id' => 'required',
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            'min_quantity' => 'required|numeric|max:' . $min_q,
        ]);

        if (isset($request->min_price)) {
            $min = intval($request->price);
            $this->validate($request, [
                'min_price' => 'numeric|max:' . $min,
            ]);
        }

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->keywords_ar = $request->keywords_ar;
        $product->keywords_en = $request->keywords_en;
        $product->brand_id = $request->brand_id;
        $product->section_id = $request->parent_id;
        $product->sub_section_id = $request->sub_id;
        $product->sub_sub_section_id = $request->sub_sub_id;
        $product->product_owner_id = Auth::user()->id;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->min_price = $request->min_price;
        $product->quantity = $request->quantity;
        $product->min_quantity = $request->min_quantity;
        $product->max_quantity = $request->max_quantity;
        $product->active = $request->active;
        $product->featured = $request->featured;
        $product->manfacture_country = (isset($request->manfacture_country)) ? $request->manfacture_country : 0;
        $product->measurements_unit_id = (isset($request->measurements_unit_id)) ? $request->measurements_unit_id : 0;

//        uploaded many image

        if (!empty($request->file('image'))) {
//            $image = Storage::putFile('public', $request->file('image'));
//            $product->image = Storage::url($image);
//            return $request->file('image');
            $imageName = '/' . 'storage' . '/' . rand(11111, 99999) . '-' . time() .'.'.request()->image->getClientOriginalExtension();
            $product->image = $imageName;
//            return $imageName;
            request()->image->move(public_path('storage'), $imageName);




        }

        //uploaded many image
        $files = $request->file('images');
//        return $files;
        if (!empty($request->hasFile('images'))) {
            $files_list = array();
            foreach ($files as $key => $file) {
                if ($key > 5) {
                    break;
                }

                $photo = Storage::putFile('public', $file);
                $original = Storage::url($photo);
                array_push($files_list, $original);

            }
            $product->images = implode(",", $files_list);
        }






        //save colors
        if (!empty($request->colors)) {
            $colors = array();
            foreach ($request->colors as $color) {

                array_push($colors, $color);

            }
            $product->color_id = implode(",", $colors);
        }

        //save sizes
        if (!empty($request->sizes)) {
            $sizes = array();
            foreach ($request->sizes as $size) {

                array_push($sizes, $size);

            }
            $product->size_id = implode(",", $sizes);
        }
        //option arabic
        if (!empty($request->details_ar)) {
            $details_ar = array();
            foreach ($request->details_ar as $detail_ar) {

                array_push($details_ar, $detail_ar);

            }
            $product->details_ar = implode(",", $details_ar);
        }
        //option english
        if (!empty($request->details_en)) {
            $details_en = array();
            foreach ($request->details_ar as $detail_en) {

                array_push($details_en, $detail_en);

            }
            $product->details_en = implode(",", $details_en);
        }


        $product->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
       // redirect ('my-products') ;
        return back();
    }

    public function product_edit($id)
    {

        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        $product = Product::find($id);

        if(Auth::user()->id != $product->product_owner_id){
            abort('/404') ;
        }

        $sections = Section::where('parent_id', 0)->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $measurements_units = Measurements_unit::all();
        return view('cp.update_product', compact('measurements_units', 'product', 'users', 'sections', 'brands', 'colors', 'sizes'));
    }

    /**
     */
    public function product_update(Request $request, $id)
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        if (isset($request->price)) {
            $min = intval($request->price);
        }
        if (isset($request->max_quantity)) {
            $min_q = intval($request->max_quantity);
        }

        $this->validate($request, [
            'name_ar' => 'string|min:3|required',
            'price' => 'required',
            'min_quantity' => 'required|integer' ,
            'min_price' => 'required|numeric|max:' . $min,
            'min_quantity' => 'required|numeric|max:' . $min_q,
            'parent_id' => 'required',
            'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
        ]);

        $product = Product::find($id);

        if(Auth::user()->id != $product->product_owner_id){
         abort('/404') ;
        }

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->keywords_ar = $request->keywords_ar;
        $product->keywords_en = $request->keywords_en;
        $product->brand_id = $request->brand_id;
        $product->section_id = $request->parent_id;
        $product->sub_section_id = $request->sub_id;
        $product->sub_sub_section_id = $request->sub_sub_id;
        $product->product_owner_id = Auth::user()->id;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->min_price = $request->min_price;
        $product->quantity = $request->quantity;
        $product->min_quantity = $request->min_quantity;
        $product->max_quantity = $request->max_quantity;
        $product->active = $request->active;
        $product->featured = $request->featured;
        $product->manfacture_country = (isset($request->manfacture_country)) ? $request->manfacture_country : 0;
        $product->measurements_unit_id = (isset($request->measurements_unit_id)) ? $request->measurements_unit_id : 0;
        //upload one image
        if (!empty($request->file('image'))) {
            $image = Storage::putFile('public', $request->file('image'));
            $product->image = Storage::url($image);
        }

        //uploaded many image
        $files = $request->file('images');
        if (!empty($request->hasFile('images'))) {
            $files_list = array();
            foreach ($files as $key => $file) {
                if ($key < 5) {
                    break;
                }
                $photo = Storage::putFile('public', $file);
                $original = Storage::url($photo);
                array_push($files_list, $original);

            }
            $product->images = implode(",", $files_list);
        }

        //save colors
        if (!empty($request->colors)) {
            $colors = array();
            foreach ($request->colors as $color) {

                array_push($colors, $color);

            }
            $product->color_id = implode(",", $colors);
        }

        //save sizes
        if (!empty($request->sizes)) {
            $sizes = array();
            foreach ($request->sizes as $size) {

                array_push($sizes, $size);

            }
            $product->size_id = implode(",", $sizes);
        }

        //option arabic
        if (!empty($request->details_ar) || $request->details_ar != null) {
            $details_ar = array();
            foreach ($request->details_ar as $detail_ar) {
                if (isset($detail_ar)) {
                    array_push($details_ar, $detail_ar);
                }
            }
            $product->details_ar = implode(",", $details_ar);
        } else {
            $product->details_ar = null;
        }
        //option english
        if (!empty($request->details_en) || isset($request->details_en)) {
            $details_en = array();
            foreach ($request->details_en as $detail_en) {
                if (isset($detail_en) || $detail_en != " ") {
                    array_push($details_en, $detail_en);
                }
            }
            $product->details_en = implode(",", $details_en);
        } else {
            $product->details_en = null;
        }


        $product->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        return back();
    }

    /*
     * mass delete products
     */
    public function products_mass_delete(Request $request)
    {


        if (empty($request->checkboxes)) {
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
        Product::destroy($request->checkboxes);


        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
    //end products functions
    //edit company
    public function edit_company()
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'user'){
            abort('404') ;
        }

        $company_data = Companie::where('user_id', Auth::user()->id)->first();
        return view('cp.edit_company', ['company_data' => $company_data]);
    }

    //save company data
    public function save_company_data(Request $request, Companie $companie)
    {

        $this->validate($request, [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'phone' => 'required|numeric',
//            'company_website' => 'required|url',
            'email' => 'required|email',
            'tax_number' => 'required',
            'commercial_register' => 'required',
        ]);

        if (isset($request->id)) {
            $companie = Companie::find(intval($request->id));
        }


        $companie->name_ar = $request->name_ar;
        $companie->user_id = Auth::user()->id;
        $companie->name_en = $request->name_en;
        $companie->phone = $request->phone;
        $companie->company_website = $request->company_website;
        $companie->email = $request->email;
        $companie->tax_number = $request->tax_number;
        $companie->commercial_register = $request->commercial_register;
        $companie->acount_bank_number = $request->acount_bank_number;
        $companie->bank_name = $request->bank_name;
        $companie->location = $request->location;

        $companie->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();

    }

    //cart funstions
    public function cart()
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

        //  dd($shiping_price) ;
        return view('cp.cart', ['shiping_price' => $shiping_price]);
    }

    //check out functions
    public function cart_checkout(Request $request)
    {

        if( Auth::user()->level === 'admin' || Auth::user()->level === 'dealer'){
            abort('404') ;
        }
        //
        //
        //get dealers data
        $product_owner_ids = array();
        foreach (Cart::content() as $row) {
            array_push($product_owner_ids, [$row->options->product_owner]);
        }
        //where('level' , 'dealer')->
        $vendors = User::distinct('id')->whereIn('id', $product_owner_ids)->get();

        $shiping_price = 0;
        $user_addresse = Users_addresse::where('user_id', Auth::user()->id)->where('active', 'yes')->first();
        if (!empty($user_addresse)) {
            foreach (Cart::content() as $row) {
                $product_data = Product::where('id', $row->id)->first();
                $shiping_data = Shiping::where('user_id', $product_data->product_owner_id)->where('citie_id', $user_addresse->citie_id)->first();
                if (!empty($shiping_data)) {
                    $shiping_price += $shiping_data->shiping_coast * $row->qty;
                    $produc_cart = array(
                        "options" => ['product_owner' => $row->model->product_owner_id, 'shiping_price' => $shiping_data->shiping_coast]
                    );
                    Cart::update($row->rowId, $produc_cart);
                }
            }
        }
        return view('cp.checkout', ['shiping_price' => $shiping_price, 'vendors' => $vendors]);

    }

    //save order
    public function save_cart_items(Request $request, Order_product $order_details)
    {

        $request->pay_type = 'oncash' ;
        try{
        if (isset($request->submit_check) && isset($request->pay_type)) {

            $email = (isset($this->settings['site_email'])) ?   $this->settings['site_email'] : 'no-replay@tsheed.com';
            $user = Auth::user()->toArray();

            // get delivery addresse
            $addesse_data = Users_addresse::where('user_id', Auth::user()->id)->where('active', 'yes')->first();
            if(empty($addesse_data)){
                $request->session()->flash('alert-success', __('حدث خطا الرجاء تحديد العنوان'));
                return back();
            }  

            //get dealers data
            $product_owner_ids = array();
            foreach (Cart::content() as $row) {
                array_push($product_owner_ids, [$row->options->product_owner]);
            }
            //where('level' , 'dealer')->
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

            $mainordershipingprice = 0;
            foreach (Cart::content() as $row) {
                $mainordershipingprice += $row->qty * $row->options->shiping_price;
            }

            //save main order data
//            $parent_order = new Order();
//
//            $parent_order->user_id = Auth::user()->id;
//            $parent_order->product_owner = 1;
//            $parent_order->parent_id = 0;
//            $parent_order->total = round(Cart::total(), 2) + round($mainordershipingprice, 2);
//            $parent_order->tax = Cart::tax();
//            $parent_order->tax_percentage = '5';
//            $parent_order->discount = 0;
//            $parent_order->order_note = $request->checkout_notes;;
//            $parent_order->payment_type = $request->pay_type;
//            $parent_order->order_status = 'in_progress';
//            $parent_order->shiping_price = $mainordershipingprice;
//            $parent_order->addresse_id = $addesse_data->id;
//
//            $parent_order->save();

            //start saving bank transfer type details
            if ($request->pay_type == 'transfer_bank') {

                $transfer_detail = new Transfer_detail();
                $transfer_detail->acount_owner_name = $request->acount_owner_name;
                $transfer_detail->bank_user_number = $request->bank_user_number;
                $transfer_detail->dealer_bank_number = $request->dealer_bank_number;
                $transfer_detail->total_transfer_maney = $request->total_transfer_maney;
                $transfer_detail->bank_name = $request->bank_name;
                $transfer_detail->pay_notes = $request->pay_notes;
                $transfer_detail->user_id = Auth::user()->id;
                $transfer_detail->order_id = $parent_order->id;

                if (!empty($request->file('image'))) {
                    $photo = Storage::putFile('public', $request->file('image'));
                    $transfer_detail->transfer_image = Storage::url($photo);
                }

                $transfer_detail->save();
            }
            //end save payment type transfer

            //end saving parenet order

            //save product order for every different deller
            foreach ($vendor as $key => $user_data) {

                $order = new Order();
                $total = 0;
                $shiping_price = 0;
                $tax_total = 0;
                // $checkout_notes = $request->checkout_notes;
                $order->user_id = Auth::user()->id;
                $order->total = 0;
                $order->parent_id = 1;
                $order->tax = 0;
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
            return redirect('check-out-final/' . $parent_order->id);

        } else {
            return redirect('checkout');
        }
        }catch (Exception $e) {
            $request->session()->flash('alert-success', __('حدث خطا غير متوقع'));
            return back();
        }

        /*return redirect('my-orders');*/
    }

    //function final step after checkout
    public function final_checkout_step($id)
    {
        if( Auth::user()->level === 'admin' || Auth::user()->level === 'dealer'){
            abort('404') ;
        }

        if (is_numeric($id)) {
            $order = Order::find($id);
            if (empty($order)) {
                abort('404');
            }
            return view('cp.finalstep_checkout', ['order' => $order]);
        } else {
            abort('404');
        }
    }

    /**
     * ajax user and dealer functions
     */
    public function add_addresses(Request $request, Users_addresse $users_addresse)
    {

        $validator = Validator::make($request->toArray(), [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ]);
        if (!$validator->fails()) {
            try {

                $region_id = (isset($request->region_id)) ? $request->region_id : 0;
                $users_addresse->user_id = Auth::user()->id;
                $users_addresse->addresse_ar = $request->name_ar;
                $users_addresse->addresse_en = $request->name_en;
                $users_addresse->countrie_id = $request->countrie_id;
                $users_addresse->citie_id = $request->citie_id;
                $users_addresse->region_id = $region_id;
                $users_addresse->active = 'no';
                $users_addresse->save();

                if (isset($request->checkoutpage) && $request->checkoutpage == 1) {
				   $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
                   return back();
                } else {
                    return __('site.add_addresses_success');
                }
            } catch (Exception $e) {
                return __('site.unknow_error_happen');
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    //delete user addresse
    public function delete_user_addresse(Request $request)
    {
        if (isset($request->addresse_id) && $request->addresse_id > 0) {

            $user_addreese = Users_addresse::find(intval($request->addresse_id));
            $user_addreese->delete();;
            return view('cp.useraddreese_in_cart');


        } else {

            return back();
        }
    }

    //active an addresse for user and make another addresse false
    public function active_an_addresse(Request $request)
    {

        if (isset($request->addresse_id) && $request->addresse_id > 0) {

            $user_addreeses = Users_addresse::where('user_id', Auth::user()->id)->get();

            foreach ($user_addreeses as $user_addreese) {

                if ($user_addreese->id == $request->addresse_id) {
                    $value = 'yes';
                } else {
                    $value = 'no';
                }

                DB::table('users_addresses')
                    ->where('id', $user_addreese->id)
                    ->update(array('active' => $value));

            }

            return view('cp.useraddreese_in_cart');

        } else {

            return false;
        }

    }

    //update an addresse
    public function update_addresse(Request $request)
    {
        // return true ;
        if ($request->submit_check == 1) {
            $region_id = (isset($request->region_id)) ? $request->region_id : 0;
            $addresse = Users_addresse::find(intval($request->addresse_id));
            $addresse->user_id = Auth::user()->id;
            $addresse->addresse_ar = $request->name_ar;
            $addresse->addresse_en = $request->name_en;
            $addresse->countrie_id = $request->countrie_id;
            $addresse->citie_id = $request->citie_id;
            $addresse->region_id = $region_id;
            if ($addresse->save()) {
                return view('cp.useraddreese_in_cart');
            } else {
                return __('site.unknow_error_happen');
            }

        } else {
            $addresse = Users_addresse::find(intval($request->addresse_id));
            return view('cp.addresse_update_model', compact('addresse'));
        }

    }

    //destroy cart
    public function add_shiping()
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $countries = Countrie::all();
        $shipings = Shiping::where('user_id', Auth::user()->id)->get();
        return view('cp.add_shiping', compact('countries', 'shipings'));
    }

    // add vendor shiping data
    public function add_shiping_data(Request $request, Shiping $shiping)
    {
        $this->validate($request, [
            'countrie_id' => 'required',
        ]);

        if (!empty($request->citie_ids)) {
            $shiping = Shiping::where('user_id', Auth::user()->id)->get();

            $data = array();

            if (count($shiping) == 0) {

                foreach ($request->citie_ids as $key => $city) {
                    array_push($data, [
                        'user_id' => Auth::user()->id,
                        'countrie_id' => $request->countrie_id,
                        'citie_id' => $city,
                        'shiping_coast' => $request->shiping_coast[$key],
                        'h_w_for_shiping_coast' => $request->h_w_for_shiping_coast[$key],
                        'coast_per_k_after_h_w' => $request->coast_per_k_after_h_w[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                }
                $shiping->insert($data);
                $request->session()->flash('alert-success', __('admin.alerts_success_adding'));

            } else {

                foreach ($request->citie_ids as $key => $city) {

                    Shiping::updateOrCreate(
                        [
                            'user_id' => Auth::user()->id,
                            'countrie_id' => $request->countrie_id,
                            'citie_id' => $city,
                        ],
                        [
                            'shiping_coast' => intval($request->shiping_coast[$key]),
                            'h_w_for_shiping_coast' => $request->h_w_for_shiping_coast[$key],
                            'coast_per_k_after_h_w' => $request->coast_per_k_after_h_w[$key],
                            'updated_at' => Carbon::now(),
                        ]
                    );
                }
                $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
            }
        }
        return back();

    }

    //dealer orders
    public function dealerOrders()
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $in_progress_orders = Order::orderBY('id','desc')->where('parent_id' , '!=' , 0 )->where('product_owner', Auth::user()->id)->get();
        $another_orders = Order::orderBY('id','desc')->where('parent_id' , '!=' , 0 )->where('product_owner', Auth::user()->id)->get();
        return view('cp.dealer_order', ['another_orders' => $another_orders, 'in_progress_orders' => $in_progress_orders]);
    }
    // update order dealer status or remove it from parent order
    public function showOrderForupdatedealer($id)
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
		//$siteprofit = Siteprofit::where()->
        $order_details = Order::orderBY('id','desc')->where('product_owner', Auth::user()->id)->where('id', $id)->first();
        if (empty($order_details)) {
            abort('404');
        }
        return view('cp.orderDetailsDealer', ['order' => $order_details]);
    }
    public function updateDealerOrder($id, Request $request , Siteprofit $siteprofit )
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $this->validate($request, [
            'order_status' => 'required|string',
        ]);

        $order = Order::find($id);

        if(empty($order)){
            redirect('/404') ;
        }
		if(isset($this->settings['sitetax']) && !empty($this->settings['sitetax'])){
		$sitetax = 	$this->settings['sitetax'] ;
		}
        // $sitetax =   (isset($this->settings['sitetax'])) ? $this->settings['sitetax'] :  0 ;
        $order->order_status = $request->order_status;
        $order->save();
        $user = User::find($order->user_id);
        $user_email = $user->email;
        $user_name = $user->name;
        $status = $request->order_status;
        $dealer_data = Auth::user()->toArray();
        //send email
        Mail::send('emails.product', $dealer_data, function ($m) use ($user_email, $user_name, $status, $dealer_data) {
            $m->from($dealer_data['email'], $dealer_data['name']);
            $m->to($user_email, $user_name)->subject($status . 'تم تغير حاله الطلب الخاصه بكم ');
        });
        $request->session()->flash('alert-success', 'تم تغير حاله الطلب وارسال رساله الى المشترى');

        if ($order->order_status == 'delevried') {
            if($order->order_status == 'delevried'){
                //$sitePercentage = $this->settings['sitetax'] ;
                //$siteprofitmonaey = (( (intval($order->total)) - intval($order->tax) ) * intval(Auth::user()->sitepercentage ) )/ 100 ;
                $siteprofitmonaey = (( $order->total - $order->tax ) *  $sitetax )/ 100 ;

                $siteprofit->user_id =  $order->product_owner ;
                $siteprofit->order_id =  $order->id;
                $siteprofit->total =  $order->total ;
                $siteprofit->parent_order_id = $order->parent_id	 ;
                $siteprofit->site_percentage =   $sitetax  ;
                $siteprofit->site_profit =  $siteprofitmonaey  ;
                $siteprofit->status =  0;
                $siteprofit->save();

            }
            $request->session()->flash('alert-success', 'تم تغير حاله الطلب');
            return back();
        }
        return back();
    }
    //edit order
    public function editOrder($id)
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $order_details = Order::orderBY('id','desc')->where('product_owner', Auth::user()->id)->where('id', $id)->first();
        if (empty($order_details)) {
            abort('404');
        }
        return view('cp.order_details', ['order' => $order_details]);
    }
    public function clientOrder($id)
    {
        if (Auth::user()->level != 'user') {
            return redirect('/');
        }
        $order_details = Order::where('user_id', Auth::user()->id)->where('parent_id', 0 )->where('id', $id)->first();
        if (empty($order_details)) {
            abort('404');
        }
        return view('cp.order_details', ['order' => $order_details]);
    }
    public function orderSearch(Request $request)
    {

     $from_date = (isset($request->from_date)) ? $request->from_date : 0 ;
     $to_date = (isset($request->to_date)) ? $request->to_date : 0 ;
     $order_status = (isset($request->order_status)) ? $request->order_status : 0 ;  //dd($order_status) ;
     $where = array() ;

     if(isset($request->from_date) ){
         array_push($where , ['created_at' , '>' , $request->from_date]) ;
     }
     if(isset($request->to_date)){
         array_push($where , ['created_at' , '<' , $request->to_date]) ;
     }
     if(isset($request->order_status) ){
         array_push($where , ['order_status' , '=' , $request->order_status]) ;
     }
  //  dd($where) ;
     $url = url('/').'/search-order?from_date='.$from_date.'&to_date='.$to_date.'&order_status='.$order_status ;

     $orders = Order::orderby('id' , 'desc')->where('user_id' , Auth::user()->id)->where('parent_id' , 0)->where('deleted_at' , null )->where($where)->paginate(6) ;
     $orders->setPath($url);

     return view('cp.myorders' , ['orders' => $orders]);

    }
    public function updateCleintOrder(Request $request)
    {
        if(isset($request->order_id)){
            $order = Order::find($request->order_id) ;
            if(empty($order)){
                redirect('/404') ;
            }
                if(!empty($order)){
                    if(isset($request->addresse_id)){
                     $order->addresse_id = $request->addresse_id ;
                    }
                    if(isset($request->order_status)){
                     $order->order_status = $request->order_status ;
                    }
                    if($order->save()){
                        //send email
                        foreach ($order->has_orders as $order_details) {
                            if(!empty($order_details)){
                            $order_data = Order::find($order_details->id);
                            if (!empty($order_data)) {
                                if (isset($request->addresse_id)) {
                                    $order_data->addresse_id = $request->addresse_id;
                                }
                                if (isset($request->order_status)) {
                                    $order_data->order_status = $request->order_status;
                                }
                            }
                            if ($order_data->save()) {
                                $user = $order_details->dealer->toArray();
                                $user_email = Auth::user()->email;
                                $user_name = Auth::user()->name;
                                Mail::send('emails.product', $user, function ($m) use ($user_email, $user_name, $user) {
                                    $m->from($user_email, $user_name);
                                    $m->to($user['email'], $user['name'])->subject('تم بيانات فى الطلب الخاص بكم  ');
                                });
                            } else {
                                $request->session()->flash('alert-error', 'فشلت العمليه');
                            }
                          }
                        }
                        $request->session()->flash('alert-success', 'تم حفظ البيانات بنجاح');
                    }else{
                        $request->session()->flash('alert-error', 'فشلت العمليه');
                    }
                    return back();
                }else{
                    $request->session()->flash('alert-error', 'فشلت العمليه');
                }
        }else{
            $request->session()->flash('alert-error', 'فشلت العمليه');
        }
    }

    public function editOrderData($id, Request $request , Siteprofit $siteprofit )
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $this->validate($request, [
            'order_status' => 'required|string',
        ]);

        $order = Order::find($id);
        if(empty($order)){
            redirect('/404') ;
        }
        if ($order->order_status == 'delevried') {
          /*  if($order->order_status == 'delevried'){
                $sitePercentage = $order->dealer->sitepercentage ;
                    $siteprofitmonaey = (( (intval($order->total)) - intval($order->tax) ) * $order->dealer->sitepercetage )/ 100 ;
                        $siteprofit->user_id =  $order->product_owner ;
                        $siteprofit->order_id =  $order->id;
                        $siteprofit->total =  $order->total ;
                        $siteprofit->parent_order_id = $order->parent_id	 ;
                        $siteprofit->site_percentage =  $order->dealer->sitepercetage;
                        $siteprofit->site_profit =  $order ;
                        $siteprofit->status =  0;
                        $siteprofit->save();

            }*/
            $request->session()->flash('alert-success', 'تم توصيل الطلب لى اى تعديل الرجاء التواصل مع الاداره');
            return back();
        }
        $order->order_status = $request->order_status;
        $order->save();
        $user = User::find($order->user_id);
        $user_email = $user->email;
        $user_name = $user->name;
        $status = $request->order_status;
        $dealer_data = Auth::user()->toArray();
        //send email
        Mail::send('emails.product', $dealer_data, function ($m) use ($user_email, $user_name, $status, $dealer_data) {
            $m->from($dealer_data['email'], $dealer_data['name']);
            $m->to($user_email, $user_name)->subject($status . 'تم تغير حاله الطلب الخاصه بكم ');
        });
        $request->session()->flash('alert-success', 'تم تغير حاله الطلب وارسال رساله الى المشترى');
        return back();
    }

    //dealer cupons
    public function dealerCupons()
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $cupons = Cupon::where('user_id', Auth::user()->id)->get();
        return view('cp.dealer_cupons', ['cupons' => $cupons]);

    }

    public function addCupons()
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $products = Product::where('active', 'yes')->where('product_owner_id', Auth::user()->id)->where('quantity', '>', 0)->get();
        //dd($products) ;
        return view('cp.dealer_add_cupon', ['products' => $products]);
    }

    public function saveCupon(Request $request, Cupon $cupon)
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }

        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $cupon->start_date = $request->start_date;
        $cupon->end_date = $request->end_date;
        $cupon->user_id = Auth::user()->id;
        $cupon->product_id = $request->product_id;
        $cupon->discount_percentage = $request->discount_percentage;
        $cupon->discount_monay = $request->discount_monay;
        $cupon->active = $request->active;
        $cupon->cupon_code = time();

        $cupon->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }

    public function editCupon($id)
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $cupon = Cupon::find($id);
        $products = Product::where('active', 'yes')->where('product_owner_id', Auth::user()->id)->where('quantity', '>', 0)->get();
        return view('cp.dealer_edit_cupon', ['cupon' => $cupon, 'products' => $products]);
    }

    public function saveEditCupon(Request $request, $id)
    {
        if (Auth::user()->level != 'dealer') {
            return redirect('/');
        }
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $cupon = Cupon::find($id);

        $cupon->start_date = $request->start_date;
        $cupon->end_date = $request->end_date;
        $cupon->user_id = Auth::user()->id;
        $cupon->product_id = $request->product_id;
        $cupon->discount_percentage = $request->discount_percentage;
        $cupon->discount_monay = $request->discount_monay;
        $cupon->active = $request->active;
        $cupon->cupon_code = time();

        $cupon->save();

        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        return back();
    }

    //send message
    public function sendDellerMessage(Message $message, Request $request)
    {
        if (isset($request->message)) {
            $conversation = Conversation::where('by', Auth::user()->id)->where('with', $request->dealer_id)->first();
            if (empty($conversation)) {
                $conversation = Conversation::where('by', $request->dealer_id)->where('with', Auth::user()->id)->first();
            }
            if (!empty($conversation) || $conversation != null || count($conversation) != 0) {
                $message->conversation_id = $conversation->id;
                $message->message_from = Auth::user()->id;
                $message->message_to = $request->dealer_id;
                $message->details = $request->message;

            } else {
                $conversation = new Conversation();
                $conversation->by = Auth::user()->id;
                $conversation->with = $request->dealer_id;
                $conversation->save();
                $message->conversation_id = $conversation->id;
                $message->message_from = Auth::user()->id;
                $message->message_to = $request->dealer_id;
                $message->details = $request->message;
            }
            $message->save();
            //send dealer  email with new message
            $user = User::find($request->dealer_id);
            $user_email = $user->email;
            $user_name = $user->name;
            $message = $request->message;
            $user_data = Auth::user()->toArray();
            //send email
            Mail::send('emails.product', $user_data, function ($m) use ($user_email, $user_name, $message, $user_data) {
                $m->from($user_data['email'], $user_data['name']);
                $m->to($user_email, $user_name)->subject($message . 'تم ارسال رساله جديده');
            });
            // $noty = User::find($request->conversation_with);
            //$noty->notify(new MessagesNotes($message));
            return 1;
            //  return true ;
        } else {
            return 0;
        }
    }

    public function sendRate(Request $request, Review $rating)
    {
		if($request->type == 2 ){
		$review_data = Review::where('user_id' ,  Auth::user()->id)->where('reviewable_id' , $request->user)->first() ;
        if(!empty($review_data)){
            $review_data->user_id = Auth::user()->id;
            $review_data->reviewable_id = $request->user;
            $review_data->reviewable_type = 'App\User';
            $review_data->rating = $request->rating;
            $review_data->comment = 'dd';
            $review_data->save() ;
            return __('site.rating_updated_well') ;

        } else{
            $rating->user_id = Auth::user()->id;
            $rating->reviewable_id = $request->user ;
            $rating->reviewable_type = 'App\User';
            $rating->rating = $request->rating;
            $rating->comment = 'dd';
            $rating->save() ;
            return __('site.rating_added_well') ;
        }	
		}else{
        $review_data = Review::where('user_id' ,  Auth::user()->id)->where('reviewable_id' , $request->product_id)->first() ;
        if(!empty($review_data)){
            $review_data->user_id = Auth::user()->id;
            $review_data->reviewable_id = $request->product_id;
            $review_data->reviewable_type = 'App\Product';
            $review_data->rating = $request->rating;
            $review_data->comment = $request->comment;
            $review_data->save() ;
            return __('site.rating_updated_well') ;

        } else{
            $rating->user_id = Auth::user()->id;
            $rating->reviewable_id = $request->product_id;
            $rating->reviewable_type = 'App\Product';
            $rating->rating = $request->rating;
            $rating->comment = $request->comment;
            $rating->save() ;
            return __('site.rating_added_well') ;
        }
		}

    }
    //use cupon
    public function checkCuponValid(Request $request)
    {

        $cupon = Cupon::where('end_date','<=',date("Y-m-d") )->where('active' , 'yes')->where('deleted_at' , null )->where('cupon_code' , $request->cupon)->first() ;

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
        if(Auth::user()){
            $shiping_price = 0 ;

            $user_addresse = Users_addresse::where('user_id' , Auth::user()->id )->where('active' , 'yes' )->first() ;
            $cupon = Cupon::where('end_date','<=',date("Y-m-d") )->where('active' , 'yes')->where('deleted_at' , null )->where('cupon_code' , $request->cupon)->first() ;

            foreach(Cart::content() as $row ) {
                $product_data = Product::where('id', $row->id)->first();
                $shiping_data = Shiping::where('user_id', $product_data->product_owner_id)->where('citie_id', $user_addresse->citie_id)->first();
                if (!empty($shiping_data)) {
                    $shiping_price += $shiping_data->shiping_coast * $row->qty;
                }
                //
                if ($row->options->cupon_code > 0){ //this mean use only one cupon

                    $product_price = ($row->price - (($row->price * $cupon->discount_percentage) / 100));
                    $final_commission = $row->price - $product_price ;
                    if($cupon->discount_monay > 0 ){
                        if($product_price > $cupon->discount_monay){
                            $product_price = $row->price  -  $cupon->discount_monay ;
                        }
                    }

                    if (!empty($cupon->product_id) && $cupon->product_id != 0) {
                        if ($row->id == $cupon->product_id) {

                            $produc_cart = array(
                                'price' => $product_price ,
                                "options" => ['product_owner' => $row->model->product_owner_id, 'cupon_code' => $cupon->cupon_code]
                            );
                        }
                    } else {

                        $produc_cart = array(
                            'price' => $product_price ,
                            "options" => ['product_owner' => $row->model->product_owner_id, 'cupon_code' => $cupon->cupon_code]
                        );
                    }

               }

                Cart::update($row->rowId, $produc_cart);
                //
            }
            //get cupon data
            //$cupon = Cupon::where('active' , 'yes')->where('deleted_at' , null )->where('id' , $request->cupon)->first() ;
            //end cupon function

            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price] ) ;
        }else{
            return view('cp.cart_ajax' , ['shiping_price' => $shiping_price]) ;
        }
    }

}
