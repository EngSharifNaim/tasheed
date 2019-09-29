@extends(ad.'.layouts.app')@section('head_title')	<a href="{{ URL::to(ADMIN.'/measurements_units') }}" >		{{ __('admin.measurements_units') }}  </a> <i class="fa fa-angle-right"></i>	{{ __('admin.measurements_units_update') }} <i class="fa fa-angle-right"></i> {{ $measurements_unit->name_ar }} / {{ $measurements_unit->name_en }}@stop@section('content')	<!-- BEGIN SAMPLE FORM PORTLET-->	<div class="portlet light ">		<div class="portlet-title">			<div class="caption font-green-haze">				<i class="icon-settings font-green-haze"></i>				<span class="caption-subject bold uppercase"> {{ __('admin.measurements_units_update') }}  <i class="fa fa-angle-right"></i> {{ $measurements_unit->name_ar }} / {{ $measurements_unit->name_en }}</span>			</div>		</div>		<div class="portlet-body form">			@if (count($errors))				@foreach ($errors->all() as $error)					<p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endforeach			@endif			@foreach (['danger', 'warning', 'success', 'info'] as $msg)				@if(Session::has('alert-' . $msg))					<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endif			@endforeach			<form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/measurements_units') }}/{{ $measurements_unit->id }}"  enctype="multipart/form-data">				<div class="form-body">					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name">{{ __('admin.measurements_units_name_ar') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" required="required" id="name_ar" name="name_ar"   placeholder="{{ __('admin.measurements_units_name_ar') }}" value="{{ $measurements_unit->name_ar }}" >							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name_en">{{ __('admin.measurements_units_name_en') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" required id="name_en" name="name_en"  placeholder="{{ __('admin.measurements_units_name_en') }}" value="{{ $measurements_unit->name_en }}">							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-actions">						<div class="row">							<div class="col-md-offset-2 col-md-10">								<button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>								<button type="submit" class="btn blue">{{ __('admin.edit_title') }}</button>							</div>						</div>					</div>				{{ method_field('PATCH') }}				{{ csrf_field() }}			</form>		</div>	</div>	<!-- END SAMPLE FORM PORTLET-->@stop@section('page_styles')	<link href="{{ ASSETS }}/global/plugins/bootstrap-sizepicker/css/sizepicker.css" rel="stylesheet" type="text/css" />	<link href="{{ ASSETS }}/global/plugins/jquery-minisizes/jquery.minisizes.css" rel="stylesheet" type="text/css" />@endsection@section('page_plugins')	<script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>	<!-- BEGIN PAGE LEVEL PLUGINS -->@endsection@section('page_scripts')	<script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-sizepicker/js/bootstrap-sizepicker.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/jquery-minisizes/jquery.minisizes.min.js" type="text/javascript"></script>	<!-- END PAGE LEVEL PLUGINS -->	<!-- BEGIN PAGE LEVEL SCRIPTS -->	<script src="{{ ASSETS }}/pages/scripts/components-size-pickers.min.js" type="text/javascript"></script>	<script type="text/javascript" >	</script>@endsection