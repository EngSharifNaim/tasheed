@extends('layouts.app')
@section('page_title')
    @if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif
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
                    <li><a href="{{ url('/') }}"> {{ __('site.home_page') }} <i class="fas fa-angle-left"></i>  </a></li>
                    @if($section->parent)
                    <li><a href="{{ url('/main-section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->parent->name_ar) }}@else {{ str_replace(' ', '_', $section->parent->name_en) }}@endif/{{$section->parent->id}}"> @if(Lang::locale() == 'ar') {{ $section->parent->name_ar }} @else {{ $section->parent->name_en }} @endif  <i class="fas fa-angle-left"></i> </a></li>
                    @endif
                    @if(count($section->has_sub) > 0 )
                    <li><a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->parent->name_ar) }}/{{ str_replace(' ', '_', $section->subsection->name_ar) }}@else{{ str_replace(' ', '_', $section->parent->name_en) }}/ {{ str_replace(' ', '_', $section->subsection->name_en) }}@endif/{{$section->subsection->id}}"> @if(Lang::locale() == 'ar') {{ $section->subsection->name_ar }}  @else {{ $section->subsection->name_en }}  @endif <i class="fas fa-angle-left"></i> </a></li>
                    @endif
                    @if(!empty($section->subsubsection) )
                    <li><a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->parent->name_ar) }}/{{ str_replace(' ', '_', $section->subsection->name_ar) }}/{{ str_replace(' ', '_', $section->subsubsection->name_ar) }}@else{{ str_replace(' ', '_', $section->parent->name_en) }}/{{ str_replace(' ', '_', $section->subsection->name_en) }}/{{ str_replace(' ', '_', $section->subsubsection->name_en) }}@endif/{{$section->subsection->id}}"> @if(Lang::locale() == 'ar') {{ $section->subsection->name_ar }}  @else {{ $section->subsection->name_en }}  @endif <i class="fas fa-angle-left"></i> </a></li>
                    @endif
                    <li><a class="active"> @if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif  </a></li>
                </ul>
              
                        </div>
                </div>
</section>
	    <div class="container product-head">
			<div class="clearfix"></div>
    @if(count($products) > 0 )
    <div class="row">
          <div class="col-lg-3 hidem">

            <div class="hidden-lg hidden-md hidden-sm">
    <a href="" id="btn-mobile">البحث المتقدم</a>
</div>
<form  name="get" id="fusearck" action ="{{ url('/search-filter')}}"  >
<input type="hidden" name="sub_section" value="{{$section->id }}" >
    <div class="fliter-sidebar">
        <div id="accordion">

            <div class="card">
                
            </div>
            {{-- order --}}
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <p style="margin-left: auto;">{{ __('site.according_list') }}</p>
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="arrow-fliter fas fa-angle-double-up"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="form-group">
                            <select name="order" class="form-control" id="exampleFormControlSelect1">
                                <option value="new">{{ __('site.last_first') }}</option>
                                <option value="old">{{ __('site.old_first') }}</option>
                                <option value="height_price">الاعلي سعرا</option>
                                <option value="low_price">الاقل سعرا</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {{-- sections ! --}}
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <div class="mb-0">
                        <p style="    margin-left: auto;">الاقسام الفرعيه</p>
                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="arrow-fliter fas fa-angle-double-up"></i>
                        </a>
                    </div>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                    <div class="card-body">
                        <div id="loadingsection" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 250px;margin-left: 40%;width: 0%;z-index: 999999;">
                            <img src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
                        </div>
                        @if(isset($section_level))
                            <input type="hidden" name="{{$section_level}}" value="{{$section->id}}">
                        @endif
                        <div id="section_result" >
                            @foreach($section->has_sub as $sub )
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="sub_section[]" value="{{ $sub->id }}">@if(Lang::locale() == 'ar' ) {{ $sub->name_ar }} @else {{ $sub->name_en }} @endif
                                </label>
                            </div>
                            @foreach($sub->subsections as $sub_sub )
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="sub2_section[]" value="{{ $sub_sub->id }}">-- @if(Lang::locale() == 'ar' ) {{ $sub_sub->name_ar }} @else {{ $sub_sub->name_en }} @endif
                                </label>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- rating -->

            <!-- brands -->           
            <!-- price -->
            <div class="card">
                <div class="card-header" id="headingFive">
                    <div class="mb-0">
                        <p style="    margin-left: auto;">السعر</p>
                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="arrow-fliter fas fa-angle-double-up"></i>
                        </a>
                    </div>
                </div>
                <div id="collapseFive" class="collapse show" aria-labelledby="headingFive">
                    <div class="card-body">
                        <div id="wrapper">
                            <div class="row" style="margin:0 0 20px">
                                <div class="col">
                                    <input id="price_max" name="price_min" type="text" class="form-control" value="0">
                                </div>
                                <div class="col">
                                    <input id="price_min" name="price_max" type="text" class="form-control"  value="10000">
                                </div>
                            </div>
                            <div id="price_slider"></div>
                        </div>
                    </div>
                </div>
				<input type="submit" name="search" >
            </div>
        </div>
    </div>
