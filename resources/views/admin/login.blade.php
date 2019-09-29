<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ __('admin.login_title') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin RTL Theme #2 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ ASSETS }}/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ ASSETS }}/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ ASSETS }}/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ ASSETS }}/pages/css/login-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
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
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="{{ ASSETS }}/pages/img/logo-big.png"  alt="" style="width:250px;height:250px;"/> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
    @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>{{ __('admin.login_error_title') }}</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <p>
                   {{session()->get('error')}}
                </p>
            </div>
        @endif
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="login" method="post">
                {!! csrf_field() !!}
                <h3 class="form-title font-green">{{ __('admin.login_title') }}</h3>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">{{ __('admin.login_email_title') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="{{ __('admin.login_email_title') }}" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">{{ __('admin.login_password_title') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="{{ __('admin.login_password_title') }}" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">{{ __('admin.login_button_title') }}</button>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1" />{{ __('admin.login_remember_title') }}
                        <span></span>
                    </label>
                    <a href="javascript:;" id="forget-password" class="forget-password">{{ __('admin.login_forget_title') }}</a>
                </div>
               
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="{{ url('/password/email') }}" method="post">
                 {{ csrf_field() }}
                <h3 class="font-green"> {{ __('admin.login_forget_title') }}</h3>
                <p> {{ __('admin.login_forget_desc') }}</p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{{ __('admin.login_email_title') }}"  name="email" value="{{ old('email') }}" required /> 
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn green btn-outline">{{ __('admin.login_forget_reset_button') }}</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">{{ __('admin.login_forget_button') }}</button>
                </div>
                
            </form>
            <!-- END FORGOT PASSWORD FORM -->
           
        </div>
        <div class="copyright"> </div>
        <!--[if lt IE 9]>
<script src="{{ ASSETS }}/global/plugins/respond.min.js"></script>
<script src="{{ ASSETS }}/global/plugins/excanvas.min.js"></script> 
<script src="{{ ASSETS }}/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ ASSETS }}/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ ASSETS }}/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{{ ASSETS }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ ASSETS }}/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ ASSETS }}/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>