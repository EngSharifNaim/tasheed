@extends('layouts.app')
@section('page_title')
    {{ __('site.cart') }}
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
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active">{{ __('site.cart') }}</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
</br>
    <div class="container">
        <div class="cart-table">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10 data_cart">
                    @if(count(Cart::content()) > 0 )
                    <table class="table  table-bordered table-responsive">
                        <thead>
                        <tr class="card-head">
                            <th class="table-1">{{ __('site.productss') }}</th>
                            <th class="table-2">{{ __('site.quantity') }}</th>
                            <th class="table-3">{{ __('site.product_price') }}</th>
                            <th>{{ __('site.total_price') }}</th>
                            <th>{{ __('site.aldelete') }}</th>
                        </tr>
                        </thead>
                        <tbody> <?php $cupon=0 ; ?>
                        @foreach(Cart::content() as $row)
                            <div id="loading" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 150px;margin-left: auto;width: 0%;z-index: 999999;">
                                <img src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
                            </div>
                            <tr class="white parent" id="{{ $row->rowId }}" @if($row->model->min_price > 0 ) data-min_price[]="{{ $row->model->price - $row->model->min_price }}" @endif>
                            <td>
                                <div class="media">
                                    <a class="thumbnail " href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $row->model->name_ar) }}@else{{ str_replace(' ', '_', $row->model->name_ar) }} @endif/{{$row->model->id}}">
                                        <img style="max-width: 120px !important; width: 120px;height: 130px;" class="media-object img-fluid" src="{{ url('/public') }}{{ $row->model->image }}" > </a>
                                    <div >
                                        <h4 class="card-heading">@if(Lang::locale() == 'ar'){{ $row->model->name_ar }} @else {{ $row->model->name_ar }} @endif</h4>
                                        <h4><a href="javascript:void(0)" class="card-heading2"> @if($row->model->countries_products  ){{__('site.manf_country')}}  : @if(Lang::locale() == 'ar'){{ $row->model->countries_products->name_ar }} @else {{ $row->model->countries_products->name_ar }} @endif @endif,
                                                 @if(!empty($row->model->mainsection)  ) <a href="{{ url('/main-section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $row->model->mainsection->name_ar) }}@else {{ str_replace(' ', '_', $row->model->mainsection->name_en) }} @endif/{{$row->model->mainsection->id}}"><small> @if(Lang::locale() == 'ar' ) {{ $row->model->mainsection->name_ar }}@else{{ $row->model->mainsection->name_en }} @endif   </small></a>@endif
                                                 @if(!empty($row->model->subsection) )-> <a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $row->model->mainsection->name_ar) }}/{{ str_replace(' ', '_', $row->model->subsection->name_ar) }}@else{{ str_replace(' ', '_', $row->model->mainsection->name_en) }}{{ str_replace(' ', '_', $row->model->subsection->name_en) }} @endif/{{$row->model->subsection->id}}"> <small>@if(Lang::locale() == 'ar' ) {{ $row->model->subsection->name_ar }}@else{{ $row->model->subsection->name_en }} @endif</small></a> @endif
                                            </h4>
                                        <h5 class="card-heading3">  @if($row->model->brand_id > 0 && !empty($row->model->brands))
                                                <a href="{{ url('/brand') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $row->model->brands->name_ar) }}@else{{$row->model->brands->name_en}}@endif/{{$row->model->brands->id}}" >@if(Lang::locale() == 'ar') {{ $row->model->brands->name_ar }} @else {{ $row->model->brands->name_en }} @endif</a>
                                            @endif
                                            @if($row->model->user)
                                                <a href="{{ url('dealer-profile') }}/{{ str_replace(' ', '_', $row->model->user->name) }}/{{$row->model->product_owner_id}}"> {{ $row->model->user->name }}</a></h5>
                                            @endif
                                    </div>
                                </div>
                            </td>
                            <td class="numbers-box " >
                                <input type="number" style="width:70px" data-row_id="{{ $row->rowId }}" name="qty" class="form-control updatecartqty {{ 's_'.$row->rowId }} " id="{{ 's_'.$row->rowId }} " value="{{ $row->qty }}">
                            </td>
                            <td >
                                @if($row->model->min_price > 0 )
                                    <p class="offer-non-sale"> {{ $row->price }}</p> <p class="offer-sale"> {{ $row->model->price }}</p>
                                    <p class="offer-info"> {{ __('site.difference_money') }} {{$row->model->price - $row->model->min_price  }} {{__('site.sr')}} </p>
                                   @if($row->options->cupon_code > 0 )  <?php if($row->model->min_price > 0 ) { $cupon+=  $row->model->min_price - $row->price ; }else{ $cupon+=  $row->model->price - $row->price ;  } ?>  <p class="offer-info"> {{ __('site.provided_bu_cupon') }} {{$row->model->price - $row->price  }} {{__('site.sr')}} </p> @endif
                                 @else
                                    <p class="offer-non-sale"> {{ $row->model->price }}</p>
                                @endif
                            </td>
                            <td ><p class="offer-non-sale">{{ $row->price * $row->qty }}</p></td>
                            <td class="offer-non-sale">
                                <a href="javascript:void(0)" data-value="{{ $row->rowId }}" class="delete_from_cart">{{ __('site.delete') }}</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="total-price">
                                :{{ __('site.total_maney_after_tax') }} <span>{{ Cart::total() }}</span>  {{ __('site.sar') }}
                            </p>
                            <p class="total-price">
                                :{{ __('site.shiping_maney') }} <span>{{ $shiping_price  }}</span> {{ __('site.sar') }}
                            </p>
                            <form class="form-inline">
                                <div class="form-group">
                                    <input type="txt" name="cupon" class="form-control copoun-input" id="cupon" placeholder="{{ __('site.cupons') }}">
                                    <button type="button" name="usecupon" class="btn btn-primary use-btn form-control">{{ __('site.use_cupons') }}</button>
                                </div>
                            </form>
                            <p class="total-disc">
                               {{ __('site.provided_maney') }} : <span> {{ $cupon }} {{ __('site.sar') }}</span>
                            </p>
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            <p class="total-left">
                               {{ __('site.total_maney') }} :{{ Cart::subtotal()  }} {{ __('site.sar') }}
                            </p>
                            <p class="tax">
                                +                     {{ __('site.added') }} 5% {{__('site.taxes')}}
                            </p>
                            <hr>
                            <p class="total-price-left">
                                {{ __('site.total_paind_maney') }} : <span> {{ round(Cart::total(),3)  + round($shiping_price,2)     }} </span>
                            </p>
                            <hr>
                            <button type="button" onclick="window.location.href='{{ url('checkout') }}'" class="btn btn-warning order-btn">{{ __('site.do_request') }}</button>
                        </div>
                    </div>
                   @else
                        <div class="col-lg-12 cart-inf--top">
                            <div class="col-lg-4">
                                <h2 class="cart-info-text"> <span> {{ __('site.cart_no_items') }} </span></h2>
                            </div>
                        </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
    <!--End new product slider -->
	@if(Auth::user())
    @if( count( Auth::user()->products_view) > 0 && Auth::user()  )
        <div class="container">
            <div class="col-lg-12">
                <div class="last-viewed-header">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-5">
                            <h2 class="top-header-last-viewed1 ">{{ __('site.last_view_products') }} </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="container lazy slider">
		@if(Auth::user())
            @foreach( Auth::user()->products_view as $key=>$value )
                @if(!empty($value->product))
                @if($key >  15) @break @endif
                <div>
                    <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
                        <img style="width:260px;height: 212px ;" src="{{ URL::to('public') }}{{ $value->product->image }}">
                        @if($value->product->min_price > 0 && !empty($value->product->min_price))
                            <div class="triangle3-1">
                                <span class="offer">{{ __('site.descount') }} {{ round((( $value->product->price - $value->product->min_price ) / $value->product->price ) * 100 , 2 )  }}%</span>
                            </div>
                        @endif
                        <figcaption>
                            <button  type="submit" class="btn quick-view product_model_link" data-toggle="modal" data-target="#show_product_model"  value="{{ $value->product->id }}">
                                {{ __('site.fast_show') }}
                            </button>
                        </figcaption>
                    </figure>
                    <div class="pro-info">
                        <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $value->product->name_ar) }}@else{{ str_replace(' ', '_', $value->product->name_ar) }} @endif/{{$value->product->id}}" > @if(Lang::locale() == 'ar') {{ $value->product->name_ar }} @else {{ $value->product->name_en }} @endif</a> </h5>
                        <p>@if(Lang::locale() == 'ar') {!! nl2br(str_limit(trim($value->product->description_ar), $limit = 40, $end = '  ')) !!} @else {!! nl2br(str_limit(trim($value->product->description_en), $limit = 80, $end = '  ')) !!} @endif</p>
                        <p>@if($value->product->min_price > 0 && $value->product->min_price < $value->product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $value->product->price }}</span>     <span class="offer-non-sale">{{ $value->product->min_price }} </span> @else  <span class="offer-non-sale">{{ $value->product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>
                        @if(count($value->product->reviews) > 0 )
                            @for($i = 0 ; $i < 5 ; $i++ )
                                <span class="fa fa-star @if($i < $value->product->reviews->sum('rating') / count($value->product->reviews ) )checked @endif"></span>
                            @endfor
                        @endif
                        <span>({{ $value->product->views }})</span>
                    </div>
                    <div class="cart-btn">
                        <a href="javascript:void(0)" value="{{ $value->product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems">{{ __('site.add_to_cart') }}   </a>
                    </div>
                </div>
                @endif
                
            @endforeach 
			@endif
        </section>
    @endif
    @endif
    </br>
@stop
@section('page_scribt')
    <script type="text/javascript" >
        $(document.body).on('click', "button[name=usecupon]", function(e){
            var cupon = $('input[name=cupon]').val() ;
            if( cupon == ""  ){
                alert('{{ __('site.cupon_must_enter') }}') ;
                $.bootstrapGrowl(response,{
                    type: 'danger',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 500, // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,
                });
            }else{
                $.ajax({
                    type: "get",
                    dataType: "html",
                    url: "{{url('/check-cupon-valid')}}",
                    data:'cupon='+cupon,
                    success: function (response) {
                        if(response == 1 ){
                            $.ajax({
                                type: "post",
                                dataType: "html",
                                url: "{{url('/use-cupon')}}",
                                data:'cupon='+cupon,
                                success: function (response) {
                                    $(".data_cart").html(response);
                                }
                            });
                        }else{
                            $.bootstrapGrowl(response,{
                                type: 'danger',
                                delay: 2000,
                                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                                align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                                width: 500, // (integer, or 'auto')
                                delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                                allow_dismiss: true, // If true then will display a cross to close the popup.
                                stackup_spacing: 10 ,
                            });
                        }
                    }
                });
            }
        }) ;
        $(document.body).on('change', "input[name=qty]", function(e){
            var row_id = $(this).data("row_id");
            var classname = 's_'+row_id;
            var qty = $(this).val();
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/update_cart')}}",
                data:'row_id='+row_id+'&qty='+qty,
                success: function (response) {
                    if (response.length != 0 && response.length != "" ) {
                        $(".data_cart").html(response);
                        $.bootstrapGrowl('تم تغير كميه المنتج ',{
                            type: 'success',
                            delay: 2000,
                            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                            width: 500, // (integer, or 'auto')
                            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                            allow_dismiss: true, // If true then will display a cross to close the popup.
                            stackup_spacing: 10 ,
                        });
                    }else{
                        $.get("{{url('/getcartdata')}}")
                            .done(function (data) {
                                    $('.data_cart').html(data);
                            });
                        $.bootstrapGrowl('هذه الكميه هيه الحد الادنى ولا يمكن ان تقل  عن ذلك ',{
                            type: 'danger',
                            delay: 2000,
                            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                            width: 500, // (integer, or 'auto')
                            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                            allow_dismiss: true, // If true then will display a cross to close the popup.
                            stackup_spacing: 10 ,
                        });
                        $.bootstrapGrowl('الرجاء زياده الكميه لتكمله الطلب ',{
                            type: 'danger',
                            delay: 2000,
                            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                            width: 500, // (integer, or 'auto')
                            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                            allow_dismiss: true, // If true then will display a cross to close the popup.
                            stackup_spacing: 10 ,
                        });
                    }
                    $.get("{{url('getcartcount')}}")
                        .done(function (data) {
                            if (data.length != 0 && data.length != "" ) {
                                $('#cartcount').html(data);
                            }
                        });
                }
            });
        }) ;
        //
        $(document.body).on('click', "a[class=delete_from_cart]", function(event){
            var row_id = $(this).data("value");
          //  alert(row_id) ;
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/delete-cart-item')}}",
                data:'row_id='+row_id,
                beforeSend:function(){
                    $('#loading').show('fast');
                },
                success: function (response) {
                    $("tr[id="+row_id+"]").remove();
                    $(".data_cart").html(response);
                    $.get("{{url('getcartcount')}}")
                        .done(function (data) {
                            if (data.length != 0) {
                                $('#cartcount').html(data);
                            }
                        });
                }
            });
        }) ;
    </script>
@stop



