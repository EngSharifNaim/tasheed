@extends('layouts.app')
@section('page_title')
    @if(Lang::locale() == "ar"){{ $product->name_ar }} @else {{ $product->name_en }} @endif
@stop
@section('header_style')
    <style>
        .magnify-mobile ,  .alert {
            position: fixed !important ;
            top:0px;
            float: left;
            z-index:2;

        }
    </style>
@stop 
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        @if(!empty($product->mainsection)  ) <li><a href="{{ url('/main-section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $product->mainsection->name_ar) }}@else {{ str_replace(' ', '_', $product->mainsection->name_en) }} @endif/{{$product->mainsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $product->mainsection->name_ar }}@else{{ $product->mainsection->name_en }} @endif <i class="fas fa-angle-left"></i>  </a></li>@endif
                        @if(!empty($product->subsection) ) <li><a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $product->mainsection->name_ar) }}/{{ str_replace(' ', '_', $product->subsection->name_ar) }}@else{{ str_replace(' ', '_', $product->mainsection->name_en) }}{{ str_replace(' ', '_', $product->subsection->name_en) }} @endif/{{$product->subsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $product->subsection->name_ar }}@else{{ $product->subsection->name_en }} @endif <i class="fas fa-angle-left"></i>  </a></li>@endif
                        @if(isset($product->subsubsection->id)   ) <li><a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $product->mainsection->name_ar) }}/{{ str_replace(' ', '_', $product->subsection->name_ar) }}/{{ str_replace(' ', '_', $product->subsubsection->name_ar) }}@else{{ str_replace(' ', '_', $product->mainsection->name_en) }}/{{ str_replace(' ', '_', $product->subsection->name_en) }}/{{ str_replace(' ', '_', $product->subsubsection->name_en) }}@endif/{{$product->subsubsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $product->subsubsection->name_ar }}@else{{ $product->subsubsection->name_en }} @endif <i class="fas fa-angle-left"></i>  </a></li>@endif
                        <li><a class="active"> @if(Lang::locale() == "ar"){{ $product->name_ar }} @else {{ $product->name_en }} @endif </a></li>
                    </ul>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <h1>@if(Lang::locale() == "ar"){{ $product->name_ar }} @else {{ $product->name_en }} @endif</h1>
        <div class="row">
            <div class="col-lg-9 ">
                <div class=" row">
                    
                    
                    <div class="showm" >
                        	<div class="container">
    <section class="lazy slider " id="most_views_productsx" style="margin-top:30px;">
                        @if(!empty($product->image))
                            <div>                             
                                <img  style="width:100% ; height:100%;" src="{{ URL::to('/public') }}{{ $product->image }}" class="img-fluid magnify-image"   />                                
                             </div>
                            @endif
                             @if (!empty($product->images))
                                      @foreach( explode(",",$product->images ) as $key=>$image )                                      
                                      
                                      <div>                            
											<img  style="width:100% ; height:100%;" src="{{ URL::to('public') }}{{ $image }}" class="img-fluid magnify-image"   />
									 </div>
                             
                             
                                    
                                      @endforeach
                                    @endif
                            
                            
                            
                      
                        
                        
                    </section>
                    </div>
                    </div>
                    <div class="col-lg-2 col-sm-3 hidem">
                        <a id="scrollUp" href="#"><i class="arrows-slider1 fas fa-angle-double-up"></i></a>
                        <div id="wrapper" >
                            <div id="content" >
                                <ul class=" nav nav-tabs  flex-column">
                                    @if(empty($product->image))
                                    <li class="thumb active"><a class="thumb-view" data-target="#pic-1" data-toggle="tab"><img style="width:63px ; height:63px ;" src="{{ URL::to('/public') }}{{$product->image}}" class="img-fluid" /></a></li>
                                    @endif
                                    @if (!empty($product->images))
                                      @foreach( explode(",",$product->images ) as $key=>$image )
                                        <li class="thumb"><a class="thumb-view" data-target="#pic-{{ $key +1  }}" data-toggle="tab"><img src="{{ URL::to('public') }}{{ $image }}" class="img-fluid" /></a></li>
                                      @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <a id="scrollDown" href="#"><i class="arrows-slider1 fas fa-angle-double-down"></i></a>
                    </div><!--end product images slider---->
                    <div class="preview col-md-5 col-sm-8 hidem" style="padding-top:40px;">
                        <div class="preview-pic tab-content">
                            @if(!empty($product->image))
                            <?php  $sale_percentage =  round((( $product->price - $product->min_price ) / $product->price ) * 100 , 2 )   ; ?>
                            <div class="tab-pane active" id="pic-1">
                                <img  style="width:100% ; height:100%;" src="{{ URL::to('/public') }}{{ $product->image }}" class="img-fluid magnify-image" data-magnify-src="{{ URL::to('/public') }}{{ $product->image }}" />
                               @if($sale_percentage > 0 )
                                <div class="triangle1">
                                    <span class="offer">{{ __('site.descount') }} {{ $sale_percentage  }}%</span>
                                </div>
                               @endif
                            </div>
                            @endif
                            @if (!empty($product->images))
                                    @foreach( explode(",",$product->images ) as $key=>$image )
                                        <div class="tab-pane" id="pic-{{ $key +1  }}">
                                            <img  style="width:326.25px ; height:325.31px ;" src="{{ URL::to('/public') }}{{ $image }}" class="img-fluid magnify-image" data-magnify-src="{{ URL::to('/public') }}{{ $image }}" />
                                            @if($sale_percentage > 0 )
                                                <div class="triangle1">
                                                    <span class="offer">{{ __('site.descount') }} {{ $sale_percentage  }}%</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="details col-md-5">
                        @if(!empty($product->brands))<p class="brand-name-product"><a href="{{ url('/brand') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->brands->name_ar) }}@else{{$product->brands->name_en}}@endif/{{$product->brands->id}}" >@if(Lang::locale() == 'ar') {{ $product->brands->name_ar }} @else {{ $product->brands->name_en }} @endif</a></p>  @endif
                      <!--   <p>@if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</p> -->
                            <div class="margin-mince">
                            <p class="become-provider">  <a class="link-color" href="{{url('/register-dealer')}}"> {{__('site.do_want_pay_on_snood')}}</a></p>
                            @if(!empty($product->countries_products) )
                            <p class="madein">{{__('admin.country_manfature')}} : @if(Lang::locale() == 'ar') {{$product->countries_products->name_ar}} @else {{$product->countries_products->name_en }} @endif</p>
                            @endif
                                <p class="madein">{{ __('site.seller') }} : <span><a href="{{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}">{{ $product->user->name }}</a></span> </p>

                            </div>
                        <hr>
                        <div class="rating">
							<div class="row">
								<div class="col-6"><div class="stars2">
                                 @if(count($product->reviews) > 0 )
                                   @for($i = 0 ; $i < ($product->reviews->sum('rating')/count($product->reviews)); $i++ )
                                     <span class="fa fa-star @if($i+1 < ($product->reviews->sum('rating')/count($product->reviews)) )checked @endif"></span>
                                   @endfor
                                 @endif 
                                <span class="review-no">المشاهدات : {{ $product->views }} </span>
                            </div></div>
								<div class="col-6">
								<div class="social-share">
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
								</div>
							</div>                            
                        </div>
                            @if(Lang::locale() == 'ar')
                                @if(!empty($product->details_ar))
                                    <h5>{{ __('site.detailss') }}</h5>
                                @endif
                                @foreach(explode(",",$product->details_ar ) as $key=>$detail_ar )
                                    @if($key==3) @break @endif
                                    <p class="product-description"> <i class="fas fa-angle-double-left"></i>{{ $detail_ar }}</p>
                                @endforeach
                            @else
                                @if(!empty($product->details_en))
                                    <h5>{{ __('site.detailss') }}</h5>
                                @endif
                                @foreach(explode(",",$product->details_en ) as $key=>$detail_en )
                                    @if($key==3) @break @endif
                                    <p class="product-description"> <i class="fas fa-angle-double-left"></i> {{ $detail_en }}</p>
                                @endforeach
                            @endif
                        @if($product->min_price )
                        <h5 class="price-product">{{ $product->min_price }} <span>{{ __('site.sr_soudi') }}</span></h5>
                        <p class="old-price">{{ $product->price }}</p>
                        @else
                        <p class="old-price">{{ $product->price }}</p>
                        @endif
                            <p class="store-quantity">{{ __('site.availeable') }} : {{ $product->quantity }} {{__('site.peace')}}</p>
                            <ul class="list-inline">
								<li class="list-inline-item">
								<button style="margin: 0;" name="addtofavourite" value="{{ $product->id }}" class="add-to-cart btn btn-default product_favourite save-for-later" id="ShowButton">
                                    @if(!empty($favourite_product_flag)  )
                                         @if($favourite_product_flag->favourite == 'yes')
                                            {{ __('site.delete_from_favourite') }}
                                         @else
                                           {{ __('site.add_to_favourite') }}
                                         @endif
                                    @else
                                        {{ __('site.add_to_favourite') }}
                                    @endif
								</button>
								</li>
								<li class="list-inline-item">
								                            <button value="{{ $product->id }}" class="add-to-cart btn btn-default cartitems" type="button">{{ __('site.buy_now') }}</button>
