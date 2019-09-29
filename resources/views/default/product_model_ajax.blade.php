<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">  {{ $product->id }}  @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else  {{ $product->name_en }} @endif <small id="contentt" style="padding-right:20px;"> </small> </h5>
  <button type="button" class="close close-view" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-2">
			<div class="tumbs">
            <a id="scrollUp" href="#"><i class="arrows-slider fas fa-angle-double-up"></i></a>
            <div id="wrapper">
                <div id="content">
                    <ul class=" nav nav-tabs  flex-column">
                        @if(!empty($product->image))
                            <li class="thumb active"><a class="thumb-view" data-target="#pic-1" data-toggle="tab">
                                    <img style="width:63px ; height:63px ;" src="{{ URL::to('/public') }}{{$product->image}}" class="img-fluid" /></a></li>
                        @endif
                        @if (!empty($product->images))
                            @foreach( explode(",",$product->images ) as $key=>$image )
                                <li class="thumb"><a class="thumb-view" data-target="#pic-{{ $key +1  }}" data-toggle="tab">
                                        <img style="width:63px ; height:63px ;" src="{{ URL::to('public') }}{{ $image }}" class="img-fluid" /></a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <a id="scrollDown" href="#"><i class="arrows-slider fas fa-angle-double-down"></i></a>
			</div>
		</div>
        <div class="preview col-md-4">
            <div class="preview-pic tab-content">
                @if(!empty($product->image))
                    <?php  $sale_percentage =  round((( $product->price - $product->min_price ) / $product->price ) * 100 , 2 )   ; ?>
                    <div class="tab-pane active" id="pic-1">
                        <img  style="width:296.25px ; height:295.31px ;" src="{{ URL::to('/public') }}{{ $product->image }}" class="img-fluid magnify-image" data-magnify-src="{{ URL::to('/public') }}{{ $product->image }}" />
                        @if($sale_percentage > 0 )
                            <div class="triangle1">
                                <span class="offer">{{ __('site.descount') }} {{ $sale_percentage  }}%</span>
                            </div>
                        @endif
                    </div>
                @endif
                @if (!empty($product->images))
                    @foreach( explode(",",$product->images ) as $key=>$image )
                        <div class="tab-pane" id="pic-{{ $key +1  }}">
                            <img  style="width:295.25px ; height:290.31px ;" src="{{ URL::to('/public') }}{{ $image }}" class="img-fluid magnify-image" data-magnify-src="{{ URL::to('/public') }}{{ $image }}" />
                            @if($sale_percentage > 0 )
                                <div class="triangle1">
                                    <span class="offer">{{ __('site.descount') }} {{ $sale_percentage  }}%</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="details col-md-6">
            <div class="">
                <p>@if($product->min_price > 0 && $product->min_price < $product->price )<span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} <br> <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span></p>
                <p class="provider">{{ __('site.seller') }} : <span><a href="{{ url('/dealer-profile') }}/{{ str_replace(' ', '_', $product->user->name ) }}/{{$product->user->id}}">{{ $product->user->name }}</a></span> </p>
            </div>
            <div class="rating">
                <div class="stars">

                            @if(count($product->reviews) > 0 )
                                @for($i = 0 ; $i < 5 ; $i++ )
                                    <span class="fa fa-star @if($i+1 < ($product->reviews->sum('rating')/count($product->reviews)) )checked @endif"></span>
                                @endfor
                            @endif

                    <span class="review-no"> المشاهدات @if($product->views > 0 )  {{$product->views }} @else 0 @endif  </span>
                </div>
            </div>
            @if(Lang::locale() == 'ar')
                @if(!empty($product->details_ar))
                    <h5>{{ __('site.detailss') }}</h5>
                @endif
                @foreach(explode(",",$product->details_ar ) as $key=>$detail_ar )
                    @if($key==3) @break @endif
                    <p class="product-description"> <i class="fas fa-angle-double-left"></i>{{ $detail_ar }}</p>
                @endforeach
            @else
                @if(!empty($product->details_en))
                    <h5>{{ __('site.detailss') }}</h5>
                @endif
                @foreach(explode(",",$product->details_en ) as $key=>$detail_en )
                    @if($key==3) @break @endif
                    <p class="product-description"> <i class="fas fa-angle-double-left"></i> {{ $detail_en }}</p>
                @endforeach
            @endif
            <h5>
                @if(!empty($product->mainsection)  ) <a href="{{ url('/main-section') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $product->mainsection->name_ar) }}@else {{ str_replace(' ', '_', $product->mainsection->name_en) }} @endif/{{$product->mainsection->id}}"> @if(Lang::locale() == 'ar' ) {{ $product->mainsection->name_ar }}@else{{ $product->mainsection->name_en }} @endif  </a>@endif
            </h5>
            <p class="product-description">
                @if(!empty($product->brands)  ) <a href="{{ url('/brand') }}/@if(Lang::Locale() == 'ar'){{ str_replace(' ', '_', $product->brands->name_ar) }}@else {{ str_replace(' ', '_', $product->brands->name_en) }} @endif/{{$product->brand_id}}"> @if(Lang::locale() == 'ar' ) {{ $product->brands->name_ar }}@else{{ $product->brands->name_en }} @endif  </a>@endif
            </p>
            <div class="action pull-left">
                <button id="{{ $product->id }}" class="add-to-cart btn btn-default " name="cartitems" type="button">{{ __('site.buy_now') }}</button>
            </div>
        </div>
    </div>
</div>