@extends(ad.'.layouts.app')

@section('head_title')
    <a href="{{ URL::to(ADMIN.'/regions') }}" >
        {{ __('admin.region') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.region_show') }} <i class="fa fa-angle-right"></i> {{ $region->name_ar }} / {{ $region->name_en }}
@stop

@section('content')
    <div class="portlet light ">


        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.region_show') }}  <i class="fa fa-angle-right"></i> {{ $region->name_ar }} / {{ $region->name_en }}</span>
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
            <form class="form-horizontal" role="form" >
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{ __('admin.city_belong') }}  :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control "  value="{{  $region->countrie->name_ar }} - {{  $region->countrie->name_en }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">  : {{ __('admin.belongcity') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control "  value="{{  $region->citie->name_ar }} - {{  $region->citie->name_en }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{ __('admin.region_name_ar') }} :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"  id="name_ar" value="{{  $region->name_ar }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{ __('admin.region_name_en') }} :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control " id="name_en" value="{{ $region->name_en }}"  readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>

            </form>
        </div>
    </div>
@stop
@section('page_plugins')
    <script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
@endsection
@section('page_scripts')
    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>

@stop