</li>
						</ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shipping-info">
                    <p class="shipping"> <img src="{{ URL::to('public') }}{{theme_url('images/ship-icon.png')}}"> {{ __('site.ship_3_7_day') }}</p>
                    <p class="return"> <img src="{{ URL::to('public') }}{{theme_url('images/return.png')}}" > {{ __('site.refound_in_14_day') }} </p>
                    <p class="shipping"> <img src="{{ URL::to('public') }}{{theme_url('images/original-icon.png')}}" > {{ __('site.original_product') }}</p>
                </div>
               
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 ">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span>
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li   class="active "><a href="#tab1" data-toggle="tab"  >{{ __('site.product_details') }}</a></li>
                                    <li ><a href="#tab2" data-toggle="tab">{{ __('site.ratings') }}</a></li>
                                    <li><a href="#tab3" data-toggle="tab">{{ __('site.refound_systemes') }}</a></li>
                                    <li><a href="#tab4" data-toggle="tab">{{ __('site.detailss') }}</a></li>
                                </ul>
                            </span>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <p class="text-inner">
                                        @if(Lang::locale() == 'ar')
                                            {!!  $product->description_ar !!}
                                        @else
                                            {!! $product->description_en !!}
                                        @endif
                                    </p>
                                </div>
                                <div class="tab-pane " id="tab2">
                                    <div class="row justify-content-center">
                                  
                                      
                                        @if( Auth::user()  )
                                        @if( Auth::user()->level =='user'  )
                                        <div class="col-lg-5">
                                                <form method="post" action="{{url('/send-rate')}}" name="send-rate" id="sendrate" >
                                        @endif
                                          @if(empty($product->getUserRating))  <p class="ask-rating">هل تريد التقيم ؟</p> @endif
                                                    {{ csrf_field() }}
                                            <div  class="stars4">
                                                <fieldset class="rating">
												<select name="rating" required="true" style="width:100px" >
													  <option name="1" > 1 </option>
													  <option name="3" > 2 </option>
													  <option name="3" > 3 </option>
													  <option name="4" > 4 </option>
													  <option name="5" > 5 </option>
													</select>
                                                  </fieldset>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <textarea name="comment" required="true"  class="review-no4" placeholder = "وصف " > @if(!empty($review_data)) {{ $review_data->comment }}  @endif</textarea>
                                            </div>
                                           <div class="action rate-now" style="margin-top:-8px;">
                                                <button  @if(Auth::user()) type="submit" @else onclick="myFunction()" @endif  class="add-to-cart rate-now-btn btn btn-default">@if( !empty($review_data)) تعديل التقيم @else  اكتب التقيم @endif</button>
                                            </div>
                                            @if(Auth::user())
                                        </form>
                                        </div>
                                            @endif
                                            @endif
                                    </div>
                                    @if(count($product->reviews) > 0 )
                                    <h3 class="comment-head">{{ __('site.allcomments') }}</h3>
                                    <hr>
                                    @foreach($product->reviews as $review)
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h3 class="comment-head">{{ $review->user->name  }}</h3>
                                            </div>
                                            <div class="row col-lg-4">
                                                <div  class="stars3">
                                                    @for($i = 0 ; $i < $review->rating ; $i++)
                                                        <span  class="fa fa-star @if($i <  $review->rating  )checked @endif"></span>
                                                    @endfor
                                                        </br>
                                                </div>
                                                <p class="comment-user">{{ $review->comment  }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab3">
                                   <p class="text-inner"> @if(Lang::locale() == 'ar')  @if(isset($settings['refound_systemes_ar'])){{ $settings['refound_systemes_ar'] }} @endif @else  @if(isset($settings['refound_systemes_en'])){{ $settings['refound_systemes_en'] }} @endif  @endif </p>
                                </div>
                                    <div class="tab-pane" id="tab4">
                                    @if(!empty($product->details_ar))
                                    @if(Lang::locale() == 'ar')
                                        @foreach(explode(",",$product->details_ar ) as $key=>$detail_ar )
                                            <p class=""> <i class="fas fa-angle-double-left"></i>{{ $detail_ar }}</p>
                                        @endforeach
                                    @else
                                        @foreach(explode(",",$product->details_en ) as $key=>$detail_en )
                                                <p class="product-description"> <i class="fas fa-angle-double-left"></i> {{ $detail_en }}</p>
                                        @endforeach
                                    @endif
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div></div>

           
        </div>
    </div>
    <<div class="container" style="padding-bottom:20px">
        
         <div class="col-lg-12">
                <div class="last-dfg-header">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-5">
                            <h2 class="top-header-last-viewed1 ">{{ __('site.simillar_products') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    	<div class="container">
    <section class="lazy slider " id="most_views_products">
        @foreach($similar_products as $productt )
            <div class="">
                
                  <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
				<a href="#" >
                   <img src="{{ URL::to('public') }}{{ $productt->image }}">
				</a>
				<figcaption>
					
                    <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $productt->id }}">
                            {{ __('site.fast_show') }}
                        </button>
                </figcaption>
            </figure>
            
            
                <div class="pro-info">
                    <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $productt->name_ar) }}@else{{ str_replace(' ', '_', $productt->name_ar) }} @endif/{{$productt->id}}" > @if(Lang::locale() == 'ar') {{ $productt->name_ar }} @else {{ $productt->name_en }} @endif</a> </h5>
                     <p>@if(Lang::locale() == 'ar') {!! nl2br(str_limit(trim(strip_tags($productt->description_ar)), $limit = 78, $end = '  ')) !!} @else {!! nl2br(str_limit(trim(strip_tags($productt->description_en)), $limit = 80, $end = '  ')) !!} @endif</p>





