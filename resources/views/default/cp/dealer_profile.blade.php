@extends('layouts.app')
@section('page_title') {{ $user->name }} @stop
@section('content')
<section class="bread">
	<div class="container">
		<div class="row bread-crumb">
			<div class="col-lg-8">
				<ul>
					<li><a href="{{ url('/') }}"> {{ __('site.home_page') }} <i class="fas fa-angle-left"></i>  </a></li>
					<li><a class="active">  {{ __('site.dealer_page') }} <i class="fas fa-angle-left"></i></a></li>
					<li><a class="active"> {{ $user->name }} </a></li>
				</ul>
			</div>
			<div class="col-lg-4 search-category">
				<form method="get" action="{{ url('/search-in-dealer') }}">
				<input type="hidden" name="dealer_id" value="{{ $user->id }}" >
				<input data-brackets-id="33242" name="search" class="form-control search-category-form  filter-form" type="text" placeholder="{{ __('site.search_in_dealer') }} {{ $user->name }}">
				<i class="fas fa-search cetgory-serchbox"></i>
				</form>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="user-t clearfix">
			<div class="user-img">
				<img src="@if(!empty($user->photo)){{url('/public')}}{{$user->photo}}@else{{ URL::to('public') }}{{theme_url('images/avatar.png')}}@endif" />
			</div>
			<div class="user-caption">
				<ul class="list-unstyled">
					<li><span>{{ __('site.register_name') }} :</span> {{ $user->name }}</li>
					@if(!empty($user->companie))
					<li><span>{{ __('site.company') }} :</span>@if(Lang::locale() == 'ar') {{ $user->companie->name_ar }} @else {{ $user->companie->name_en }} @endif </li>
					<li><span>{{ __('site.phone') }} :</span> {{ $user->companie->phone }}</li>
					<li><span>{{ __('site.company_email') }} :</span> {{ $user->companie->email }} </li>
					<li><span>الموقع :</span><a href="{{ $user->companie->location }}" target="_blank">الموقع على الخريطة</a>  </li>
					@endif
					<li><span>الوصف :</span> {{ $user->describtion }} </li>
				</ul>
			</div>
		 <div class="stars">
				<ul class="list-inline">
				@if(count($user->reviews->toArray()) > 0 )
					@for($i = 0 ; $i < 5 ; $i++ )  
						<li class="list-inline-item"><i class="@if($i <  ($user->reviews->sum('rating')/count($user->reviews)) )fas fa-star @else far fa-star @endif  "></i></li>
					@endfor
				@endif
				</ul>
			</div> 
			
		</div>
			<div class="bar-user">
				<ul class="list-inline">
					<li class="list-inline-item"><a href="@if(isset($user->companie->company_website)){{$user->companie->company_website}}@else#@endif" target="_blank">{{ __('site.visit_company_website') }}</a></li>
					<li class="list-inline-item"><a data-toggle="modal"  href="#myModal">{{ __('site.chat_with_dealer') }}</a></li>
					
						<!--- <li class="list-inline-item"><a href="#">تقييم التاجر</a></li>  ---->
				</ul>
			</div>
	</div>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">{{ __('site.send_messages_dealer') }}</h4>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form>
						<input type="hidden" name="dealer_id" value="{{$user->id}}">
						<div class="form-group">
							<textarea style="min-height: 160px;" name="message" id="message" required="true" class="form-control" placeholder="{{ __('site.your_message') }}"></textarea>
						</div>
						<div class="form-group">
							<input  id="submit_message" value="{{__('site.send_message')}}" class="btn btn-primary" />
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('site.close') }}</button>
				</div>

			</div>
		</div>
	</div>