</form>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/nouislider.min.js')}}"></script>
@section('page_scribt')
<script type="text/javascript">
       $("#fusearck").ajaxForm({
            success: function (response) {
				 $('.filter_result').html(response);
               // alert(response);
              /*  $.bootstrapGrowl(response,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,
                }); 
				*/
            }
        });
$(document).ready(function () {
    var $price_slider = $('#price_slider');
    var $price_min = $('#price_min');
    var $price_max = $('#price_max');
    var mainSearchForm = $('form[name=filter_form]');
    // var $inputs = $('input');
    
    noUiSlider.create(price_slider, {
        start: [0, 10000],
        connect: true,
        range: {
            'min': 0,
            'max': 10000
        }
    });
    
    price_slider.noUiSlider.on('update', function ( values, handle ) {
    
        if (values != 0 || values != 10000) {
            handle == 0 ? $price_min.val(values[handle]) : $price_max.val(values[handle]);
            if ((handle == 0 && values > 0) || (handle != 0 && values < 10000))
            {
                advancedSearch(mainSearchForm);
            }
        } else {
            handle == 0 ? $price_min.val("No Min") : $price_max.val("No Max");
        }
    
    });
});


        $(document.body).on('click', "div[class=progress-bar]", function(e){
            var rate = $(this).data('ratevalue');
          //  alert(rate);
        });
      /*  $(document.body).on('keyup', "input[name=filter_form_category_search]", function(e){
            var sorting_name = $("input[name=filter_form_category_search]").val();
            alert(sorting_name) ;
        });*/
        $(document).ready(function(){
            // $("input[id=price_max]").change(function(){
            //     alert($(this).val());
            // });

            //search for section and subsections
            // $("input[name=filter_form_category_search]").keyup(function(){
            // var sorting_name = $("input[name=filter_form_category_search] ").val();
            // $.ajax({
            //     type: "post",
            //     dataType: "html",
            //     url: "{{url('search_sidebar_in_section')}}",
            //     data:'sorting_by='+sorting_name+'&section='+"{{ $section->id }}" ,
            //     beforeSend:function(){
            //         $('#loadingsection').show('fast');
            //     },
            //     success: function (response) {
            //         $(".section_result").html(response);
            //         $('#loadingsection').hide('fast');
            //     }
            // });});
        }) ;
        //for ajax product model




    // $inputs.on('change', function() {
    //  if (this == $price_min[0]) {
    //      price_slider.noUiSlider.set([this.value,null]);
    //  } else {
    //      price_slider.noUiSlider.set([null,this.value]);
    //  }
    // });
</script>
@stop

            @if(!empty($adverstisments2)  )
                @foreach($adverstisments2 as $ads)
                    @if($ads->link)
                        <a href="{{ $ads->link }}">   <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" ></a>
                    @else
                        <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" >
                    @endif
                @endforeach
            @endif
        </div>

        <div class="col-lg-9 filter_result">
            @include('filter_search')
        </div>
    </div>
    
    
    
     <div class="col-lg-3 showm">

            @include('shared.advanced-search')

            @if(!empty($adverstisments2)  )
                @foreach($adverstisments2 as $ads)
                    @if($ads->link)
                        <a href="{{ $ads->link }}">   <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" ></a>
                    @else
                        <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" >
                    @endif
                @endforeach
            @endif
        </div>


    @else
    <div class="row " >
        <h1> {{ __('site.no_product') }}</h1></br>
    </div>
    @endif
        </div>
@stop


