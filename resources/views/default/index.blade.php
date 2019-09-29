@extends('layouts.app')
@section('page_title')
    {{ __('site.home_page') }}
@stop
@section('header_style')
    <style>
        .magnify-mobile ,  .alert {
            position: fixed !important ;
            top:0px;
            float: left;
            z-index:2;
        }
.carousel-fade .carousel-inner .carousel-item {
  transition-property: opacity;
}
.carousel-fade .carousel-inner .carousel-item,
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  opacity: 0.8;
}
.carousel-fade .carousel-inner .active,
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}
.carousel-fade .carousel-inner .next,
.carousel-fade .carousel-inner .prev,
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  transform: translate3d(0, 0, 0);
}


    </style>
@stop

@section('content')
    <!--start sidenav menu -->
    <div class="main-home">    
    <!---start slider -------------------img-slide-------->
                <div class="">
                    <div id="carouselExampleControls" class="carousel-fade carousel slide fixed-size" data-ride="carousel">
                        <ol class="carousel-indicators">
							@php $i=0 @endphp
							@foreach($sliders as $key=>$slide )
							<li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
							@php $i++ @endphp
							@endforeach
						</ol>        
                        <div class="carousel-inner" role="listbox">
                            @foreach($sliders as $key=>$slide )
                            <div class="carousel-item @if($key == 0 ) active @endif ">
                                <img class="img-fluid " style="width:100%;" src="{{ URL::to('public') }}{{ $slide->photo }}" alt="@if(Lang::locale() == "ar") {{ $slide->name_ar }} @else  {{ $slide->name_en }} @endif">
                                <div class="carousel-caption ">
									<button class="btn btn-1 btn-default">@if(Lang::locale() == "ar") {{ $slide->name_ar }} @else  {{ $slide->name_en }} @endif    </button>
									@if(Lang::locale() == "ar" && !empty($slide->description_ar))  <b class="btn btn-2 btn-default text-right">{!! $slide->description_ar !!}  </b>@endif
									@if(Lang::locale() == "en" && !empty($slide->description_en)) <b class="btn btn-2 btn-default text-right">{!! $slide->description_en !!}   </b>@endif
								   @if(!empty($slide->link))  <a href="{{ $slide->link }}" class="btn btn-3 btn-default">{{ __('site.discove_more') }}</a> @endif
								</div>                
                           </div>
                            @endforeach
                        </div>
                        @if(count($sliders) > 1 )
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('site.Previous') }}</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('site.Next') }}</span>
                        </a>
                        @endif
                    </div>
                </div>
    </div>
    <!--End sidenav menu -->
    <!--Start Last  product slider 1  
    <!--Start banner 2  up last products  -->
    @if( count($adverstisment2_up_last_products) > 0 )
    <div class="container" style="margin-top:20px;">
        <div class="banner">
            @foreach($adverstisment2_up_last_products as $ads2)
             @if($ads2->link)
                    <a href="{{ $ads2->link  }}">  <img src="{{ URL::to('public') }}{{ $ads->image }}" class="img-fluid" ></a>
                @else
               <img src="{{ URL::to('public') }}{{ $ads2->image }}" class="img-fluid" >
                @endif
            @endforeach
        </div>
    </div>
    @endif
    <!--end banner 2 -->
    <!--Start new product slider -->
    <!---not done yes ----->
    <div class="container">
        <div class="slide-header">
            <div class="row col-lg-9 ">
                <h2 class="slider-title">{{ __('site.last_entered_products') }}</h2>
                <ul class="slider-nav">
                    @foreach($main_sections as $key=>$section )
                        @if($key>3) @break @endif
                        <li class="category"><a   data-id="{{ $section->id  }}" href="javascript:void(0)"  class="mainsection @if($key == 0) active  @endif ">@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif</a></li>
                    @endforeach
                </ul>
            </div>
            <!--             <div id="slider_navs"></div> -->
        </div>
    </div>
    <section class="container">
        <div id="loading" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 150px;margin-left: auto;width: 0%;z-index: 999999;">
           <!---          vendors/css/Preloader_5.gif   -----> <img src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
        </div>
        <div class="lazy slider last_products" id="last_products">
        @foreach($last_products as $last_product )
            <div class="">
				 <div class="item-prd">
                <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
                    <a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $last_product->name_ar) }}@else{{ str_replace(' ', '_', $last_product->name_ar) }} @endif/{{$last_product->id}}" >
						<img src="{{ URL::to('public') }}{{ $last_product->image }}">
                    </a>
					<figcaption>
                        <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $last_product->id }}">
                            {{ __('site.fast_show') }}
                        </button>
                    </figcaption>
                </figure>
                <div class="pro-info">
                    <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $last_product->name_ar) }}@else{{ str_replace(' ', '_', $last_product->name_ar) }} @endif/{{$last_product->id}}" > @if(Lang::locale() == 'ar') {{ $last_product->name_ar }} @else {{ $last_product->name_en }} @endif</a> </h5>
                    <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($last_product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($last_product->description_en)), $limit = 80, $end = '  ')}} @endif</p>

                    <p class="mprice">@if($last_product->min_price > 0 && $last_product->min_price < $last_product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $last_product->price }}</span>     <span class="offer-non-sale">{{ $last_product->min_price }} </span> @else  <span class="offer-non-sale">{{ $last_product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                @if(count($last_product->review) > 0 )
                        @for($i = 0 ; $i < 5 ; $i++ )
                            <span class="@if( $i < ($last_product->reviews->sum('rating') / count($last_product->reviews)) )fas fa-star @else far fa-star @endif"></span>
                        @endfor
                  @else 
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>                        
                        @endif                  
                        <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if($last_product->user){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $last_product->user->name ) }}/{{$last_product->user->id}}@endif">@if($last_product->user){{ $last_product->user->name }}@endif</a></span> </p>
                        
                         <span style="font-size: 12px;">المشاهدات :@if($last_product->views > 0 )  {{ $last_product->views }} @else 0 @endif</span>
                </div>
                <div class="cart-btn">
                    <a   class="hvr-shutter-in-horizontal btn addtocart cartitems"  value="{{ $last_product->id }}"> {{ __('site.add_to_cart') }} </a>                    
                    <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $last_product->id }}"  title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
            </div>
			</div>
        @endforeach
        </div>
    </section>
    <!--End new product slider -->
    <div class="container space-six">
        <div class="row">
            @foreach($adverstisment3_up_most_views as $ads3)
            <div class="col-lg-6 mobile-margin responsive-space">
               @if($ads3->link)
                    <a href="{{ $ads3->link }}"><img src="{{ URL::to('/public') }}{{ $ads3->image }}" class="img-fluid" ></a>
               @else
                    <img src="{{ URL::to('/public') }}{{ $ads3->image }}" class="img-fluid">
               @endif
            </div>
            @endforeach
        </div>
    </div>
    <!--Start new product slider -->
    <div class="container"><!-- Start Title  -->
        <div class="slide-header">
            <div class="row col-lg-12 ">
                <h2 class="slider-title">{{ __('site.orderby_views') }}</h2>
            </div>
        </div>
    </div><!-- End Title -->
	<div class="container">
    <section class="lazy slider " id="most_views_products">
        @foreach($most_views_products as $most_views_product )
        <div class="">
			<div class="item-prd">
            <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
				<a href="{{ url('/public') }}/
                    @if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $most_views_product->name_ar) }}
                @else{{ str_replace(' ', '_', $most_views_product->name_ar) }}
                @endif
                        /
                    {{$most_views_product->id}}
                        " >
                <img src="{{ URL::to('/public') }}{{ $most_views_product->image }}">
				</a>
				<figcaption>
					
                    <button type="button" data-toggle="modal" data-target="#show_product_model"   class="btn  product_model_link"  value="{{ $most_views_product->id }}">
                        {{ __('site.fast_show') }}
                    </button>
                </figcaption>
            </figure>
            <div class="pro-info">
                <h5><a href="{{ url('/public') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $most_views_product->name_ar) }}@else{{ str_replace(' ', '_', $most_views_product->name_ar) }} @endif/{{$most_views_product->id}}" > @if(Lang::locale() == 'ar') {{ $most_views_product->name_ar }} @else {{ $most_views_product->name_en }} @endif</a> </h5>
                <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($most_views_product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($most_views_product->description_en)), $limit = 80, $end = '  ')}} @endif</p>

                <p class="mprice">@if($most_views_product->min_price > 0 && $most_views_product->min_price < $most_views_product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $most_views_product->price }}</span>     <span class="offer-non-sale">{{ $most_views_product->min_price }} </span> @else  <span class="offer-non-sale">{{ $most_views_product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

            @if(count($most_views_product->reviews) > 0 )
                    @for($i = 0 ; $i < 5 ; $i++ )
                        <span class=" @if($i < ($most_views_product->reviews->sum('rating')/count($most_views_product->reviews)) )fas fa-star @else far fa-star @endif"></span>
                    @endfor
                 @else 
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        
                        @endif
               <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if(!empty($most_views_product->user)){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $most_views_product->user->name ) }}/{{$most_views_product->user->id}}@endif">@if($most_views_product->user) {{ $most_views_product->user->name }} @endif</a></span> </p>
               
                         <span style="font-size: 12px;">المشاهدات :@if($most_views_product->views > 0 )  {{ $most_views_product->views }} @else 0 @endif</span>
                         
            </div>
            <div class="cart-btn">
                <a href="javascript:void(0)" value="{{ $most_views_product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>                 
                <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $most_views_product->id }}"  title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                </a>
            </div>
        </div>
		</div>
        @endforeach
     </section>
