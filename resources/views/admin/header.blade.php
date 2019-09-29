<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ __('admin.main_title') }} - @if(isset($settings['site_title'])) {{ $settings['site_title'] }} @endif - @yield('head_title') </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin RTL Theme #2 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        @if(Lang::locale() == "ar")
        <link href="{{ ASSETS }}/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        @else
        <link href="{{ ASSETS }}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        @endif
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
             @yield('page_styles')
        <!-- END PAGE LEVEL PLUGINS -->
        @if(Lang::locale() == "ar")
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ ASSETS }}/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ ASSETS }}/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ ASSETS }}/layouts/layout2/css/layout-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/layouts/layout2/css/themes/blue-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ ASSETS }}/layouts/layout2/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
        @else
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ ASSETS }}/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ ASSETS }}/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ ASSETS }}/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ ASSETS }}/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        @endif
        @yield('headers')
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ ASSETS }}/favicon.ico" /> </head>
    <!-- END HEAD -->
<style type="text/css">

 @font-face {
  font-family:"GE SS Two Light";
  src:url("{{ ASSETS }}/fonts/GE_SS_Two_Light.eot?") format("eot"),
  url("{{ ASSETS }}/fonts/GE_SS_Two_Light.woff") format("woff"),
  url("{{ ASSETS }}/fonts/GE_SS_Two_Light.ttf") format("truetype"),
  url("{{ ASSETS }}/fonts/GE_SS_Two_Light.svg#GESSTwoLight-Light") format("svg");
  font-weight:normal;
  font-style:normal;
 }


 @font-face {
    font-family: "JF Flat Regular";
    src: url('{{ ASSETS }}/fonts/JF-Flat-regular.eot');
    src: url('{{ ASSETS }}/fonts/JF-Flat-regular.eot?#iefix') format('embedded-opentype'),
    url('{{ ASSETS }}/fonts/JF-Flat-regular.svg#JF Flat Regular') format('svg'),
    url('{{ ASSETS }}/fonts/JF-Flat-regular.woff') format('woff'),
    url('{{ ASSETS }}/fonts/JF-Flat-regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}
body {
  font-family: 'JF Flat Regular', sans-serif!important;
}
</style>