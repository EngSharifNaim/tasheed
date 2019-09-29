
@foreach($products as $product )
    <div class="">
        <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
            <img src="{{ URL::to('public') }}{{ $product->image }}">
            <figcaption>
                <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $product->id }}">
                    {{ __('site.fast_show') }}
                </button>
            </figcaption>
        </figure>
        <div class="pro-info">
            <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a> </h5>
            <p>@if(Lang::locale() == 'ar') {{str_limit(trim(strip_tags($product->description_ar)), $limit = 78, $end = '  ')}}@else {{str_limit(trim(strip_tags($product->description_en)), $limit = 80, $end = '  ')}} @endif</p>
          
             <p class="mprice">@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                @if(count($product->review) > 0 )
                        @for($i = 0 ; $i < 5 ; $i++ )
                            <span class="fa fa-star @if( $i+1 < ($product->reviews->sum('rating') / count($product->reviews)) )checked @endif"></span>
                        @endfor
                  @else 
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>                        
                        @endif                  
                        <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if($product->user){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}@endif">@if($product->user){{ $product->user->name }}@endif</a></span> </p>
                        
                         <span style="font-size: 12px;">المشاهدات :@if($product->views > 0 )  {{ $product->views }} @else 0 @endif</span>
                         
          
          <!--
            <p>@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>
            @if(count($product->reviews) > 0 )
                @for($i = 0 ; $i < 5 ; $i++ )
                    <span class="fa fa-star @if($i+1 < ($product->reviews->sum('rating')/count($product->reviews)) )checked @endif"></span>
                @endfor
            @endif
            @if($product->views) <span>({{ $product->views }})</span>@endif
            
            -->
        </div>
       <div class="cart-btn">
                         
                        <a value="{{ $product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                        
                        <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $product->id }}" title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                        </a>
                    </div>
    </div>
@endforeach
