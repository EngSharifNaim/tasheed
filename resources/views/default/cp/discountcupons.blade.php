@extends('layouts.cp')
@section('page_title')
  {{ __('site.cupons_dec') }}
@stop
@section('content')
            <div class="col-lg-9 content-copouns">
                <h2>{{ __('site.welcome') }}   {{ Auth::user()->name }}</h2>
                <h5>{{ __('site.no_cupons') }}</h5>
            </div>
        </div>
    </div>
@stop



