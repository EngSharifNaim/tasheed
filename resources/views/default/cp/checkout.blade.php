@extends('layouts.app')
@section('page_title')
    {{ __('site.checkout') }}
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
    <!---model --------------->
    <!--------------- add addresse model ----------->
    <div class="modal fade addaddresse" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content small-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formaddresse">
                    <form  id='form_add_addresse' method="post" action="{{ url('/add-addresses') }}" >
                        <input type="hidden" name="checkoutpage" value="1">
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.addresse_arabic_lang') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="name_ar" class="form-control form-control-" id="colFormLabel" placeholder="{{ __('site.addresse_arabic_lang') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.addresse_english_lang') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="name_en"  class="form-control form-control" id="colFormLabel" placeholder="{{ __('site.addresse_english_lang') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" name="name_en" class="col-sm-3 col-form-label col-form-label">{{ __('admin.city_belong') }}
                            </label>
                            <div class="col-sm-9">
                                <select name="countrie_id" class="form-control " required>
                                    <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                                    @foreach ($countireslist as $countrie)
                                        <option value="{{ $countrie->id }}">@if(Lang::locale() == 'ar') {{ $countrie->name_ar }} @else {{ $countrie->name_en }} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('admin.belongcity') }}</label>
                            <div class="col-sm-9">
                                <select name="citie_id" class="form-control " required>
                                    <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.region_id') }}</label>
                            <div class="col-sm-9">
                                <select name="region_id" class="form-control ">
                                    <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                            <button id="add_addresse" type="submit" class="btn btn-primary save-modal-btn">{{ __('site.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------->
    <!--------------- update addresse model ----------->
    <!----->
    <div class="modal fade addaddresse" id="update_addresse_model" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content small-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formaddresse" id="fast_preview_content_addresse">
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------->
    <!---end addresse model ------------->
    <!----tsart page ------>
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ url('/') }}">{{ __('site.home_page') }}<i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active">{{ __('site.checkout') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
 <!----start page -------------------->
    <div class="container copouns">
        <div class="row " style="">
            <button type="button" onclick="myFunction()"  class="btn btn-warning ">{{ __('site.print_order') }}</button>

        </div>
        <div class="row">
            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endforeach
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
          {{--  <div class="col-lg-12 cart-inf--top">
                <div class="col-lg-4">
                    <h2 class="cart-info-text">مسجل من قبل ؟ <span><a class="register-link-cart" href="#">انقر هنا لتسجيل الدخول</a> </span></h2>
                </div>
            </div>
            <div class="col-lg-12 cart-inf--top">
                <div class="col-lg-4">
                    <h2 class="cart-info-text">هل لديك قسيمة ؟<span><a class="register-link-cart2" href="#">انقر هنا لادخال رمز</a> </span></h2>
                </div>
            </div>--}}
            <div class="col-lg-12 cart-inf--top">
                <div class="col-lg-8">
                    <h2 class="cart-info-text">   <span><a class="register-link-cart2" href="javascript:void(0)">{{ __('site.first_choose_addresse') }}</a> </span></h2>
                </div>
            </div>
            <div class="col-lg-12 content-copouns">
                <div class="row" id="addresse_user">
                    @if(count(Auth::user()->users_addresse) != 0 )
                    @foreach(Auth::user()->users_addresse as $key=>$addresse )
                    <div class="col-lg-4" style="padding-top:5px;">
                        <div class="header-customer">
                            <h4 class="head-log">{{ __('site.contact_address') }}  {{ $key +1  }}</h4>
                             @if(count(Auth::user()->users_addresse) > 1 && $addresse->active != 'yes'  )  <a href="javascript:void(0)" class="delete_addresse" data-delete_addresse_id="{{ $addresse->id }}"><i class="fas fa-trash-alt edite-data"> </i></a>@endif
                             <a href="javascript:void(0)" class="update_addresse" data-update_addresse_id="{{ $addresse->id }}"><i class="fas fa-pencil-alt edite-data"></i></a>
                        </div>
                        <div class="inner-data">
                            <p class="user-data"> <i class="fas fa-id-card"></i> {{ Auth::user()->name }}</p>
                            <p class="user-data">
                                <i class="fas fa-map-marker"></i>@if(Lang::locale() =='ar') {{ $addresse->addresse_ar }} @else {{ $addresse->addresse_en }} @endif <br>
                                @if($addresse->region_id > 0 )@if(Lang::locale() =='ar')  {{ $addresse->region->name_ar }} @else {{ $addresse->region->name_en }} @endif  @endif
                                <br>  - @if(Lang::locale() =='ar') {{ $addresse->citie->name_ar }} @else {{ $addresse->citie->name_en }} @endif<br> @if(Lang::locale() =='ar'){{  $addresse->countrie->name_ar }}@else {{  $addresse->countrie->name_ar }} @endif
                            </p>  <hr>
                            <p class="user-data"> <i class="fas fa-phone"></i> {{ Auth::user()->phone }}</p>
                            <button type="button" name="use_this_addresse" data-active_addresse_id="{{ $addresse->id }}" class="btn btn-warning @if($addresse->active == 'yes') address-btn @else address-btn-second @endif">@if($addresse->active == 'yes') {{ __('site.active_addresse') }}@else {{ __('site.use_this_addresse') }}@endif</button>
                        </div>
                    </div>
                    @endforeach
                    @else
                        {{ __('site.no_addresse_yet') }}
                    @endif
                </div>
            </div>
                @if(Auth::user()->level == 'user' )
                    <div class="row" style="margin-right:50%">
                        <button type="button" data-toggle="modal" data-target="#Modal" data-whatever="@mdo" class="btn btn-warning add-address">{{ __('site.add_new_addresse') }}</button>
                        <hr>
                    </div>
                @else
                    @if(count(Auth::user()->users_addresse) == 0    )
                        <div class="row " style="margin-right:50%">
                            <button type="button" data-toggle="modal" data-target="#Modal" data-whatever="@mdo" class="btn btn-warning add-address">{{ __('site.add_new_addresse') }}</button>
                            <hr>
                        </div>
                    @endif
                @endif
        </div>
        <hr>
        <!----  الطلب مقسم على تجار ---->
        @foreach($vendors as $key=>$vendor )
        <?php $total = 0 ; $tax = 0 ;  $shiping_for_vendor = 0 ; ?>
            <h1> {{ __('site.dealer_name') }} : <a href="javascript:void(0)"  class="clickshowmessage"> {{ $vendor->name  }}  </a>  </h1>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr class="checkout-tb">
                <th scope="col-lg-3" class="pr-head">{{ __('site.the_product') }}</th>
                <th scope="col">{{__('site.the_qty')}}</th>
                <th class="total-order" scope="col">{{ __('site.the_total') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Cart::content() as $row)
            @if( $row->options->product_owner == $vendor->id )
            <tr>
                <td class="col-lg-3 pr-info">@if(Lang::locale() =='ar') {{ $row->model->name_ar }} @else  {{ $row->model->name_en }} @endif  @if($row->model->brand)  + @if(Lang::locale() =='ar') {{ $row->model->brand->name_ar }} @else  {{ $row->model->brand->name_en }} @endif @endif</td>
                <td class="or-quantity">{{ $row->qty }}</td>
                <td class="order-number-rs">{{ $row->subtotal }} <span class="rs-total">{{ __('site.sr_soudi') }}</span></td>
            </tr>
            <?php $total += $row->total ;  $tax += $row->tax * $row->qty ; $shiping_for_vendor += $row->qty * $row->options->shiping_price ;  ?>
            @endif
            @endforeach
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.order_shiping') }}</td>
                <td class="order-number-rs">{{ $shiping_for_vendor }}</td>
            </tr>
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.order_tax') }}</td>
                <td class="order-number-rs">{{ $tax }}</td>
            </tr>
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.total_price') }}</td>
                <td class="order-number-rs">{{ $total+$shiping_for_vendor }}</td>
            </tr>
            </tbody>
        </table>
            <hr>
        @endforeach
        <h1>{{ __('site.total_order') }}</h1>
        <table class="table table-bordered second-tb table-responsive">
            <thead>
            <tr class="checkout-tb-sec">
                <th scope="col-lg-3" class="pr-head">{{ __('site.the_product') }}</th>
                <th scope="col">{{__('site.the_qty')}}</th>
                <th class="total-order" scope="col">{{ __('site.the_total') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Cart::content() as $row)
            <tr>
                <td class="col-lg-3 pr-info">@if(Lang::locale() =='ar') {{ $row->model->name_ar }} @else  {{ $row->model->name_en }} @endif  @if($row->model->brand)  + @if(Lang::locale() =='ar') {{ $row->model->brand->name_ar }} @else  {{ $row->model->brand->name_en }} @endif @endif</td>
                <td class="or-quantity">{{ $row->qty }}</td>
                <td class="order-number-rs">{{ $row->price }} <span class="rs-total">{{ __('site.sr_soudi') }}</span></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.total_price_no_tax') }}</td>
                <td class="order-number-rs">{{ cart::subtotal() }} </td>
            </tr>
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.total_price_with_tax') }}</td>
                <td class="order-number-rs">{{ cart::total() }} </td>
            </tr>
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.shiping_maney') }}{{--<br> <p class="shipping-details">شحن الى (الرياض) وزن = 15 ك.جـ تكلفة اساسية 40 ريال + 10 ريال لكل كيلو جرام</p>--}} </td>
                <td class="order-number-rs">{{ $shiping_price }} <span class="rs-total">{{ __('site.sr') }}</span></td>
            </tr>
            <tr>
                <td colspan="2" class="or-quantity">{{ __('site.total_price') }}</td>
                <td class="order-number-rs">{{ round(Cart::total(), 2)  + round($shiping_price, 2)     }} </td>
            </tr>
            </tbody>
        </table>
        <!--start form ---->
        <form class="form-inline notes" method="post" action="{{ url('save-order') }}" enctype="multipart/form-data">
        <div class="row">
               
            <div class="form-group mx-sm-6 mb-2" style="float:left;" >
                <button  type="submit" class="btn btn-primary  notes-btn-sec"> {{ __('site.confirm_order') }} </button>
            </div>
        </div>
      {{--      <div class="row">
        <hr>
        <h1>{{ __('site.way_of_payment') }}</h1>
            </div>--}}

            <!---
        <div class="col-lg-12 checkout-form">
                <div class="form-check payment-select">
                    <input class="form-check-input" checked="true" type="radio" id="gridCheck" name="pay_type" value="oncash" data-inputtype="on_deliver">
                    <label class="form-check-label payment" for="gridCheck"> {{ __('site.pay_on_deliver') }} </label>
                </div><br>
                <p class="payment-cod-info " id="cash_details" >
                    @if(Lang::locale() == 'ar' ) @if(isset($settings['checkout_message_ar'])) {{ $settings['checkout_message_ar'] }} @endif @else  @if(isset($settings['checkout_message_en'])) {{ $settings['checkout_message_en'] }} @endif @endif
                    <br>
                <div class="form-check payment-select">
                    <input class="form-check-input payment_bank" type="radio" id="gridCheck"  name="pay_type" value="transfer_bank" data-inputtype="transfer_bank">
                    <label class="form-check-label payment" for="gridCheck">{{ __('site.transfer_bank') }}</label>
                </div>
                <br>
                <br>
                <div class="row" id="payment_details" >
                    <div class="col-lg-5">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-md-5 col-form-label label-cust"> {{ __('site.acount_owner_name') }}<span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-7">
                                <input type="text" class="form-control" id="acount_owner_name" name="acount_owner_name" placeholder="{{ __('site.acount_owner_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-md-5 col-form-label label-cust">{{ __('site.acount_owner_number') }} <span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-7">
                                <input type="text" class="form-control" id="bank_user_number" name="bank_user_number" placeholder="{{ __('site.acount_owner_number') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputState" class="col-sm-2 col-md-5 col-form-label label-cust">{{ __('site.transfer_to_acount') }}<span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-7">
                                <input type="text" class="form-control" id="dealer_bank_number" name="dealer_bank_number" placeholder="{{ __('site.acount_owner_number') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputState" class="col-sm-2 col-md-5 col-form-label label-cust">{{ __('site.acount_name') }}<span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-7">
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="{{ __('site.acount_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-2 col-md-5 col-form-label label-cust">{{ __('site.transfer_image') }}<span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="file" name="image" class="form-control" id="photo"  id="photo">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-md-5 col-form-label label-cust">{{ __('site.total_transfer_maney') }}<span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control" id="total_transfer_maney" name="total_transfer_maney" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <textarea name="pay_notes" class="form-control" placeholder="{{ __('site.pay_notes') }}" id="FormControlTextarea" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-lg-12" >
                    <button  type="submit" class="btn btn-primary  notes-btn-sec"> {{ __('site.pay') }} </button>
                </div>
        </div>
        ---->
            <input type="hidden" name="submit_check" value="1">
            {{ csrf_field() }}
        </form>
    </div>
    <!----end page--------->
@stop
@section('page_scribt')
    <script type="text/javascript">
        function myFunction() {
            window.print();
        }
       /* function showMessage() {
            $.bootstrapGrowl('لا يمكنك مشاهده بيانات التاجر غير بعد تاكيد الطلب',{
                type: 'danger',
                delay: 2000,
                offset: {from: 'top', amount: 20},
                align: '@if(Lang::locale() == 'ar') right @else left @endif',
                width: 500,
                delay: 4000,
                allow_dismiss: true,
                stackup_spacing: 10 ,
            });
        }*/ //clickshowmessage
        $(document.body).on('click', ".clickshowmessage", function(e){
            $.bootstrapGrowl('لا يمكنك مشاهده بيانات التاجر غير بعد تاكيد الطلب',{
                type: 'danger',
                delay: 2000,
                offset: {from: 'top', amount: 20},
                align: '@if(Lang::locale() == 'ar') right @else left @endif',
                width: 500,
                delay: 4000,
                allow_dismiss: true,
                stackup_spacing: 10 ,
            });
        });
        $(document.body).on('change', "input[name=pay_type]", function(e){
            var radia_type = $(this).data("inputtype");
            if(radia_type == 'on_deliver'){
                document.getElementById('payment_details').style.display = 'none';
                document.getElementById('cash_details').style.display = '';
                //add validation
                $('#acount_owner_name').attr('required', false);
                $('#total_transfer_maney').attr('required', false);
                $('#photo').attr('required', false);
                $('#bank_name').attr('required', false);
                $('#dealer_bank_number').attr('required', false);
                $('#bank_user_number').attr('required', false);
            }else{
                document.getElementById('cash_details').style.display = 'none';
                document.getElementById('payment_details').style.display = '';
                //disaple validation
                $('#acount_owner_name').attr('required', true);
                $('#total_transfer_maney').attr('required', true);
                $('#photo').attr('required', true);
                $('#bank_name').attr('required', true);
                $('#dealer_bank_number').attr('required', true);
                $('#bank_user_number').attr('required', true);

            }
        }) ;
        //
        $(document.body).on('click', "a[class=update_addresse]", function(e){
            var addresse_id = $(this).data("update_addresse_id");
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/update-addresse')}}",
                data:'addresse_id='+addresse_id,
                success: function (response) {
                    $("#fast_preview_content_addresse").html(response);
                    $('#update_addresse_model').modal('show');
                    $('#update_addresse_model').modal('toggle') ;
                    $.bootstrapGrowl('{{__('site.addresse_well_update')}}',{
                        type: 'success',
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
        }) ;
        //end update addreese
        //start make an addresse active
        $(document.body).on('click', "button[name=use_this_addresse]", function(e){
            var addresse_id = $(this).data("active_addresse_id");
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/use-addresse')}}",
                data:'addresse_id='+addresse_id,
                success: function (response) {
                    $("#addresse_user").html(response);
                    $.bootstrapGrowl('{{__('site.addresse_active_update')}}',{
                        type: 'success',
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
        }) ;
        //end
        $(document.body).on('click', "a[class=delete_addresse]", function(e){
            var row_id = $(this).data("delete_addresse_id");
            $.ajax({
                type: "post",
                dataType: "html",
                url: "{{url('/delete_addresse')}}",
                data:'addresse_id='+row_id,
                success: function (response) {
                    $("#addresse_user").html(response);
                    $.bootstrapGrowl('{{__('site.addresse_deleted_well')}}',{
                        type: 'success',
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
        }) ;
		     $('select[name=countrie_id]').change(function () {
                var value = $(this).val() ;
                $.post( "{{url('/cities_list')}}", { countrie: value })
                    .done(function( data ) {
                        $('select[name=citie_id]').html(data);
                    });
            }) ;
            $('select[name=citie_id]').change(function () {
                var city = $("select[name=citie_id] :selected").val();
                if(city != 0){
                    $.post( "{{url('/regions_list')}}", { citie: city })
                        .done(function( data ) {
                            $('select[name=region_id]').html(data);
                        });
                }
            }) ;
        $(document).ready(function(){
             document.getElementById('payment_details').style.display = 'none';
       
            //add addresse form
            $("#form_add_addresse").ajaxForm({
                success: function (response) {
                    $('#Modal').modal('toggle') ;
                    $("#addresse_user").html(response);
                    $.bootstrapGrowl('{{__('site.add_addresses_success')}}',{
                        type: 'success',
                        delay: 2000,
                        offset: {from: 'top', amount: 20},
                        align: '@if(Lang::locale() == 'ar') right @else left @endif',
                        width: 500,
                        delay: 4000,
                        allow_dismiss: true,
                        stackup_spacing: 10 ,
                    });
                },
                error: function (response) {
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
            })
        });
    </script>
@stop