</section>
<div class="container">
	@if(count($products) > 0 )
	<div class="row">
		<div class="col-lg-3">
			<h2 class="filter-head"> {{ $user->name }} </h2>
			<form name="filter_form" >
				<div class="fliter-sidebar">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<p style="margin-left: auto;">{{ __('site.according_list') }}</p>
									<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<i class="arrow-fliter fas fa-angle-double-up"></i>
									</button>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
								<div class="card-body">
									<div class="form-group">
										<select name="list_order" class="form-control" id="exampleFormControlSelect1">
											<option value="last">{{ __('site.last_first') }}</option>
											<option value="old">{{ __('site.old_first') }}</option>
											<option value="most_sale">{{ __('site.most_sale') }}</option>
											<option value="lowest_sale">{{ __('site.lowest_sale') }}</option>
											<option value="bigest_price">{{ __('site.bigest_price') }}</option>
											<option value="lowesr_price">{{ __('site.lowesr_price') }}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingTwo">
								<div class="mb-0">
									<p style="    margin-left: auto;">{{ __('site.all_related_section') }}</p>
									<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										<i class="arrow-fliter fas fa-angle-double-up"></i>
									</a>
								</div>
							</div>
							<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
								<div class="card-body">
									<div id="loadingsection" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 250px;margin-left: 40%;width: 0%;z-index: 999999;">
										<img src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
									</div>
									<input class="form-control  filter-form" name="filter_form_category_search[]"  type="text" placeholder="البحث حسب الفئة">
									<div id="section_result" >
										@foreach($sections as $section )
											<div class="form-check">
												<label class="form-check-label">
													<input type="checkbox" class="form-check-input" name="category[]" value="{{ $section->id }} ">@if(Lang::locale() == 'ar' ) {{ $section->name_ar }} @else {{ $section->name_en }} @endif
												</label>
											</div>
											@foreach($section->has_sub as $sub )
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input" name="subcategory[]" value="{{ $sub->id }} ">@if(Lang::locale() == 'ar' ) {{ $sub->name_ar }} @else {{ $sub->name_en }} @endif
													</label>
												</div>
												@foreach($sub->subsections as $sub_sub )
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" class="form-check-input" name="subsubcategory[]" value="{{ $sub_sub->id }} ">@if(Lang::locale() == 'ar' ) {{ $sub_sub->name_ar }} @else {{ $sub_sub->name_en }} @endif
														</label>
													</div>
												@endforeach
											@endforeach
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFour">
								<div class="mb-0">
									<p style="    margin-left: auto;">{{ __('site.brands_side_bar') }}</p>
									<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										<i class="arrow-fliter fas fa-angle-double-up"></i>
									</a>
								</div>
							</div>
							<div id="collapseFour" class="collapse show" aria-labelledby="headingFour">
								<div class="card-body">
									{{-- <input data-brackets-id="33242" class="form-control  filter-form" type="text" placeholder="البحث حسب الفئة">
                                    --}} <div class=" brands-filter">
										@foreach($brands as $brand)
											<div class="check-item">
												<input type="checkbox" name="brand[]"  class="check-filter" aria-label="Checkbox for following text input" checked="true">
												<p class="check-text">{{ $brand->name_ar }} @if($brand->product)({{ count($brand->product) }}) @endif</p>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFive">
								<div class="mb-0">
									<p style="    margin-left: auto;">السعر</p>
									<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										<i class="arrow-fliter fas fa-angle-double-up"></i>
									</a>

								</div>
							</div>
							<div id="collapseFive" class="collapse show" aria-labelledby="headingFive">
								<div class="card-body">
									<div id="wrapper">
										<div class="row" style="margin:0 0 20px">
											<div class="col"><input id="input2" type="text" class="form-control"></div>
											<div class="col"><input id="input1" type="text" class="form-control"></div>
										</div>
										<div id="slider"></div>
									</div>
								</div>
							</div>
						</div>
						<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.min.js')}}" type="text/javascript"></script>
						<script src="{{ URL::to('public') }}{{theme_url('vendors/js/nouislider.min.js')}}"></script>

						<script type="text/javascript">
                            var $slider = $('#slider');
                            var $input1 = $('#input1');
                            var $input2 = $('#input2');
                            var $inputs = $('input');

                            noUiSlider.create(slider, {
                                start: [0, 100],
                                connect: true,
                                range: {
                                    'min': 0,
                                    'max': 100
                                }
                            });

                            slider.noUiSlider.on('update', function ( values, handle ) {

                                if (values != 0 || values != 10000000) {
                                    handle == 0 ? $input1.val(values[handle]) : $input2.val(values[handle]);
                                } else {
                                    handle == 0 ? $input1.val("No Min") : $input2.val("No Max");
                                }

                            });

                            $inputs.on('change', function() {
                                if (this == $input1[0]) {
                                    slider.noUiSlider.set([this.value,null]);
                                } else {
                                    slider.noUiSlider.set([null,this.value]);
                                }
                            });
						</script>
					</div>
				</div>
			</form>
			@if(!$adverstisments2->isEmpty() )
				@foreach($adverstisments2 as $ads)
					@if($ads->link)
						<a href="{{ $ads->link }}">   <img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" ></a>
					@else
						<img src="{{ URL::to('/public') }}{{$ads->image}}" class="img-fluid banner-category" >
					@endif
				@endforeach
			@endif
		</div>
		<div class="col-lg-9 filter_result">
			<div class="row product">
				<div id="loading" style="display: none;position: absolute;left: 0;right: 0;margin: auto;margin-top: 250px;margin-left: 60%;width: 0%;z-index: 999999;">
					<img style="width: 120px; height:120px;" src="{{ URL::to('public') }}{{theme_url('images/loading.gif')}}">
				</div>
				<!-- the best products -->
				@foreach($products as $key=>$product)
					<div class="col-md-4">
						<div class="product-best" >
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
								<p>@if(Lang::locale() == 'ar') {{ str_limit(trim($product->description_ar), $limit = 80, $end = '  ')}} @else {{str_limit(trim($product->description_en), $limit = 80, $end = '  ')}} @endif</p>
								<p>@if($product->min_price > 0 && $product->min_price < $product->price ) <span class="old-price" style="font-size : 14px ;"> {{ $product->price }}</span>     <span class="offer-non-sale">{{ $product->min_price }} </span> @else  <span class="offer-non-sale">{{ $product->price }} </span> @endif {{ __('site.sr_soudi') }} </p>

								@if(count($product->reviews->toArray()) > 0 )
									@for($i = 0 ; $i < 5 ; $i++ )
										<span class="fa fa-star @if($i+1 <  ($product->review->sum('rating')/count($product->reviews)) )checked @endif"></span>
									@endfor
								@endif
								<span>( @if($product->views > 0 ) {{ $product->views }} @else 0 @endif )</span>
							</div>
							<div class="cart-btn">
								<a href="javascript:void(0)" value="{{ $product->id }}" class="hvr-shutter-in-horizontal btn addtocart cartitems"> {{ __('site.add_to_cart') }} </a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>

	</div> @else
	<div class="col-lg-6 ">
		<h1> {{ __('site.no_product') }}</h1>
		</br>
	</div>
	@endif
