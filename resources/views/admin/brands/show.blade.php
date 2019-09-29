@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/brands') }}" >
        {{ __('admin.brands') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.brands_show') }}
@stop
@section('content')
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-green-haze">
            <i class="icon-settings font-green-haze"></i>
            <span class="caption-subject bold uppercase"> {{ __('admin.brands_show') }}  <i class="fa fa-angle-right"></i> {{ $brand->name_ar }} / {{ $brand->name_en }}</span>
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
        <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/brands') }}/{{ $brand->id }}"  enctype="multipart/form-data">
            <div class="form-body">
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="name">{{ __('admin.brands_name') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="name_ar" readonly="true" name="name_ar"  placeholder="{{ __('admin.brands_name') }}" value="{{ $brand->name_ar }}">
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="name_en">{{ __('admin.brands_name_en') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="name_en" readonly="true" name="name_en"  placeholder="{{ __('admin.brands_name') }}" value="{{ $brand->name_en }}">
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="description_ar">{{ __('admin.brands_content') }}</label>
                    <div class="col-md-10" style="text-align:right">
                        <p>{!! $brand->description_ar !!}</p>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="description_en">{{ __('admin.brands_content_en') }}</label>
                    <div class="col-md-10" >
                        <p>{!! $brand->description_en !!}  </p>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="name">{{ __('admin.brands_image') }}</label>
                    <div class="col-md-10">
                        @if ($brand->photo)
                            <img src="{{ URL::to('public') }}{{ $brand->photo }}" width="200" height="200">
                        @endif
                     </div>

                </div>
                <!---choose sections---->

                <!--end chossing sections------->
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} :</label>
                    <div class="col-md-10">
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input type="radio" readonly="true" name="{{ $brand->active }}" id="optionsRadios26" value='{{ $brand->active  }}' checked> @if($brand->active == 'yes') {{ __('admin.active') }} @else {{ __('admin.inactive') }} @endif </label>

                        </div>
                    </div>
                </div>
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