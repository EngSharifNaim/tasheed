@extends('layouts.app')
@section('page_title')
    @if(Lang::locale() == "ar"){{ $page->name_ar }} @else {{ $page->name_en }} @endif
@stop
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >@if(Lang::locale() == "ar"){{ $page->name_ar }} @else {{ $page->name_en }} @endif</a></li>
                    </ul>
                </div>


            </div>
        </div>
    </section>
    <div class="container copouns">
        <h1>@if(Lang::locale() == "ar"){{ $page->name_ar }} @else {{ $page->name_en }} @endif</h1>
        <div class="row justify-content-md-center">
            <div class="col-lg-12 ">
                <p class="text-page">
                    @if(Lang::locale() == "ar"){!!  $page->description_ar!!}   @else {!! $page->description_en !!}  @endif
                </p>
            </div>
        </div>
    </div>
@stop



