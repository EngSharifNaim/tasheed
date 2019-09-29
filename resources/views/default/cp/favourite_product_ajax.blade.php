@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
@endforeach
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
<div class="row">
    <div class="col-lg-12 float-left-position">
        <button type="button" name="add_to_cart"  class="btn btn-warning order-btn">{{ __('site.buy_now') }}</button>
    </div>
</div>
@else
    <div class="row">
        <div class="col-lg-12 ">
            <p  class="">{{ __('site.no_product_in_favoyrite') }}</p>
        </div>
    </div>
@endif
