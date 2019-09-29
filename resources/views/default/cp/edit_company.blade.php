@extends('layouts.cp')
@section('page_title')
    {{ __('site.edit_compay') }}
@stop
@section('content')
    <div class="col-lg-9 content-copouns">
        <div class="">
            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endforeach
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert   alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <form method="post" action="{{ url('/save_company_data') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" @if(isset($company_data->id )) value="{{ $company_data->id }}" @endif>
                <div class="left-form">
                    <h1>{{ __('site.company_data') }}</h1>
                    <div class="form-group row">
                        <label for="company_name_ar" class="col-sm-2 col-md-4 col-form-label"> {{ __('site.company_name_ar') }}<span style="color: red;">* @if ($errors->has('company_name_ar')) {{ $errors->first('company_name_ar') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" required="true" class="form-control" name="name_ar" @if(isset($company_data->name_ar )) value="{{ $company_data->name_ar }}" @endif id="company_name_ar" placeholder="{{ __('site.company_name_ar') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_name_en" class="col-sm-2 col-md-4 col-form-label"> {{ __('site.company_name_en') }}<span style="color: red;">* @if ($errors->has('company_name_en')) {{ $errors->first('company_name_en') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" class="form-control" name="name_en" id="name_en" @if(isset($company_data->name_en )) value="{{ $company_data->name_en }}" @endif placeholder="{{ __('site.company_name_en') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_phone" class="col-sm-2 col-md-4 col-form-label">{{ __('site.company_phone') }} <span style="color: red;">* @if ($errors->has('company_phone')) {{ $errors->first('company_phone') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="number" required="true" name="phone" class="form-control" id="phone" @if(isset($company_data->phone )) value="{{ $company_data->phone }}" @endif placeholder=" {{ __('site.company_phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_website" class="col-sm-2 col-md-4 col-form-label">{{ __('site.company_website') }} <span style="color: red;">* @if ($errors->has('company_website')) {{ $errors->first('company_website') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" class="form-control" name="company_website" id="company_website" @if(isset($company_data->company_website )) value="{{ $company_data->company_website }}" @endif placeholder="{{ __('site.company_website') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_website" class="col-sm-2 col-md-4 col-form-label">{{ __('site.login_email') }} <span style="color: red;">* @if ($errors->has('company_email')) {{ $errors->first('company_email') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" required="true" class="form-control" name="email" id="email" @if(isset($company_data->email )) value="{{ $company_data->email }}" @endif placeholder="{{ __('site.login_email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax_number" class="col-sm-2 col-md-4 col-form-label">{{ __('site.number_tax') }} <span style="color: red;">* @if ($errors->has('company_tax_number')) {{ $errors->first('company_tax_number') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" name="tax_number" class="form-control" id="tax_number" @if(isset($company_data->tax_number )) value="{{ $company_data->tax_number }}" @endif placeholder="{{ __('site.company_tax') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="commercial_register" class="col-sm-2 col-md-4 col-form-label">{{ __('site.company_tax') }}<span style="color: red;">* @if ($errors->has('commercial_register')) {{ $errors->first('commercial_register') }}     @endif</span> </label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" class="form-control " name="commercial_register" id="commercial_register" @if(!empty($company_data->commercial_register)) value="{{ $company_data->commercial_register }}" @endif placeholder="{{ __('site.number_tax') }} ">
                        </div>
                    </div>
                    <input type="hidden" name="acount_bank_number" value="">
                    <input type="hidden" name="bank_name" value="">
                   
                </div>
                <button class="btn svae-form btn-primary " type="submit">{{ __('site.save') }}</button>
            </form>
        </div>
    </div>
    </div></div>
@stop



