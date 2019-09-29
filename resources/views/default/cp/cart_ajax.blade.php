  <?php $cupon=0 ; ?>
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