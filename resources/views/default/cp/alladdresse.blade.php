@extends('layouts.app')
@section('page_title')
    {{ __('site.alladdresse') }}
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
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.dashborad') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active"> {{ __('site.change_my_data') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ __('site.alladdresse') }}</h1>
            </div>
            @if(Auth::user()->level == 'dealer')
            @if( count(Auth::user()->users_addresse ) == 0  )
            <div class="col-lg-6">
                 <button type="button" data-toggle="modal" data-target="#Modal" data-whatever="@mdo" class="btn btn-light add-new-address">{{ __('site.add_new_addresse') }}</button>
            </div>
            @endif
            @else
              <div class="col-lg-6">
                 <button type="button" data-toggle="modal" data-target="#Modal" data-whatever="@mdo" class="btn btn-light add-new-address">{{ __('site.add_new_addresse') }}</button>
              </div>
            @endif
        </div>
        <div class="row ">
            <div class="col-lg-3 side-navegation">
                  <ul>
                @if(Auth::user()->level == 'user' || Auth::user()->level == 'dealer' )  <li><a  href="{{ url('/dashborad') }}"> <i class="fas fa-angle-double-left"></i>{{ __('site.dashborad') }}</a></li> @endif
                @if(Auth::user()->level == 'user' || Auth::user()->level == 'dealer' )  <li><a class="active" href="{{ url('/edit-profile') }}"> <i class="fas fa-angle-double-left"></i>تعديل بياناتى</a></li> @endif
                @if(Auth::user()->level == 'user' )  <li><a  href="{{ url('/my-addresses') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.addresse_details') }}</a></li> @endif
                @if(Auth::user()->level == 'user')  <li><a  href="{{ url('/my-orders') }}"> <i class="fas fa-angle-double-left"></i> مشترياتى </a></li> @endif
                @if(Auth::user()->level == 'dealer')  <li><a  href="{{ url('/acount/cupons') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.cupons') }}</a></li> @endif
                @if(Auth::user()->level == 'user')   <li><a  href="{{ url('/my-favourite-products') }}"> <i class="fas fa-angle-double-left"></i> المنتجات المفضله</a></li> @endif
                @if(Auth::user()->level == 'user' || Auth::user()->level == 'dealer' )  <li><a  href="{{ url('/conservation') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.conservation') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/my-products') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.my_products') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer')  <li><a  href="{{ url('/add-product') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.add_product') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/shiping-details') }}"> <i class="fas fa-angle-double-left"></i> {{ __('admin.shiping_add') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/edit-company') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.edit_compay') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/acount/orders') }}"> <i class="fas fa-angle-double-left"></i> مبيعاتى </a></li> @endif
            </ul>
            </div>
            <div class="col-lg-9 content-copouns">
                <!----------------------------------------------------------->
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
                                      <button  type="button" name="use_this_addresse" data-active_addresse_id="{{ $addresse->id }}" class="btn btn-warning @if($addresse->active == 'yes') address-btn @else address-btn-second @endif">@if($addresse->active == 'yes') {{ __('site.active_addresse') }}@else {{ __('site.use_this_addresse') }}@endif</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{ __('site.no_addresse_yet') }}
                    @endif
                </div> <!----------------------------------------------------------->
            </div>
        </div>
    </div>
@stop
@section('page_scribt')
    <script type="text/javascript">
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
                }
            });
        })
        //
        $(document).ready(function(){
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
            //add addresse form
            $("#form_add_addresse").ajaxForm({
                success: function (response) {
                    $('#Modal').modal('toggle') ;
                    $("#addresse_user").html(response);
                    alert('{{ __('site.add_addresses_success') }}');
                },
                error: function (response) {
                    alert('{{ __('site.unknow_error_happen') }}');
                }
            })
        });
    </script>
@stop