<p class="mprice">@if($productt->min_price > 0 && $productt->min_price < $productt->price ) <span class="old-price" style="font-size : 14px ;"> {{ $productt->price }}</span>     <span class="offer-non-sale">{{ $productt->min_price }} </span> @else  <span class="offer-non-sale">{{ $productt->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

            @if(count($productt->reviews) > 0 )
                    @for($i = 0 ; $i < 5 ; $i++ )
                        <span class="fa fa-star @if($i+1 < ($productt->reviews->sum('rating')/count($productt->reviews)) )checked @endif"></span>
                    @endfor
                 @else 
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        
                        @endif
               <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if(!empty($productt->user)){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $productt->user->name ) }}/{{$productt->user->id}}@endif">@if($productt->user) {{ $productt->user->name }} @endif</a></span> </p>
               
                         <span style="font-size: 12px;">المشاهدات :@if($productt->views > 0 )  {{ $productt->views }} @else 0 @endif</span>
                         

                    
                    
                    
                    
                    
                    
                </div>
                <div class="cart-btn">
                    <a href="javascript:void(0)" value="{{ $productt->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                </div>
            </div>
        @endforeach
    </section>
    </div>
   </br>
@stop
@section('page_scribt')
<script type="text/javascript">
    function myFunction() {
        $.bootstrapGrowl('{{ __('site.you_cant_rate') }} ',{
            type: 'danger',
            delay: 2000,
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
            width: 500, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 ,// spacing between consecutively stacked growls.
            //  position: absolute

        });
    }
    $(document.body).on('click', "button[name=addtofavourite]", function (event) {
                @if( Auth::user() )
        var product_value = $(this).val();
        $.post("{{url('product-favourite')}}", {product:product_value})
            .done(function (data) {
                if(data.button_name){// alert(data.button_name) ;
                    document.getElementById('ShowButton').innerText = data.button_name ;
                }
               // $(this).innerHTML = 'ff';
                //alert(data.success) ;
                $.bootstrapGrowl(data.success,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 500, // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                    //  position: absolute

                });
            });
        @else
      //  alert('{{ __('site.you_must_login_add_product_favourite') }} ') ;
        $.bootstrapGrowl('{{ __('site.you_must_login_add_product_favourite') }} ',{
            type: 'danger',
            delay: 2000,
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
            width: 500, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 ,// spacing between consecutively stacked growls.
            //  position: absolute

        });
        @endif
    });
  $(document).ready(function () {

      //cart  cart_notf

      //load product model data
       @if(Auth::user())
		   @if(Auth::user()->level == 'user')
      $("#sendrate").ajaxForm({
          success: function (response) { 
              // alert(response);
              $.bootstrapGrowl(response,{
                  type: 'success',
                  delay: 2000,
                  offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                  align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                  width: 500, // (integer, or 'auto')
                  delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                  allow_dismiss: true, // If true then will display a cross to close the popup.
                  stackup_spacing: 10 ,
              });
          },
          error: function (error) {
              //  alert() ;
              $.bootstrapGrowl(error,{
                  type: 'danger',
                  delay: 2000,
                  offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                  align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                  width: 500, // (integer, or 'auto')
                  delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                  allow_dismiss: true, // If true then will display a cross to close the popup.
                  stackup_spacing: 10 ,
              });
          }
      });
	 
		@endif
		
		  @endif

  });
    </script>
@stop

@section('page_plugins')
    <!-- <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5b2f6cbf5a9f7800116e2d0f&product=sticky-share-buttons' async='async'></script> -->
@stop