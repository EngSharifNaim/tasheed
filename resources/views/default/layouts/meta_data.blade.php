
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title> @if(Lang::locale() =='ar') @if(isset($settings['site_title'])) {{ $settings['site_title'] }} @endif @else @if(isset($settings['site_title_en'])) {{ $settings['site_title_en'] }} @endif  @endif - @yield('page_title')</title>

<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->
<link rel="icon" href="https://www.tsheed.com/public/storage/favicon.ico">

<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/global-classes.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/responsive.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/slick-theme.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/slick.css')}}" type="text/css">
<!-- Custom Fonts For This Template -->
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"s />
<!-- font awesome library cdn -->
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link href="{{ URL::to('public') }}{{theme_url('vendors/css/hover.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::to('public') }}{{theme_url('vendors/css/imagehover.css')}}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/bootstrap/css/bootstrap.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/bootstrap-datepicker.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/jquery.timepicker.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/styleme.css')}}" type="text/css">
<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/style.css')}}" type="text/css">
<meta name="csrfToken" content="{{csrf_token()}}">
@if(Lang::locale() == 'en')<link rel="stylesheet" href="{{ URL::to('public') }}{{theme_url('vendors/css/style-en.css')}}" type="text/css">@endif

<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

<script type="text/javascript">
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript">
    var APP_URL = {!!json_encode($settings['site_path']) !!}
</script>
@yield('meta_data')
@yield('header_style')

@yield('meta_data_script')
<!-----

----->