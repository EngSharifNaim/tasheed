@extends('layouts.app')
@section('page_title')
    {{ __('site.contact_us') }}
@stop
@section('header_style')
    <style>
        .magnify-mobile ,  .alert {
            position: fixed !important ;
            top:0px;
            float: left;
            z-index:2;
        }
.carousel-fade .carousel-inner .carousel-item {
  transition-property: opacity;
}
.carousel-fade .carousel-inner .carousel-item,
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  opacity: 0.8;
}
.carousel-fade .carousel-inner .active,
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}
.carousel-fade .carousel-inner .next,
.carousel-fade .carousel-inner .prev,
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  transform: translate3d(0, 0, 0);
}


    </style>
@stop
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ url('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a class="active">{{ __('site.contact_us') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
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
    <div class="container copouns">
        <h1>{{ __('site.contact_us') }}</h1>
        <div class="row ">
            <div class="col-lg-3">
                @if(count($pages) > 0 )
                <h4 class="title-faq">{{ __('site.populars_questions') }} </h4>
                <ul class="no-padding">
                    @foreach($pages as $key=>$page)
                    <li class="tabs-contact"><a  @if($key==0) class=" active" @endif href="#">@if(Lang::locale() == 'ar') {{ $page->name_ar }} @else  {{ $page->name_en }} @endif</a></li>
                    @endforeach
                </ul>
                @endif
                <div class="contactus-block">
                    <p><i class="fas fa-map-marker"></i>@if(Lang::locale() == 'ar')
                            @if(isset($settings['site_addresse'])){{ $settings['site_addresse'] }} @endif
                            @else
                                @if(isset($settings['site_addresse'])){{ $settings['site_addresse'] }} @endif
                            @endif</p>
                    <p class="alliens"><i class="fab fa-whatsapp"></i> {{__('site.register_mobile')}}: @if(isset($settings['site_phone'])){{ $settings['site_phone'] }} @endif</p>
                    <!--<p class="alliens"><i class="fas fa-phone"></i> {{__('site.register_fax')}}: @if(isset($settings['site_fax'])){{ $settings['site_fax'] }} @endif</p>-->
                    <p class="alliens-last"><i class="fas fa-envelope"></i> {{ __('site.login_email') }} : @if(isset($settings['site_email'])){{ $settings['site_email'] }} @endif.</p>
                </div>
            </div>
            <div class="col-lg-9">
                <h4 class="title-faq">{{ __('site.message_us') }}</h4>
                <div class="content-copouns2">
                    <form method="post" action="{{ url('/send_contact')}}">
                        {{ csrf_field() }}
                        <div class="row margin-edite">
                            <div class="col-md-6">
                                <label class="editeprofile-lable">{{ __('site.register_name') }}<span style="color: red;">*</span>  </label>
                                <input name="name" type="text" class="form-control" placeholder="{{ __('site.put_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="editeprofile-lable">{{ __('site.login_email') }}<span style="color: red;">*</span>  </label>
                                <input type="email" name="email" class="form-control" placeholder="{{ __('site.contact_form_email') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="editeprofile-lable">{{ __('site.phone') }}<span style="color: red;">*</span>  </label>
                                <input type="number" name="mobile" class="form-control" required placeholder="{{ __('site.contact_form_mobile') }}">
                            </div>
                            <div class="col-md-6 ">
                                <label class="editeprofile-lable">{{ __('site.put_title') }}<span style="color: red;">*</span>  </label>
                                <input type="text" name="title" required="true" class="form-control" placeholder="{{ __('site.put_title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="text" required class="form-control areainput" id="exampleFormControlTextarea1" rows="9" placeholder="{{ __('site.contact_form_message') }}"></textarea>
                        </div>
                        <button class="btn save-form btn-primary " type="submit">{{ __('site.send_message') }}</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-1"></div>
            
        </div>
    </div>
@stop
@section('header_style')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9woSyVwoXbF17JZuQHmjPQYP_6eiilAE" type="text/javascript"></script>

@stop
@section('page_script')
    <script type="text/javascript" >
        $(document).ready(function () {
            function initMap() {

                var location = new google.maps.LatLng(24.820477, 46.612209);

                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: location,
                    zoom: 10,
                    panControl: false,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(mapCanvas, mapOptions);

                var markerImage = 'marker.png';

                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    icon: markerImage
                });

                var contentString = '<div class="info-window">' +
                    '<h3>Info Window Content</h3>' +
                    '<div class="info-content">' +
                    '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>' +
                    '</div>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 400
                });

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });



                var styles = [{
                    "featureType": "landscape",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 65
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 51
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.highway",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.arterial",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 30
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "road.local",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 40
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "transit",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "administrative.province",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -100
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "hue": "#ffff00"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -97
                    }]
                }];

                map.set('styles', styles);


            }

            google.maps.event.addDomListener(window, 'load', initMap);
        } )
    </script>
@stop






