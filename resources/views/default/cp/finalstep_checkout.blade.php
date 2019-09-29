@extends('layouts.app')
@section('page_title')
    {{ __('site.order_details') }}
@stop
@section('content')
<style type="text/css">
.track-order .col-md-2 {
    display: inline-block;
    width: 50% !important;
    max-width: 24%;
}
.text-order {
    width: 100%;
}

.text-order h3 {
    line-height: 1.8;
}
	.order-icon .fa {
    font-size: 30px;
    color: #ffffff;
}
.order-icon {
    margin: auto;
}
</style>
<section class="bread2">
    <div class="container">
        <div class="row bread-crumb">
            <div class="col-lg-4">
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                    <li><a href="{{ url('/my-orders') }}">{{ __('site.orders_title') }} <i class="fas fa-angle-left"></i> </a></li>
                    <li><a> {{ __('site.order_details') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container">
<div class="row text-order text-center">
    <div class="col-md-4">
        <h3>{{ __('site.sellers_name') }} : @if($order->has_orders != null )
            @foreach($order->has_orders as $key=>$ord)
                    <a href="{{ url('dealer-profile') }}/{{ str_replace(' ', '_',  $ord->dealer->name ) }}/{{$ord->dealer->id}}" class="table-view"> {{ $ord->dealer->name  }}  </a>
			<br >-{{ __('site.phone') }} : {{  $ord->dealer->phone }} @if(isset($ord->dealer->companie)) - {{ $ord->dealer->companie->phone }}  @endif


                    -

            @endforeach
            @endif</h3>
    </div>

    <div class="col-md-4">
        <h3> {{ __('site.order_date') }}: {{ $order->created_at }}</h3>
    </div>

    <div class="col-md-4">
        <h3>{{ __('site.follow_order') }}: {{ $order->id }}</h3>
    </div>
  
</div>
</div>

<div class="container track-order text-center" >
    <h1 class="text-right text-track">الطلب مقسم على  تجار </h1></br>
</div>
@foreach($order->has_orders as $key=>$order_dealer)
<div class="container track-order text-center">
   @if(!empty($order_dealer->dealer)) <h1 class="text-right text-track"> {{ __('site.dealer_name') }} : {{ $order_dealer->dealer->name  }}</h1> @endif
    <div class="row">
        <ul class="list-unstyled text-center">
			<div class="col-md-2">
            <li  @if($order_dealer->order_status === 'in_progress')  class="active " style="color:#ff6633;background-color: #ff6633;" @else class="  " @endif ></li>
			</div>
			<div class="col-md-2">
			<li @if($order_dealer->order_status === 'in_prepration') class="active " style="color:#ff6633;background-color: #ff6633;" @else class="" @endif ></li>
			</div>
			<div class="col-md-2">
				<li @if($order_dealer->order_status === 'on_delevery')   class="active " style="color:#ff6633;background-color: #ff6633;" @else class=" " @endif ></li>
			</div>
			<div class="col-md-2">
				<li  @if($order_dealer->order_status === 'delevried')    class="active " style="color:#ff6633;background-color: #ff6633;" @else class="" @endif ></li>
			</div>
		</ul>
    </div>
    <div class="row track-icon">
        <div class="order-block col-md-2" >
            <div class="order-icon "  @if($order_dealer->order_status == 'in_progress') style="color:#ff6633;background-color: #ff6633;" @endif>
                <i class="fa fa-exclamation-triangle" ></i>
                <h3 > {{ __('admin.in_progress') }} </h3>
            </div>
        </div>


        <div class="order-block col-md-2">
            <div class="order-icon" @if($order_dealer->order_status == 'in_prepration') style="color:#ff6633;background-color: #ff6633;" @endif>
                <i class="fa fa-shopping-cart"></i>
                <h3> {{ __('admin.in_prepration') }} </h3>
            </div>
        </div>

        <div class="order-block col-md-2">
            <div class="order-icon" @if($order_dealer->order_status == 'on_delevery') style="color:#ff6633;background-color: #ff6633;" @endif>
                <i class="fa fa-truck"></i>
                <h3> {{ __('admin.on_delevery') }}  </h3>
            </div>
        </div>

        <div class="order-block col-md-2">
            <div class="order-icon "  @if($order_dealer->order_status == 'delevried') style="color:#ff6633;background-color: #ff6633;" @endif>
                <i class="fa fa-check "></i>
                <h3> {{ __('admin.delevried') }} </h3>
            </div>
        </div>

       
    </div>
</div>
@endforeach
@stop

