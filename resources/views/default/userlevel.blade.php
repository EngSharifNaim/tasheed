@extends('layouts.app')
@section('page_title')
{{ $userlevel->name_ar }}
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
                        <li><a class="active" >{{ $userlevel->name_ar }}</a></li>

                    </ul>
                </div>
            </div>
        </div>
</section>
<div class="container">
    @if(count($users) > 0 )
    <div class="row">
        @foreach($users as $key=>$user)
            @if( $paidsetting->value == 'yes')

            @if( count($user->paidacount) > 0)

                @if($user->paidacount->first()->active == 'yes' && $user->paidacount->first()->end_at > now())

            <div class="col-md-3">
                <div class="product-best" >
                    <figure class="d-block img-fl)uid slideheight imghvr-shutter-in-vert">
                        <img src="@if(!empty($user->photo)){{ URL::to('public') }}{{ $user->photo }}@else http://tsheed.com/public/default/images/logo.png @endif">
                    </figure>
                    <div class="pro-info pro-info2">
                        <h5><a href="{{ url('/company-page') }}/{{$user->id}}" >{{ $user->name }}</a> </h5>
                        <p> {{ str_limit(trim(strip_tags($user->describtion)), $limit = 180, $end = '  ')}}</p>
                    </div>
                </div>
            </div>
            @endif
            @endif
                @else
            @if( $paid->value == 'no')
                <div class="col-md-3">
                    <div class="product-best" >
                        <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
                            <img src="@if(!empty($user->photo)){{ URL::to('public') }}{{ $user->photo }}@else http://tsheed.com/public/default/images/logo.png @endif">
                        </figure>
                        <div class="pro-info pro-info2">
                            <h5><a href="{{ url('/company-page') }}/{{$user->id}}" >{{ $user->name }}</a> </h5>
                            <p> {{ str_limit(trim(strip_tags($user->describtion)), $limit = 180, $end = '  ')}}</p>
                        </div>
                    </div>
                </div>
            @endif
            @endif
        @endforeach

    </div>

    <div class="category-pagination">
        <nav aria-label="Page navigation example ">
            {!! $users->render()  !!}
        </nav>
    </div>
    @else
  </br>
        <div class=" "><center>لا يوجد عضويات فى هذا القسم </center></div>
       
    @endif
</div>
    @stop

    


