@extends(ad.'.layouts.app')@section('head_title')	<a href="{{ URL::to(ADMIN.'/colors') }}" >		{{ __('admin.colors') }}  </a> <i class="fa fa-angle-right"></i>	{{ __('admin.colors_show') }} <i class="fa fa-angle-right"></i> {{ $color->name_ar }} / {{ $color->name_en }}@stop@section('content')	<!-- BEGIN SAMPLE FORM PORTLET-->	<div class="portlet light ">		<div class="portlet-title">			<div class="caption font-green-haze">				<i class="icon-settings font-green-haze"></i>				<span class="caption-subject bold uppercase"> {{ __('admin.colors_show') }} <i class="fa fa-angle-right"></i> {{ $color->name_ar }} / {{ $color->name_en }}</span>			</div>		</div>		<div class="portlet-body form">			@if (count($errors))				@foreach ($errors->all() as $error)					<p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endforeach			@endif			@foreach (['danger', 'warning', 'success', 'info'] as $msg)				@if(Session::has('alert-' . $msg))					<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endif			@endforeach			<form class="form-horizontal" role="form" >				<div class="form-body">					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name">{{ __('admin.color_name_ar') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" required="required" id="name_ar" name="name_ar"   placeholder="{{ __('admin.colors_name_ar') }}" value="{{ $color->name_ar }}"  readonly="true">							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name_en">{{ __('admin.colors_name_en') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" required id="name_en" name="name_en"  placeholder="{{ __('admin.colors_name_en') }}" value="{{ $color->name_en }}" readonly="true">							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name">{{ __('admin.colors_code') }}</label>						<div class="col-md-10">							<span class="" style="width:200px; height:100px ; background-color:{{ $color->color_code }}"><strong>{{ $color->color_code }}</strong></span>						</div>					</div>			</form>		</div>	</div>	<!-- END SAMPLE FORM PORTLET-->@stop@section('page_styles')	<link href="{{ ASSETS }}/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />	<link href="{{ ASSETS }}/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />@endsection@section('page_plugins')	<script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>	<!-- BEGIN PAGE LEVEL PLUGINS -->@endsection@section('page_scripts')	<script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>	<!-- END PAGE LEVEL PLUGINS -->	<!-- BEGIN PAGE LEVEL SCRIPTS -->	<script src="{{ ASSETS }}/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>	<script type="text/javascript" >        $(document).ready(function()        {            $('#clickmewow').click(function()            {                $('#radio1003').attr('checked', 'checked');            });        })	</script>@endsection