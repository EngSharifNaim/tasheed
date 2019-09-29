@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/currencies') }}" >
        {{ __('admin.currencies') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.currencies_edit') }} <i class="fa fa-angle-right"></i> {{ $currencie->name_ar }} / {{ $currencie->name_ar }}
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.currencies_edit') }}  </span>
            </div>
        </div>
        <div class="portlet-body form">
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
            <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/currencies') }}/{{ $currencie->id }}"  enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.currencies_name_ar') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $currencie->name_ar }}" placeholder="{{ __('admin.currencies_name_ar') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.currencies_name_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required id="name_en" name="name_en" value="{{ $currencie->name_ar }}"  placeholder="{{ __('admin.currencies_name_en') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.currencies_label_ar') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required="required" id="label_ar" name="label_ar"  value="{{ $currencie->label_ar }}" placeholder="{{ __('admin.currencies_label_ar') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.currencies_label_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required id="label_en" name="label_en" value="{{ $currencie->label_en }}"  placeholder="{{ __('admin.currencies_label_en') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="value_to_dollar">{{ __('admin.currencies_value_to_dollar') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required id="value_to_dollar" name="value_to_dollar" value="{{ $currencie->value_to_dollar }}"  placeholder="{{ __('admin.currencies_value_to_dollar') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.currencies_icon') }}</label>
                        <div class="col-md-10">
                            @if ($currencie->icon)
                                <img src="{{ URL::to('public') }}{{ $currencie->icon }}" width="200" height="200">
                            @endif
                            <input type="file"  class="form-control" id="icon" name="icon"  placeholder="{{ __('admin.currencies_icon') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>
                                <button type="submit" class="btn blue">{{ __('admin.add_title') }}</button>
                            </div>
                        </div>
                    </div>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->
@stop
@section('page_plugins')
    <script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
@endsection
@section('page_scripts')
    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
@endsection