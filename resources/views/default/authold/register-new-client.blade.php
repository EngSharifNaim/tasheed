@extends('layouts.app')
@section('page_title')
    {{ __('site.create_client_acount') }}
@endsection
@section('meta_data_script')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJeEs5zRZAaku1m8O3ueuG9gox8fwUkLI"></script>

@stop
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ Url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >{{ __('site.create_client_acount') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-->
    <!--------->
    <div class="container copouns">
        <h1>{{ __('site.create_client_acount') }}</h1>
        <div class="row">
            <div class="col-lg-6 register-client">
                <form  enctype="multipart/form-data" method="post" action="{{ route('register') }}">
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
					<input type="hidden" name="level" value="user">
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
                            <input type="number" required="true"  name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="{{ __('site.phone') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('site.password') }}<span style="color: red;">* @if ($errors->has('password')) {{ $errors->first('password') }}     @endif</span> </label>
                        <input type="password" required="true" class="form-control" name="password" id="password" placeholder="{{ __('site.password') }}" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('site.password_confirmation') }}<span style="color: red;">* @if ($errors->has('password_confirmation')) {{ $errors->first('password_confirmation') }}     @endif</span> </label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('site.password_confirmation') }}" >
                    </div>
                    
                    <!--
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
                        <input type="hidden" class="form-control "  name="webiste_another" id="webiste_anotherr" >

                        
                        <div class="form-group col-md-12">
                            <label for="citie_id">{{ __('site.citie_id') }} <span style="color: red;">* @if ($errors->has('citie_id')) {{ $errors->first('citie_id') }}     @endif</span> </label>
                            <select required="true" class="form-control "  name="citie_id" id="citie_id">
                                <option value=" ">{{ __('site.choose_country_first') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="region_id">{{ __('site.region_id') }} <span style="color: red;">* @if ($errors->has('region_id')) {{ $errors->first('region_id') }}     @endif</span> </label>
                            <select required="true" class="form-control "  name="region_id" id="region_id" >
                                <option value=" " >{{ __('site.choose_city_first') }}ا</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="addresse">{{ __('site.addresse_arabic_lang') }}<span style="color: red;">* @if ($errors->has('addresse_ar')) {{ $errors->first('addresse_ar') }}     @endif</span> </label>
                            <input required="true" type="text" class="form-control" id="addresse_ar" name="addresse_ar"  value="{{ old('addresse_ar') }}"  placeholder="{{ __('site.addresse_arabic_lang') }}" >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="addresse">{{ __('site.addresse_english_lang') }}<span style="color: red;"> @if ($errors->has('addresse_en')) {{ $errors->first('addresse_en') }}     @endif</span> </label>
                            <input  type="text" class="form-control" id="addresse_en" name="addresse_en"  value="{{ old('addresse_en') }}"  placeholder="{{ __('site.addresse_english_lang') }}" >
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="agree" value="{{ old('agree') }}" >
                            <label class="form-check-label privcy" for="gridCheck">
                                {{ __('site.condition_agree') }} <a  @if(!empty($condition))  target="_blank" href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $condition->name_ar) }}@else{{ str_replace(' ', '_', $condition->name_en) }} @endif/{{ $condition->id }} " @else href="#" @endif class="download-policy">{{ __('site.site_condition') }}</a>
                            </label>
                        </div>
                    </div>
					<input type="hidden" name="sitepercetage" value="0">
                    <input type="hidden" name="zip_code" value="">
                    <input type="hidden" name="restrict_name_ar" value="">
                    <input type="hidden" name="restrict_name_en" value="">
                    <input type='hidden' name='lat' id='lat'>
                    <input type='hidden' name='lng' id='lng'>
                    <button style="margin-top:20px;margin-bottom:20px;" type="submit" class="btn btn-primary client-signup">{{ __('site.register_now') }}</button>
                </form>
            </div>
          <div class="col-lg-6" >
              <img src="https://www.tsheed.com/public/storage/NVTGlbd226HI5JOdFkOuaqj7OjeLEodigP9FnX9u.jpeg" style="width:100%;" />
               <!--   <div class="form-group">



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
                </div> -->
            </div>
        </div>
    </div>
@stop
@section('page_scribt')
    <script type="text/javascript">
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