@extends('layouts.app')
@section('page_title')
    تفعيل الحساب عن طريق الجوال
@endsection
@section('content')
    <!---start--------->
    <section class="bread">
        <div class="container">
            <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">{{ __('site.home_page') }} <i class="fas fa-angle-left"></i> </a></li>
                        <li><a >تفعيل الحساب عن طريق الجوال</a></li>
                    </ul>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <h1>تفعيل الحساب عن طريق الجوال</h1>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        <div class="row justify-content-md-center">
            <div class="col-lg-6 ">
                <div class="login-form">
                    <h1>تفعيل الحساب عن طريق الجوال</h1>
                    <form  method="POST" action="{{ url('/saveactivemobilecode') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                           
                            <input type="number" class="form-control data-login" id="token" name="token" value="{{ old('token') }}"  required="true" placeholder="كود التفعيل المرسل على الجوال">
                        </div>
                        
							<div class="col-8">
								<div class="pull-left">
						<button type="submit" class="btn btn-primary login-button">تفعيل</button>
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div> <!-----------end---------->
@endsection
