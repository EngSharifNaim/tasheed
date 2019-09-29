@extends('layouts.app')
@section('page_title')
    {{ __('admin.brands') }}
@stop
@section('meta_data')
    <meta name="description" content="@if(Lang::locale() == 'ar') {!! nl2br(str_limit(trim(strip_tags($brand->description_ar)), $limit = 40, $end = '  ')) !!} @else {!! nl2br(str_limit(trim(strip_tags($brand->description_en)), $limit = 80, $end = '  ')) !!} @endif"/>
    <link rel="canonical" href="{ url('/') }}/brands/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $brand->name_ar) }}@else{{ str_replace(' ', '_', $brand->name_ar) }} @endif/{{$brand->id}}" />
    <link rel="publisher" href="https://plus.google.com/+@if(isset($settings['site_title'])) @if(Lang::locale() == 'ar') {{ $settings['site_title'] }} @else {{ $settings['site_title_en'] }} @endif @endif"/>
    <meta property="og:locale" content="{{ Lang::locale() }}" />
    <meta property="og:type" content="{{ __('site.website') }}" />
    <meta property="og:title" content=" @if(Lang::locale() == "ar"){{ $brand->name_ar }} @else {{ $brand->name_en }} @endif" />
    <meta property="og:description" content="@if(Lang::locale() == 'ar') @if(isset($settings['site_aboutus'])) {!! nl2br(str_limit(trim($settings['site_aboutus']), $limit = 160, $end = '  ')) !!} @endif @else  @if(isset($settings['site_aboutus_en'])) {!! nl2br(str_limit(trim($settings['site_aboutus_en']), $limit = 160, $end = '  ')) !!} @endif @endif" />
    <meta property="og:url" content="{ url('/') }}/brands/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $brand->name_ar) }}@else{{ str_replace(' ', '_', $brand->name_ar) }} @endif/{{$brand->id}}" />
    <meta property="og:site_name" content="@if(isset($settings['site_title'])) @if(Lang::locale() == 'ar') {{ $settings['site_title'] }} @else {{ $settings['site_title_en'] }} @endif @endif" />
    <meta property="article:publisher" content="@if(isset($settings['facebook_url'])) {{ $settings['facebook_url'] }} @endif" />
    {{--<meta property="fb:admins" content="18003017055" />--}}
    <meta property="og:image" content="{{ URL::to('public') }}{{$brand->image}}" />
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="@if(Lang::locale() == 'ar') {!! nl2br(str_limit(trim(strip_tags($brand->description_ar)), $limit = 40, $end = '  ')) !!} @else {!! nl2br(str_limit(trim(strip_tags($brand->description_en)), $limit = 160, $end = '  ')) !!} @endif"/>
    <meta name="twitter:title" content="@if(Lang::locale() == "ar"){{ $brand->name_ar }} @else {{ $brand->name_en }} @endif"/>
    <meta name="twitter:site" content="@if(isset($settings['twitter_url'])) {{ $settings['twitter_url'] }} @endif"/>
    <meta name="twitter:domain" content="@if(isset($settings['site_title'])) @if(Lang::locale() == 'ar') {{ $settings['site_title'] }} @else {{ $settings['site_title_en'] }} @endif @endif"/>
    <meta name="twitter:image:src" content="{{ URL::to('public') }}{{$brand->image}}"/>
    <meta name="twitter:creator" content="@if(isset($settings['twitter_url'])) {{ $settings['twitter_url'] }} @endif"/>
    <meta itemprop="name" content="@if(Lang::locale() == "ar"){{ $brand->name_ar }} @else {{ $brand->name_en }} @endif">
    <meta itemprop="description" content="@if(Lang::locale() == 'ar') {!! nl2br(str_limit(trim(strip_tags($brand->description_ar)), $limit = 40, $end = '  ')) !!} @else {!! nl2br(str_limit(trim(strip_tags($brand->description_en)), $limit = 160, $end = '  ')) !!} @endif">
    <meta itemprop="image" content="{{ URL::to('public') }}{{$brand->image}}">
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
    <section class="bread">
        <div class="container">
            <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ url('/') }}"> {{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a href="javascript:void(0)" class="active">ا{{ __('admin.brands') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a href="javascript:void(0)" class="active">@if(Lang::locale() == 'ar') {{ $brand->name_ar }} @else {{ $brand->name_ar }} @endif </a></li>
                    </ul>

                <div class=" search-category">
                    <form method="get" action="{{ url('/search') }}" >
                        <input type="hidden" name="b" value="{{ $brand->id }}" >
                        <input data-brackets-id="33242" class="form-control search-category-form  filter-form" type="text" placeholder="{{ __('site.search_in_brand') }} @if(Lang::locale() == 'ar') {{ $brand->name_ar }} @else {{ $brand->name_ar }} @endif">
                        <i class="fas fa-search cetgory-serchbox"></i>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container product-head">
        <div class="pull-right"><h2 class="text-right">@if(Lang::locale() == "ar"){{ $brand->name_ar }} @else {{ $brand->name_en }} @endif</h2></div>
        <div class="pull-left"><span class="num-prod">{{ __('site.we_found') }}{{ count($brand->product) }} {{ __('site.product_t') }}</span></div>
        <div class="clearfix"></div>
    </div>
    <div class="container">
        @if(count($products) > 0 )
            <div class="row">
                <div class="col-lg-3">
                    <form name="filter_form" >
                        <div class="fliter-sidebar">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <div class="">
                                                <p style="margin-left: auto;">{{ __('site.according_list') }}</p>
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="arrow-fliter fas fa-angle-double-up"></i>
                                                </button>
                                            </div>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select name="list_order" class="form-control" id="exampleFormControlSelect1">
                                                    <option value="last">{{ __('site.last_first') }}</option>
                                                    <option value="old">{{ __('site.old_first') }}</option>
                                                    <option value="most_sale">{{ __('site.most_sale') }}</option>
                                                    <option value="lowest_sale">{{ __('site.lowest_sale') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <div class="mb-0">
                                            <div class="">
                                                <p style="    margin-left: auto;">الفئات</p>
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="arrow-fliter fas fa-angle-double-up"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                                        <div class="card-body">
                                            <input class="form-control  filter-form" type="text" placeholder="البحث حسب الفئة">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""> فئة
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""> فئة
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""> فئة
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <div class="mb-0">
                                            <div class="">
                                                <p style="    margin-left: auto;">تقيم البائع</p>
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <i class="arrow-fliter fas fa-angle-double-up"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
                                        <div class="card-body">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">4.0</div>
                                            </div>
                                            <hr>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">3.0</div>
                                            </div>
                                            <hr>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">2.0</div>
                                            </div>
                                            <hr>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">1.0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <div class="mb-0">
                                            <div class="">
                                                <p style="    margin-left: auto;">العلامة التجارية</p>
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    <i class="arrow-fliter fas fa-angle-double-up"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <div class="mb-0">
                                            <div class="">
                                                <p style="    margin-left: auto;">السعر</p>
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    <i class="arrow-fliter fas fa-angle-double-up"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive">
                                        <div class="card-body">
                                            <div id="wrapper">
                                                <div class="row" style="margin:0 0 20px">
                                                    <div class="col"><input id="input2" type="text" class="form-control"></div>
                                                    <div class="col"><input id="input1" type="text" class="form-control"></div>
                                                </div>
                                                <div id="slider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.min.js')}}" type="text/javascript"></script>
                                <script src="{{ URL::to('public') }}{{theme_url('vendors/js/nouislider.min.js')}}"></script>

                                <script type="text/javascript">
                                    var $slider = $('#slider');
                                    var $input1 = $('#input1');
                                    var $input2 = $('#input2');
                                    var $inputs = $('input');

                                    noUiSlider.create(slider, {
                                        start: [0, 100],
                                        connect: true,
                                        range: {
                                            'min': 0,
                                            'max': 100
                                        }
                                    });

                                    slider.noUiSlider.on('update', function ( values, handle ) {

                                        if (values != 0 || values != 10000000) {
                                            handle == 0 ? $input1.val(values[handle]) : $input2.val(values[handle]);
                                        } else {
                                            handle == 0 ? $input1.val("No Min") : $input2.val("No Max");
                                        }

                                    });

                                    $inputs.on('change', function() {
                                        if (this == $input1[0]) {
                                            slider.noUiSlider.set([this.value,null]);
                                        } else {
                                            slider.noUiSlider.set([null,this.value]);
                                        }
                                    });
                                </script>


                            </div>

                        </div>
                    </form>
                    @if(!empty($adverstisments2))
                    @foreach($adverstisments2 as $ads)
                        @if($ads->link)
                            <a href="{{ $ads->link }}">   <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" ></a>
                        @else
                            <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" >
                        @endif
                    @endforeach
                    @endif
                </div>
                <div class="row col-lg-9">
                    @foreach($products as $key=>$product)
                        <div class="col-md-4">
                            <div class="product-best" >
                                <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
                                    <img src="{{ URL::to('public') }}{{ $product->image }}">
                                    <figcaption>
                                        <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $product->id }}">
                                            {{ __('site.fast_show') }}
                                        </button>
                                    </figcaption>
                                </figure>
                                <div class="pro-info">
                                    <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a> </h5>
                                     <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($product->description_en)), $limit = 80, $end = '  ')}} @endif</p>

                              <!--      <p>@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                                    @if(count($product->reviews->toArray()) > 0 )
                                        @for($i = 0 ; $i < 5 ; $i++ )
                                            <span class="fa fa-star @if($i+1 <  ($product->review->sum('rating')/count($product->reviews)) )checked @endif"></span>
                                        @endfor
                                    @endif
                                    <span>( @if($product->views > 0 ) {{ $product->views }} @else 0 @endif )</span>
                                    
                                    -->
                                    
                                    
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
            </div>
            <div class="category-pagination">
                <nav aria-label="Page navigation example ">
                    {!! $products->render()  !!}
                </nav>
            </div>
        @else
            <div class="col-lg-6 " >
                <h1> {{ __('site.no_product') }}</h1></br>
            </div>
        @endif
    </div>
    <!--------------->
@stop




