@extends('layouts.app')
@section('page_title')
    {{ __('site.login_title') }}
@endsection
@section('content')
    <!---start--------->
    <section class="bread">
        <div class="container">
            <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >{{ __('site.login_title') }}</a></li>
                    </ul>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <h1>{{ __('site.login_title') }}</h1>
        @if (count($errors))
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endforeach
        @endif
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))

                <p class="alert  alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
        <div class="row justify-content-md-center">
            <div class="col-lg-6 ">
                <div class="login-form">
                    <h1>{{ __('site.login_title') }}</h1>
                    <form  method="POST" action="{{ url('/dologin') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <i class="fas fa-user-circle user-login-icon"></i>
                            <input type="email" class="form-control data-login" id="exampleInputEmail1" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required="true" placeholder="{{ __('site.login_email') }}">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-lock user-login-icon"></i>
                            <input type="password" name="password"  class="form-control data-login" id="exampleInputPassword1" placeholder="{{ __('site.password') }}" required="true">
                        </div>
                        <div class="row">
							<div class="col-4">
                            <a href="{{ route('password.request') }}" class="forget-password">{{ __('site.login_forgetpassword') }}</a>
							</div>
							<div class="col-8">
								<div class="text-center">
								     <a href="{{ URL::to('/register-dealer') }}" class="register-login">    تسجيل تاجر</a> 
							 <a href="{{ URL::to('/register-client') }}" class="register-login">    تسجيل مشتري</a> 
							 <a href="{{ URL::to('/register-another') }}" class="register-login">     تسجيل مهندسون ومقاولون  </a> 
								
							
								</div>
							</div>
						</div>
						 @if(isset($settings['site_activetsregister']))
                        @if($settings['site_activetsregister'] == 'yes' )							 
						<div class="row">
							<div class="col-6">
                            <a href="{{ url('/userviamobile/mobilecode') }}" class="forget-password">تفعيل عن طريق الجوال</a>
							</div>
						
						</div>
						@endif
						@endif
						<div class="row" style="margin:15px 0 10px">
							<div class="col-4">
						<div class="form-check">
							<label style="color: #ff6633;" class="form-check-label">
                        <input type="checkbox" class="form-check-input remember" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('site.login_rememberme') }}
							</label>
						</div>
							</div>
							<div class="col-8">
								<div class="pull-left">
						<button type="submit" class="btn btn-primary login-button">{{ __('site.login_title') }}</button>
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div> <!-----------end---------->
@endsection
