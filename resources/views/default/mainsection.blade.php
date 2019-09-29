@extends('layouts.app')
@section('page_title')
    @if(Lang::locale() == "ar") {{ $section->name_ar }} @else {{ $section->name_en }} @endif
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
                        <li><a href="{{ url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a  href="javascript:void(0)" class="active">@if(Lang::locale() == "ar"){{ $section->name_ar }} @else {{ $section->name_en }} @endif   </a></li>
                    </ul>
               
            </div>
        </div>
    </section>
    <!-- End The Top Header -->
    <div class="container product-head">
		<div class="pull-right"><h2 class="text-right">@if(Lang::locale() == "ar"){{ $section->name_ar }} @else {{ $section->name_en }} @endif</h2></div>
		<div class="clearfix"></div>
    </div>
    <!-- 

    End sidenav menu -->
    <!-- Start Slide Section menu  -->
    <!--Start product slider 1 -->
<div class="main-section">
    @if(count($section->has_sub) > 0 )
    <h2 class="slide-title pro-head text-center"> {{ __('site.sub_section') }} </h2>
	<div class="container">
    <section class="lazyh slider">
        @foreach($section->has_sub as $sub )
        <div class="pro-item">
			<a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $section->name_ar) }}/{{ str_replace(' ', '_', $sub->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }}/{{ str_replace(' ', '_', $sub->name_en) }}@endif/{{$sub->id}}"  >
            <img class="d-block img-fluid slideheight" src="{{ URL::to('/public') }}{{$sub->photo}}">
            <div class="pro-title">
                <p class="text-price"><a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $section->name_ar) }}/{{ str_replace(' ', '_', $sub->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }}/{{ str_replace(' ', '_', $sub->name_en) }}@endif/{{$sub->id}}"  >@if(Lang::locale() == 'ar') {{ $sub->name_ar }} @else {{ $sub->name_en }} @endif </a></p>
            </div>
				<span> <a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $section->name_ar) }}/{{ str_replace(' ', '_', $sub->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }}/{{ str_replace(' ', '_', $sub->name_en) }}@endif/{{$sub->id}}"  style="color:white">{{ __('site.shoping_now') }}</a> </span>
			</a>
        </div>
        @endforeach
    </section>
	</div>
    @endif
    <!--End product slider 1 -->
    <!--Start brands slider  -->
    @if(count($section->brands->toArray()) > 0 )
    <div class="brands-all">
        <div class="container">
            <h2 class="slider-title text-center">{{ __('admin.brands') }} </h2>
            <section class="lazyh slider">
                @foreach($section->brands as $brand )
                    <div>
                        <a href="{{ url('/brand') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $brand->name_ar) }}@else{{ str_replace(' ', '_', $brand->name_en) }}@endif/{{$brand->id}}"> <img class="d-block img-fluid slideheight brand-slide" src="{{URL::to('/public')}}{{$brand->photo}}" title="@if(Lang::locale() == 'ar') {{$brand->name_ar}}@else {{ $brand->name_en }} @endif"></a>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
    @endif
    <!--End brands slider -->
    <!-- Tow Banner -->
    @if(count($adverstisments->toArray()) > 0 )
    <div class="container space-six">
        <div class="row">
            @foreach($adverstisments as $ads3 )
                <div class="col-lg-6 mobile-margin responsive-space">
                    @if($ads3->link)
                        <a href="{{ $ads3->link }}"><img src="{{ URL::to('public') }}{{ $ads3->image }}" class="img-fluid" ></a>
                    @else
                        <img src="{{ URL::to('public') }}{{ $ads3->image }}" class="img-fluid">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif
    <!-- Tow Banners -->

	<!----------------  --------------------------->
    </div>
    </div>
@stop


