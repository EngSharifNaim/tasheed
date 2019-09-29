@extends('layouts.app')
@section('page_title')
404
@stop
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >404</a></li>
                    </ul>
                </div>


            </div>
        </div>
    </section>
    <div class="container copouns">
        <h1>{{ __('site.page_not_found') }}</h1>

    </div>
@stop



