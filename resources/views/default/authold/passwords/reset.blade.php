
@extends('layouts.app')
@section('page_title')
    {{ __('site.change_password_step2') }}
@endsection
@section('content')
    <!---start--------->
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >{{ __('site.change_password_step2') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container copouns">
       {{-- <h1>{{ __('site.change_password_step2') }}</h1>--}}
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
        <div class="row justify-content-md-center">
            <div class="col-lg-6 ">
                <div class="login-form">
                    <h1>{{ __('site.change_password') }}</h1>
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }} 
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <i class="fas fa-user-circle user-login-icon"></i>
                            <input type="email" class="form-control data-login" id="exampleInputEmail1" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required="true" placeholder="{{ __('site.login_email') }}">
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <i class="fas fa-lock user-login-icon"></i>
                            <input id="password" type="password" class="form-control data-login" name="password" value="{{ $email or old('email') }}" required autofocus placeholder="{{ __('site.password') }}">
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <i class="fas fa-lock user-login-icon"></i>
                            <input id="password-confirm" type="password" class="form-control data-login" name="password_confirmation" required  placeholder="{{ __('site.password_confirmation') }}">

                        </div>

                        <button type="submit" class="btn btn-primary login-button">{{ __('site.change_password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-----------end---------->
@endsection