</div>
@stop
@section('page_scribt')
	<script type="text/javascript">
        $('input[id=submit_message]').on('click', function(event){
            var message =  $("#message").val() ;
            var dealer = '{{ $user->id }}' ;
            @if(Auth::user())
			@if(Auth::user()->level == 'user')
            $.post("{{url('send_chat_message')}}",{ message : message , dealer_id :dealer})
                .done(function (data) {
                    if (data != 0) {
                        $.bootstrapGrowl('{{__('site.message_send_well')}}',{
                            type: 'success',
                            delay: 2000,
                            offset: {from: 'top', amount: 20},
                            align: '@if(Lang::locale() == 'ar') right @else left @endif',
                            width: 500,
                            delay: 4000,
                            allow_dismiss: true,
                            stackup_spacing: 10 ,
                        });
                    }else{
                        $.bootstrapGrowl('{{__('site.unknow_error_happen')}}',{
                            type: 'danger',
                            delay: 2000,
                            offset: {from: 'top', amount: 20},
                            align: '@if(Lang::locale() == 'ar') right @else left @endif',
                            width: 500,
                            delay: 4000,
                            allow_dismiss: true,
                            stackup_spacing: 10 ,
                        });
					}
                });
            @else
            $.bootstrapGrowl('{{__('site.chat_message_error')}}',{
                type: 'danger',
                delay: 2000,
                offset: {from: 'top', amount: 20},
                align: '@if(Lang::locale() == 'ar') right @else left @endif',
                width: 500,
                delay: 4000,
                allow_dismiss: true,
                stackup_spacing: 10 ,
            });
			@endif
            @else
            $.bootstrapGrowl('{{__('site.chat_message_login_first')}}',{
                type: 'danger',
                delay: 20000,
                offset: {from: 'top', amount: 20},
                align: '@if(Lang::locale() == 'ar') right @else left @endif',
                width: 500,
                delay: 40000,
				allow_dismiss: true,
                stackup_spacing: 10 ,
            });
			@endif
        }) ;
	</script>
@stop
