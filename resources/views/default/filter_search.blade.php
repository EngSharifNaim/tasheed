<style>
.pro-info {
    min-height: 130px;
}

.item-prd {
    margin: 0 0 30px;
}

.product-best {
    margin: 0;
}
</style>
<div class="row product">
    <div id="loading" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 250px;margin-left: 60%;width: 0%;z-index: 999999;">
        <img style="width: 120px; height:120px;" src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
    </div>
    <!-- the best products -->
    @foreach($products as $key=>$product)
{{--        @if(count($product->user->paidacount->get())>0)--}}
{{--        @if($product->user->paidacount->first()->active == 'yes')--}}
        <div class="col-md-4 col-12">
			<div class="item-prd">
            <div class="product-best" >
        <figure class="d-block img-fluid slideheight imghvr-shutter-in-vert">
            <a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" >
                <img src="{{ URL::to('public') }}{{ $product->image }}">
            </a>
            <figcaption>
                <button type="submit"  data-toggle="modal" data-target="#show_product_model"  class="btn  product_model_link" value="{{ $product->id }}">
                    {{ __('site.fast_show') }}
                </button>
            </figcaption>
        </figure>
        <div class="pro-info">
            <h5><a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a> </h5>
            <p>@if(Lang::locale() == 'ar') {{ str_limit(trim(strip_tags($product->description_ar)), $limit = 80, $end = '  ')}} @else {{ str_limit(trim(strip_tags($product->description_en)), $limit = 80, $end = '  ')}} @endif</p>

           
             <p class="mprice">@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

                @if(count($product->review) > 0 )
                        @for($i = 0 ; $i < 5 ; $i++ )
                            <span class="@if( $i < ($product->reviews->sum('rating') / count($product->reviews)) )fas fa-star @else far fa-star @endif"></span>
                        @endfor
                  @else 
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>                        
                        @endif                  
               <p class="madein">{{ __('site.seller') }} : <span><a style="color: #337ab7;font-size: 14px !important"href="@if(!empty($product->user)){{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}@endif">@if($product->user) {{ $product->user->name }} @endif</a></span> </p>
               
                         <span style="font-size: 12px;">المشاهدات :@if($product->views > 0 )  {{ $product->views }} @else 0 @endif</span>
                         
           
            
        </div>
        <div class="cart-btn">
                         
                        <a value="{{ $product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
                        
                        <a href="javascript:void" name="addtofavouriteproduct" data-id="{{ $product->id }}" title=" اضف للمفضلة">
                        <i class="fa fa-heart"></i>
                        </a>
                    </div>
            </div>
			</div>
        </div>
{{--            @endif--}}
{{--        @endif--}}
    @endforeach
	
</div>