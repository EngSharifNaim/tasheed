@extends('layouts.app')
@section('page_title')
   {{ __('site.search_for') }} {{ $search_title }}
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
            <div class="row bread-crumb">
                <div class="col-lg-8">
                    <ul>
                        <li><a href="{{ url('/')  }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active" >  {{ __('site.search_for') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active" >{{ $search_title }}</a></li>

                    </ul>
                </div>
            </div>
        </div>
</section>
<div class="container">
    @if(count($products) > 0 )
    <div class="row">

        @foreach($products as $key=>$product)
{{--            {{$product->user->paidacount}}--}}
{{--            @if(count($product->user->paidacount) > 0)--}}
{{--            @if($product->user->paidacount->first()->active == 'yes')--}}
            <div class="col-md-3">
				<div class="item-prd">
                <div class="product-best" >
                    <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
{{--                        @if(file_exists(url( $product->image)))--}}
                        <img src="{{ URL::to('public') }}{{ $product->image }}">
{{--                        @else--}}
{{--                            <img src="http://tsheed.com/public/default/images/logo.png">--}}
{{--                            @endif--}}
                        <figcaption>
                            <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $product->id }}">
                                {{ __('site.fast_show') }}
                            </button>
                        </figcaption>
                    </figure>
                    <div class="pro-info">
                        <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a> </h5>
                        <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($product->description_ar)), $limit = 80, $end = '  ') }} @else {{ str_limit(trim(strip_tags($product->description_en)), $limit = 80, $end = '  ') }} @endif</p>
                              
                       <p class="mprice">@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                @if(count($product->review) > 0 )
                        @for($i = 0 ; $i < 5 ; $i++ )
                            <span class="fa fa-star @if( $i+1 < ($product->reviews->sum('rating') / count($product->reviews)) )checked @endif"></span>
                        @endfor
                  @else 
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>                        
                        @endif                  
                        <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if($product->user){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}@endif">@if($product->user){{ $product->user->name }}@endif</a></span> </p>
                        
                         <span style="font-size: 12px;">المشاهدات :@if($product->views > 0 )  {{ $product->views }} @else 0 @endif</span>
                         
                      <!-- 
                      
                       <p>@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                        @if(count($product->reviews->toArray()) > 0 )
                            @for($i = 0 ; $i < 5 ; $i++ )
                                <span class="fa fa-star @if($i+1 <  ($product->review->sum('rating')/count($product->reviews)) )checked @endif"></span>
                            @endfor
                        @endif
                        <span>( @if($product->views > 0 ) {{ $product->views }} @else 0 @endif )</span>
                        
                        -->
                    </div>
                     <div class="cart-btn">
                         
                        <a value="{{ $product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                        
                        <a href="javascript:void(0)" name="addtofavouriteproduct" data-id="{{ $product->id }}" title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                        </a>
                    </div>
                </div>
				</div>
            </div>
{{--                @endif--}}
{{--            @endif--}}
        @endforeach

    </div>

    <div class="category-pagination">
        <nav aria-label="Page navigation example ">
            {!! $products->render()  !!}
        </nav>
    </div>
    @else

        <div class=" "><center>لم نجد ما يطابق « {{ $search_title }} » من فضلك أعد المحاولة  </center></div>
        <section class="searchTips">
        </br> <div class=""><center><h2>نصائح للبحث</h2> </center></br>
                <ul>
                    <li style="text-align: right;">تأكد من الأخطاء الكتابية. على سبيل المثال: جكيت بدلا من جاكيت </li>
                    <li style="text-align: right;">حاول البحث على كلمة لها نفس المعنى أو معنى قريب</li>
                    <li style="text-align: right;">حاول البحث عن كلمة واحدة فقط</li>
                    <li style="text-align: right;">حاول البحث عن كلمات عامة أكثر ثم قوم بترشيح النتائج
                    </li>
                </ul>
                <br>
            </div>
       </section>
    @endif
</div>
    @stop

    


