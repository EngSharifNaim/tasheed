@extends('layouts.cp')
@section('page_title')
    {{ __('site.my_favourite_products') }}
@stop
@section('content')


            <div class="col-lg-9 content-copouns">
                <div class="container">
        <div class="" style="margin:0 0 15px">
            <div class="justify-content-lg-center">
                <div class="" id="fvourite_products">
                    @if( count($products) > 0  )
                    <table class="table ">
                        <thead>
                        <tr class="card-head">
                            <th class="table-1">{{ __('site.productss') }}</th>

                            <th class="table-3">{{ __('site.product_price') }}</th>
                            <th>{{ __('site.total_price') }}</th>
                            <th>{{ __('site.aldelete') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key=>$value )
                        <tr>
                            <td>
                                <div class="media">
                                    <a class="thumbnail " href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $value->product->name_ar) }}@else{{ str_replace(' ', '_', $value->product->name_ar) }} @endif/{{$value->product->id}}"> <img class="media-object img-fluid" src="{{ url('/public') }}{{$value->product->image}}" style="width:100px;height:100px;"> </a>
                                    <div class="">
                                        <h4 class="card-heading">
                                            <a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $value->product->name_ar) }}@else{{ str_replace(' ', '_', $value->product->name_ar) }} @endif/{{$value->product->id}}" >@if(Lang::locale() =='ar') {{ $value->product->name_ar }} @else {{ $value->product->name_en }} @endif</a> </h4>
                                        <h6>
                                            <a href="javascript:void(0)" class="card-heading2"> @if(!empty($value->product->countries_products) ){{ __('site.manf_country') }} : {{ $value->product->countries_products->name_ar  }} @endif</a>    @if(!empty($value->product->mainsection)  ) , <a href="{{ url('/main-section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $value->product->mainsection->name_ar) }}@else {{ str_replace(' ', '_', $value->product->mainsection->name_en) }} @endif/{{$value->product->mainsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $value->product->mainsection->name_ar }}@else{{ $value->product->mainsection->name_en }} @endif  </a>@endif  @if(!empty($value->product->subsection) ) -> <a href="{{ url('/section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $value->product->mainsection->name_ar) }}/{{ str_replace(' ', '_', $value->product->subsection->name_ar) }}@else{{ str_replace(' ', '_', $value->product->mainsection->name_en) }}{{ str_replace(' ', '_', $value->product
                                            ->subsection->name_en) }} @endif/{{$value->product->subsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $value->product->subsection->name_ar }}@else{{ $value->product->subsection->name_en }} @endif </a>@endif
                                        </h6>
                                        @if(!empty($value->product->brands)) <h5 class="card-heading3">  <a href="{{ url('/brand') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $value->product->brands->name_ar) }}@else{{$value->product->brands->name_en}}@endif/{{$value->product->brands->id}}"> @if(Lang::locale() == 'ar') {{ $value->product->brands->name_ar }} @else {{ $value->product->brands->name_en }} @endif </a></h5>@endif
                                    </div>
                                </div>
                            </td>
                            <td >
                                @if($value->product->min_price )
                                    <p class="offer-non-sale"> {{ $value->product->min_price }}</p> <p class="offer-sale"> {{ $value->product->price }}</p> <p class="offer-info"> {{ __('site.difference_money') }} {{$value->product->price - $value->product->min_price  }} {{__('site.sr')}} </p>
                                @endif
                            </td>
                            <td ><p class="offer-non-sale">@if($value->product->min_price ) {{ $value->product->min_price }} @else {{ $value->product->price }} @endif</p></td>
                            <td class="offer-non-sale">
                                <a href="javascript:void(0)" id="deleteitem" data-product_id="{{$value->product->id}}" >{{ __('site.delete') }}</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>                    
                    @else
                        <div class="row">
                            <div class="col-lg-12 ">
                                <p  class="">{{ __('site.no_product_in_favoyrite') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
            </div>
        </div>
    </div>






@stop

@section('page_scribt')
    <script type="text/javascript">
        //delete from favourite
        $(document.body).on('click', "a[id=deleteitem]", function(e){
            var product_id = $(this).data("product_id");
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/remove-item-favourite')}}",
                data:'product_id='+product_id ,
                success: function (response) {
                    $("#fvourite_products").html(response);
                    $.bootstrapGrowl("  {{  __('site.favourite_product_delete') }} ",{
                        type: 'success',
                        delay: 2000,
                        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                        align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                        width: 500, // (integer, or 'auto')
                        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                        allow_dismiss: true, // If true then will display a cross to close the popup.
                        stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                        //  position: absolute

                    });
                }
            });
        }) ;
        //add favourite products to cart only product with quantity > 0
        $(document.body).on('click', "button[name=add_to_cart]", function(e){
            //
            //
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/add-favourite-to-cart')}}",
                data:'user_id='+'{{Auth::user()->id}}' ,
                success: function (response) {
                    $("#fvourite_products").html(response);
                    $.bootstrapGrowl(" {{ __('site.added_from_favourite_to_cart') }} ",{
                        type: 'success',
                        delay: 2000,
                        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                        align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                        width: 500, // (integer, or 'auto')
                        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                        allow_dismiss: true, // If true then will display a cross to close the popup.
                        stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                        //  position: absolute

                    });
                }
            });
        }) ;
        </script>
    @stop


