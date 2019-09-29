@extends('layouts.app')
@section('page_title')
    {{ __('site.sections_page') }}
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
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >{{ __('site.sections_page') }}  </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container all-cat">
        <h1 class="text-right">  {{ __('site.sections_page') }}</h1>
        <div class="row">
        <?php
            $x= count($sections) ;  // number of sections
            $show = round( $x / 4 , 0);    // number of sections show per colum
             $second = round($show * 2  , 0 ) ;
                $third = round($show * 3  , 0 ) ;
                $fourth = round($show * 4  , 0 ) ;
            ?>
            <div  class="col-md-3">
            @foreach($sections as $key=>$section)
                    <h2 class="text-right"><a href="{{ url('/section') }}?section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }} @endif&i={{$section->id}}"  >@if(Lang::locale() == 'ar' ) {{ $section->name_ar }} @else {{ $section->name_en }}  @endif </a></h2>

                    @if(count($section->has_sub) > 0 )
                        @foreach($section->has_sub as $keysub=>$sub)
                            <div class="cat-list text-right">
                                <h3 data-toggle="collapse" data-target="#collapse{{$sub->id}}" aria-expanded="false" aria-controls="collapse{{$sub->id}}">
                                    @if(count($sub->subsections) > 0 ) <i class="arrow-fliter fas fa-angle-double-up"></i>  @endif  <a href="{{ url('/section') }}?section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }} @endif&sub_section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $sub->name_ar) }}@else {{ str_replace(' ', '_', $sub->name_en) }} @endif&i={{$sub->id}}"  >@if(Lang::locale() == 'ar' ) {{ $sub->name_ar }} @else {{ $sub->name_en }}  @endif </a> </h3>
                                @if(count($sub->subsections) > 0 )
                                    <ul id="collapse{{$sub->id}}" class="collapse " aria-labelledby="heading{{$sub->id}}">
                                        @foreach($sub->subsections as $subsub)
                                            <li><a href="{{ url('/section') }}?section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $section->name_ar) }}@else {{ str_replace(' ', '_', $section->name_en) }} @endif&sub_section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $sub->name_ar) }}@else {{ str_replace(' ', '_', $sub->name_en) }} @endif&sub_sub_section=@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $subsub->name_ar) }}@else {{ str_replace(' ', '_', $subsub->name_en) }} @endif&i={{$subsub->id}}">@if(Lang::locale() == 'ar') {{ $subsub->name_ar }} @else {{ $subsub->name_ar }}  @endif</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    @if($key == $second || $key == $third || $key == $fourth || $key ==  $show )
                </div><div  class="col-md-3">
              @endif
            @endforeach
            </div>
        </div>
    </div>
 <!--------------->
@stop