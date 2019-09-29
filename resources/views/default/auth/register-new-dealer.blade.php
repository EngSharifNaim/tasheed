@extends('layouts.app')
@section('page_title')
    {{ __('site.create_client_dealer') }}
@endsection
@section('meta_data_script')
{{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJeEs5zRZAaku1m8O3ueuG9gox8fwUkLI"></script>--}}



@stop
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ Url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >{{ __('site.create_client_dealer') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <form  enctype="multipart/form-data" method="post" action="{{ route('register') }}" >
             @if (count($errors))
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endforeach
                @endif
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has($msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 register-client">
                    <h1>{{ __('site.create_client_dealer') }}</h1>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">{{ __('site.first_name') }}  <span style="color: red;">* @if ($errors->has('first_name')) {{ $errors->first('first_name') }}     @endif</span> </label>
                            <input type="text" required="true" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('site.first_name') }}"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name"> {{ __('site.last_name') }} <span style="color: red;">* @if ($errors->has('last_name')) {{ $errors->first('last_name') }}     @endif</span> </label>
                            <input type="text" required="true" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('site.last_name') }}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">{{ __('site.email') }}  <span style="color: red;"> * @if ($errors->has('email')) {{ $errors->first('email') }}     @endif</span> </label>
                            <input type="email" required="true" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('site.email') }}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">{{ __('site.phone') }}  <span style="color: red;">* @if ($errors->has('phone')) {{ $errors->first('phone') }}     @endif</span> </label>
                            <input type="text" required="true"  name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="{{ __('site.phone') }}" >
                        </div>
                        <input type="hidden" required="true"  name="sitepercetage" class="form-control" id="sitepercetage" value="0" placeholder="{{ __('site.sitepercetage') }}" > 
                      </div>
                    <div class="form-group">
                        <label for="password">{{ __('site.password') }}<span style="color: red;">* @if ($errors->has('password')) {{ $errors->first('password') }}     @endif</span> </label>
                        <input type="password" required="true" class="form-control" name="password" id="password" placeholder="{{ __('site.password') }}" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('site.password_confirmation') }}<span style="color: red;">* @if ($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }}     @endif</span> </label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('site.password_confirmation') }}" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">صوره<span style="color: red;">* @if ($errors->has('photo')) {{ $errors->first('photo') }}     @endif</span> </label>
                        <input type="file" class="form-control" id="photo" name="photo"  >
                    </div>
                   <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="countrie_id">{{ __('site.countrie_id') }} <span style="color: red;">* @if ($errors->has('countrie_id')) {{ $errors->first('countrie_id') }}     @endif</span> </label>
                            <select required="true" class="form-control "  name="countrie_id" id="countrie_id">
                                <option value="">{{ __('site.choose_country') }}</option>
                                @foreach($countireslist as $country)
                                    @if(old('countrie_id') ==  $country->id )
                                        <option value="{{ $country->id }}" selected>@if(Lang::locale() == 'ar') {{ $country->name_ar }} @else {{ $country->name_en }} @endif</option>
                                    @else
                                        <option value="{{ $country->id }}">@if(Lang::locale() == 'ar') {{ $country->name_ar }} @else {{ $country->name_en }} @endif</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                       
                       <div class="form-group col-md-12">
                            <label for="citie_id">{{ __('site.region_id') }} <span style="color: red;">* @if ($errors->has('citie_id')) {{ $errors->first('citie_id') }}     @endif</span> </label>
                            <select required="true" class="form-control "  name="citie_id" id="citie_id">
                                <option value=" ">{{ __('site.choose_country_first') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="region_id"> {{ __('site.citie_id') }} <span style="color: red;">* @if ($errors->has('region_id')) {{ $errors->first('region_id') }}     @endif</span> </label>
                            <select required="true" class="form-control "  name="region_id" id="region_id" >
                                <option value=" " > اختر المنقطه اولا</option>
                            </select>
                        </div>
                     
                    
                    
                    
                    
                    
                    
                    
                            <div class="form-group ">
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" name="site" type="checkbox" value="1" id="gridCheck1" >--}}
{{--                            <label class="form-check-label privcy" for="gridCheck1" >--}}
{{--                              {{ __('site.message_if_sell') }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required="true">
                            <label class="form-check-label privcy" for="gridCheck">
                                <a  @if(!empty($condition))  target="_blank" href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $condition->name_ar) }}@else{{ str_replace(' ', '_', $condition->name_en) }} @endif/{{ $condition->id }} " @else href="#" @endif class="download-policy"> {{ __('site.condition_agree') }}</a>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row" id="website_another" style="display: none;">
                        <label for="webiste_another" class="col-sm-2 col-md-4 col-form-label">{{ __('site.webiste_link') }}<span style="color: red;">* @if ($errors->has('webiste_another')) {{ $errors->first('webiste_another') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="url"   name="webiste_another" id="webiste_anotherr" placeholder="{{ __('site.webiste_link') }} ">
                        </div>
                    </div>
                    
                    
                    
                    
                    
                     <!--    <div class="form-group col-md-12">
                            <label for="addresse">{{ __('site.addresse_arabic_lang') }}<span style="color: red;"> @if ($errors->has('addresse_ar')) {{ $errors->first('addresse_ar') }}     @endif</span> </label>
                            <input required="true" type="text" class="form-control" id="addresse_ar" name="addresse_ar"  value="{{ old('addresse_ar') }}"  placeholder="{{ __('site.addresse_arabic_lang') }}" >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="addresse">{{ __('site.addresse_english_lang') }}<span style="color: red;"> @if ($errors->has('addresse_en')) {{ $errors->first('addresse_en') }}     @endif</span> </label>
                            <input  type="text" class="form-control" id="addresse_en" name="addresse_en"  value="{{ old('addresse_en') }}"  placeholder="{{ __('site.addresse_english_lang') }}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zip_code">{{ __('site.zip_code') }}<span style="color: red;"> @if ($errors->has('zip_code')) {{ $errors->first('zip_code') }}     @endif</span> </label>
                            <input type="text"  class="form-control" id="zip_code" name="zip_code"  value="{{ old('zip_code') }}" placeholder="{{ __('site.zip_code') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="street_name">{{ __('site.street_name_ar') }}<span style="color: red;">* @if ($errors->has('restrict_name_ar')) {{ $errors->first('restrict_name_ar') }}     @endif</span> </label>
                            <input type="text" required="true" class="form-control" name="restrict_name_ar" value="{{ old('restrict_name_ar') }}" id="restrict_name_ar" placeholder="{{ __('site.street_name_ar') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="street_name">{{ __('site.street_name_en') }}<span style="color: red;"> @if ($errors->has('restrict_name_en')) {{ $errors->first('restrict_name_en') }}     @endif</span> </label>
                            <input type="text"  class="form-control" name="restrict_name_en" value="{{ old('restrict_name_en') }}" id="restrict_name_en" placeholder="{{ __('site.street_name_en') }}">
                        </div>-->
                    </div> 
           {{--         <div id="map"></div>--}}
                </div>
                <!--<div class="col-lg-1"></div> -->
                <div class="col-lg-6 register-client">
                    
                       
                        
                        
                        
                        <h1>{{ __('site.company_data') }}</h1>



{{--                    <div class="form-group col-md-12">--}}
{{--                        {!! $map['html'] !!}--}}


{{--                    </div>--}}
                    <div class="form-group col-md-12">
                        <label for="company_name_ar" > موقعك على الخريطة<span style="color: red;"> @if ($errors->has('company_name_ar')) {{ $errors->first('company_name_ar') }}     @endif</span>
                            <i class="fa fa-map-marker-alt"></i>

                        </label>

                        <input type="text" required="true" class="form-control"  name="company_location" value="{{ old('company_location') }}"  id="company_location" placeholder="اكتب رابط الموقع">

                    </div>
                        <div class="form-group col-md-12">
                            <label for="company_name_ar" > {{ __('site.company_name_ar') }}<span style="color: red;">* @if ($errors->has('company_name_ar')) {{ $errors->first('company_name_ar') }}     @endif</span> </label>
                            
                                <input type="text" required="true" class="form-control"  name="company_name_ar" value="{{ old('company_name_ar') }}"  id="company_name_ar" placeholder="{{ __('site.company_name_ar') }}">
                           
                        </div>

{{--                        <div class="form-group col-md-12">--}}
{{--                            <label for="company_phone" >{{ __('site.company_phone') }} <span style="color: red;">* @if ($errors->has('company_phone')) {{ $errors->first('company_phone') }}     @endif</span> </label>--}}
{{--                          --}}
{{--                                <input type="number" required="true" name="company_phone" value="{{ old('company_phone') }}" class="form-control" id="company_phone" placeholder=" {{ __('site.company_phone') }}">--}}
{{--                           --}}
{{--                        </div>--}}
                        <div class="form-group col-md-12">
                            <label for="company_website" >{{ __('site.company_website') }} <span style="color: red;"> @if ($errors->has('company_website')) {{ $errors->first('company_website') }}     @endif</span> </label>
                            
                                <input type="url" class="form-control" name="company_website" value="{{ old('company_website') }}" id="company_website" placeholder="{{ __('site.company_website') }}">
                           <a href="http://cutt.us/sutu3">سطوع لتقنية المعلومات يسعدها ان تقوم بخدمتك اضغط هنا</a>
                        </div>
                        <input type="hidden" class="form-control" name="company_email">

                        <div class="form-group col-md-12">
                            <label for="tax_number" >{{ __('site.number_tax') }} <span style="color: red;">* @if ($errors->has('company_tax_number')) {{ $errors->first('company_tax_number') }}     @endif</span> </label>
                           
                                <input type="text" name="company_tax_number" value="{{ old('company_tax_number') }}"  class="form-control" id="tax_number" placeholder="{{ __('site.company_tax') }}">
                           
                        </div>
                        <div class="form-group col-md-12">
                            <label for="commercial_register" >{{ __('site.company_tax') }}<span style="color: red;">* @if ($errors->has('commercial_register')) {{ $errors->first('commercial_register') }}     @endif</span> </label>
                          
                                <input type="text" class="form-control " name="commercial_register" value="{{ old('commercial_register') }}" id="commercial_register" placeholder="{{ __('site.number_tax') }} ">
                          
                        </div>
                        
                        
                        
{{--                         <div class="form-group col-md-12">--}}
{{--                            <label for="commercial_register" >الوصف</span> </label>--}}
{{--                          --}}
{{--                                <textarea style="min-height:120px;" name="describtion" type="text" class="form-control " placeholder="الوصف "> </textarea>--}}

{{--                          --}}
{{--                        </div>--}}

                        <input type="hidden" name="acount_bank_number" value="">
                        <input type="hidden" name="bank_name" value="">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                           
                     <input type="hidden" name="level" value="dealer">
                     <input type='hidden' name='lat' id='lat'>
                     <input type='hidden' name='lng' id='lng'>
                    <button style="margin-top:20px;margin-bottom:20px;" type="submit" class="btn btn-primary client-signup">{{ __('site.register_now') }}</button>
                    
                    
                </div>
            <!--            <div class="form-group row">



                            <p>موقعك على الخريطة : <small>هذه البيانات لن يراها احد الا عند الضرورة</small></p>
                            <script type="text/javascript">
                                var map;
                                function initialize() {
                                    var myLatlng = new google.maps.LatLng(24.701726,46.6892553);
                                    var myOptions = {
                                        zoom: 17,
                                        center: myLatlng,
                                        mapTypeId: google.maps.MapTypeId.MAP
                                    };


                                    map = new google.maps.Map(document.getElementById('map_canvas'),
                                        myOptions);
                                    var marker = new google.maps.Marker({
                                        position: myLatlng,
                                        title:"Click to view info!"
                                    });
                                    marker.setMap(map);
                                    google.maps.event.addListener(map, "click", function (e) {

                                        //lat and lng is available in e object
                                        var latLng = e.latLng;

                                        // marker STARTS


                                        marker.setPosition(latLng);
                                        document.getElementById('lat').value = e.latLng.lat();
                                        document.getElementById('lng').value = e.latLng.lng();
                                        // marker ENDS

                                        // info-window STARTS
                                        var infowindow = new google.maps.InfoWindow({ content: "<div class='map_bg_logo'><span style='color:#1270a2;'><b>احداثيات الموقع</b></span><div style='border-top:1px dotted #ccc; height:1px;  margin:5px 0;'></div><span style='color:#555;font-size:11px;'><b>latLng: </b>"+latLng+"</span></div>" });
                                        google.maps.event.addListener(marker, 'click', function() {
                                            infowindow.open(map,marker);
                                        });

                                        // info-window ENDS

                                    });


                                }

                                google.maps.event.addDomListener(window, 'load', initialize);

                            </script>
                            <div id="map_canvas" style="height: 500px;width: 100%"></div>
                        </div>
                        {{--<div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-md-4 col-form-label">رقم الحساب <span style="color: red;">*</span> </label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="inputPassword" placeholder="قم بأدخال الرقم الضريبي">
                            </div>
                        </div>--}}
                      {{--  <div class="form-group row">
                            <label for="inputState" class="col-sm-2 col-md-4 col-form-label">اسم البنك <span style="color: red;">*</span> </label>
                            <select id="inputState" class="col-sm-10 col-md-7 select-countery">
                                <option selected>بنك مصر</option>
                                <option>...</option>
                            </select>
                        </div>--}}
                    </div>
         
                </div> -->
            </div>
        </form>
    </div>
@stop
@section('page_scribt')

    <script type="text/javascript">
        $(document.body).on('change', "input[name=site]", function(e){
            $('#webiste_anotherr').attr('required', false)
            document.getElementById('website_another').style.display = 'none';
         //   document.getElementById("webiste_anotherr").attributes["required"] = false;
            var radia_type = document.querySelector('input[name="site"]:checked').value;;
            if(radia_type == 1  ){
                document.getElementById('website_another').style.display = '';
               // document.getElementById("webiste_anotherr").attributes["required"] = true ;
                $('#webiste_anotherr').attr('required', true)
            }
        }) ;

        $(document).ready(function() {

            var vals = $("select[name=countrie_id] :selected").val();

            if(vals != 0){
                $.post("{{url('cities/cities_list')}}", { countrie: vals }).done(function( data ) {
                    $('select[name=citie_id]').html(data);
                });
            }

            var city = $("select[name=citie_id] :selected").val();
            if(city != 0){

                $.post( "{{url('regions/regions_list')}}", { citie: city })
                    .done(function( data ) {
                        $('select[name=region_id]').html(data);

                    });
            }

            $("select[name=countrie_id]").change(function(){
                var vals = $(this).val();
                if(vals != 0){

                    $.post( "{{url('cities/cities_list')}}", { countrie: vals })
                        .done(function( data ) {
                            $('select[name=citie_id]').html(data);
                            //    alert(1) ;
                        });
                }
            });

            $("select[name=citie_id]").change(function(){
                var vals = $(this).val();
                if(vals != 0){

                    $.post( "{{url('regions/regions_list')}}", { citie: vals })
                        .done(function( data ) {
                            $('select[name=region_id]').html(data);

                        });
                }
            });



        });

    </script>
@stop