</div>
    <!--End new product slider -->
    <div class="container">
        <div class="row">
            @foreach($adverstisment4_up_discounts as $ads4)
            <div class="col-lg-4 mobile-margin">
                 @if($ads4->link)
                    <a href="{{ $ads4->link }}"><img src="{{ URL::to('/public') }}{{ $ads4->image }}" class="img-fluid banner-mobile"  ></a>
                @else
                    <img src="{{ URL::to('/public') }}{{ $ads4->image }}" class="img-fluid banner-mobile">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <!--Start new product slider -->
    <div class="container">
        <div class="slide-header">
            <div class="row col-lg-9">
                <h2 class="slider-title">{{ __('site.last_descound') }}</h2>
                <ul class="slider-nav">
                    @foreach($main_sections as $key=>$section )
                        @if($key>3) @break @endif
                    <li class="category"><a data-id="{{ $section->id }}" href="javascript:void(0)" class="minproducts @if($key==0) active @endif  " >@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section class="container  " >
        <div id="loading22" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 150px;margin-left: auto;width: 0%;z-index: 999999;">
            <img src="{{ URL::to('/public') }}{{theme_url('images/loading.gif')}}">
        </div>
        <div class=" lazy slider minimum_products" id="mainproducts">
            @foreach($minimum_products as $minimum_product )
                <div class="">
					<div class="item-prd">
                    <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
                        <a href="{{ url('/public') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $minimum_product->name_ar) }}@else{{ str_replace(' ', '_', $minimum_product->name_ar) }} @endif/{{$minimum_product->id}}" >
							<img style="width:260px;height: 212px ;" src="{{ URL::to('/public') }}{{ $minimum_product->image }}">
						</a>
						@if($minimum_product->min_price > 0 && !empty($minimum_product->min_price))
                            <div class="triangle3-1">
                                <span class="offer">{{ __('site.descount') }} {{ round((( $minimum_product->price - $minimum_product->min_price ) / $minimum_product->price ) * 100 , 2 )  }}%</span>
                            </div>
                        @endif
                        <figcaption>
                            <button type="button" data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link"  value="{{ $minimum_product->id }}">
                                {{ __('site.fast_show') }}
                            </button>
                        </figcaption>
                    </figure>
                    <div class="pro-info">
                        <h5><a href="{{ url('/public') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $minimum_product->name_ar) }}@else{{ str_replace(' ', '_', $minimum_product->name_ar) }} @endif/{{$minimum_product->id}}" > @if(Lang::locale() == 'ar') {{ $minimum_product->name_ar }} @else {{ $minimum_product->name_en }} @endif</a> </h5>
                        <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($minimum_product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($minimum_product->description_en)), $limit = 80, $end = '  ')}} @endif</p>
                        <p class="mprice">@if($minimum_product->min_price > 0 && $minimum_product->min_price < $minimum_product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $minimum_product->price }}</span>     <span class="offer-non-sale">{{ $minimum_product->min_price }} </span> @else  <span class="offer-non-sale">{{ $minimum_product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>
                        @if(count($minimum_product->reviews) > 0 )
                            @for($i = 0 ; $i < 5 ; $i++ )
                                <span class="fa fa-star @if($i < ($minimum_product->reviews->sum('rating') /count($minimum_product->reviews)) )fas fa-star @else far fa-star @endif"></span>
                    @endfor
                 @else 
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        
                        @endif
                       
                          <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if(!empty($minimum_product->user)){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $minimum_product->user->name ) }}/{{$minimum_product->user->id}}@endif">@if(!empty($minimum_product->user)) {{ $minimum_product->user->name }} @endif</a></span> </p>
                          
                         <span style="font-size: 12px;">المشاهدات :@if($minimum_product->views > 0 )  {{ $minimum_product->views }} @else 0 @endif</span>
                    </div>
                    <div class="cart-btn">
                        <a href="javascript:void(0)" value="{{ $minimum_product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                        
                        <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $minimum_product->id }}" title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                        </a>
                    </div>
                </div>
			</div>
            @endforeach
        </div>
    </section>
    <!--End new product slider -->
  
    <!--Start new product slider -->
    @foreach($main_sections as $key=>$section )
    <div class="container @if (end($main_sections)) @endif">
        <div class="slide-header">
            <div class="row col-lg-9 ">
             <a href="{{ url('/main-section') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($section->name_ar)) }}@else{{ str_replace(' ', '_', trim($section->name_en))}}@endif/{{$section->id}}">   <h2 class="slider-title">@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else  {{ $section->name_en }} @endif</h2></a>
               @if($section->has_sub)
                <ul class="slider-nav">
                    @foreach($section->has_sub as $key=>$sub_section )
                        @if($key > 2 ) @break @endif
                    <li class="category"><a data-id="{{$sub_section->id}}" href="javascript:void(0)"    class="last_section @if($key == 0 ) active @endif " >@if(Lang::locale() == 'ar') {{ $sub_section->name_ar }} @else {{ $sub_section->name_en }} @endif </a></li>
                    @endforeach
                </ul>
               @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <a id="banner" href="{{ url('/main-section') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($section->name_ar)) }}@else {{ str_replace(' ', '_', trim($section->name_en)) }}@endif/{{$section->id}}"><img src="{{ URL::to('public') }}{{ $section->photo }}" class="left-banner img-fluid"></a>
            </div>
            <section class="col-lg-9 ">
             <!---show sections products -------array_slice($arr, 0, 2)-->
            <div id="last_{{$section->id}}" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 150px;margin-left: auto;width: 0%;z-index: 999999;">
                    <img src="{{ URL::to('/public') }}{{theme_url('images/loading.gif')}}">
           </div>
           <div class="lazy2 slider lastpagesection">
            @foreach($section->product_main as $product)
                <div>
					<div class="item-prd">
                    <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
						<a href="{{ url('/public') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" >
                            @if(file_exists(public_path() . $product->image))
							<img src="{{ URL::to('/public') }}{{ $product->image }}">
                                @else
                                <img src="http://tsheed.com/public/default/images/logo.png">
                                @endif

						</a>
							@if($product->min_price > 0 && !empty($product->min_price))
                            <div class="triangle3-1">
                                <span class="offer">{{ __('site.descount') }} {{ round((( $product->price - $product->min_price ) / $product->price ) * 100 , 2 )  }}%</span>
                            </div>
                        @endif
                        
                        <figcaption>
                            <button type="button"   class="btn  product_model_link"  value="{{ $product->id }}" data-toggle="modal" data-target="#show_product_model" >
                                {{ __('site.fast_show') }}
                            </button>
                        </figcaption>
                    </figure>
                    <div class="pro-info">
                        <h5><a href="{{ url('/public') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a> </h5>
                        <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($product->description_en)), $limit = 80, $end = '  ')}} @endif</p>
                        <p class="mprice">@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>
                        @if(count($product->reviews) > 0 )
                            @for($i = 0 ; $i < 5 ; $i++ )
                                <span class=" @if($i < ($product->reviews->sum('rating')/count($product->reviews)) + 1 )fas fa-star @else far fa-star @endif"></span>
                       @endfor
                       @else 
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        
                        @endif
                       
                       
                         <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if($product->user){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}@endif">@if($product->user){{ $product->user->name }}@endif</a></span> </p>
                         
                         <span style="font-size: 12px;">المشاهدات :@if($product->views > 0 )  {{ $product->views }} @else 0 @endif</span>
                        
                         	 
								
								
								
                    </div>
                    <div class="cart-btn">
                         
                        <a value="{{ $product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                        
                        <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $product->id }}" title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                        </a>
                    </div>
                </div>
			   </div>
            @endforeach
           </div>
            <!----end sections products ----------->
            </section>
            <!--End new product slider -->
        </div>
    </div>
    @endforeach
    
    
    
      <!--Start brands slider 1 -->

    <!--End brands slider 1 -->
    
    
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
@section('page_scribt')
    <script type="text/javascript" > 
    $(document.body).on('click', ".minproducts", function(e){
            var minsection = $(this).data("id");  //alert(minsection) ;
            //$('.minimum_products').slick('slickRemove',$('.minimum_products').index(this) - 2);
            $('.minimum_products').slick('slickRemove');
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "{{url('/get-products-in-slider_min_last')}}",
                data:'min=1,main_section='+minsection,
                beforeSend:function(){
                    $('#loading22').show('fast');
                },
                success: function (data) {
                    if (data.length != 0) {
                        $('.minimum_products').slick("slickAdd" , data ) ;
                       $('#loading22').hide('fast');
                    }
                }
            })
            //end
        });
    $(document.body).on('click', ".mainsection", function(e){
        var mainsection = $(this).data("id");
        $('.last_products').slick('slickRemove');
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "{{url('get-products-in-slider')}}",
            data:'main_section='+mainsection,
            beforeSend:function(){
                $('#loading').show('fast');
            },
            success: function (data) {
                if (data.length != 0) {
                    $('.last_products').slick("slickAdd" , data ) ;
                    $('#loading').hide('fast');

                }
            }
        });
    }) ;
    $(document.body).on('click', ".last_section", function(e){
        var subsection = $(this).data("id");
        //alert(subsection) ;
        var section = 1 ; //$(this).attr("section");
        $('.lastpagesection').slick('slickRemove');
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "{{url('get-products-in-slider')}}",
            data:'sub_section='+subsection,
            beforeSend:function(){
                $('#loading'+section).show('fast');
            },
            success: function (data) {
                if (data.length != 0) {
                    $('.lastpagesection').slick("slickAdd" , data ) ;
                    $('#loading'+section).hide('fast');
                }
            }
        })
        //end
    });
  /*  $(document).ready(function () {
        //last_features_products

        //last_sectionn

    });*/
    </script>
@stop