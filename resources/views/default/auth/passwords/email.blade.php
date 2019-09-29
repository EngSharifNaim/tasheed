@extends('layouts.app')
    @section('page_title')
        {{ __('site.change_password_step_1') }}
    @endsection
    @section('content')
        <!---start--------->
            <section class="bread2">
                <div class="container">
                    <div class="row bread-crumb">
                        <div class="col-lg-4">
                            <ul>
                                <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                                <li><a >{{ __('site.change_password_step_1') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container copouns">
               {{-- <h1>{{ __('site.change_password_step_1') }}</h1>--}}
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
                @if (session('status'))
                    <div class=" alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row justify-content-md-center">
                    <div class="col-lg-6 ">
                        <div class="login-form">
                            <div class="panel-body">
                                <form  method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <i class="fas fa-user-circle user-login-icon"></i>
                                        <input type="email" required="true" class="form-control data-login" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="{{ __('site.login_email') }}" aria-describedby="emailHelp" required="true">
                                    </div>
                                  <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('site.request_change_password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-----------end---------->
@endsection
