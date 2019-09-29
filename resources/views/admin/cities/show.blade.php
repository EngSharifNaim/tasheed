@extends(ad.'.layouts.app')@section('head_title')	<a href="{{ URL::to(ADMIN.'/cities') }}" >		{{ __('admin.city') }}  </a> <i class="fa fa-angle-right"></i>	{{ __('admin.city_show') }} <i class="fa fa-angle-right"></i> {{ $city->name_ar }} / {{ $city->name_en }}@stop@section('content')	<!-- BEGIN SAMPLE FORM PORTLET-->	<div class="portlet light ">		<div class="portlet-title">			<div class="caption font-green-haze">				<i class="icon-settings font-green-haze"></i>				<span class="caption-subject bold uppercase"> {{ __('admin.city_show') }}  <i class="fa fa-angle-right"></i> {{ $city->name_ar }} / {{ $city->name_en }}</span>			</div>		</div>		<div class="portlet-body form">			@if (count($errors))				@foreach ($errors->all() as $error)					<p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endforeach			@endif			@foreach (['danger', 'warning', 'success', 'info'] as $msg)				@if(Session::has('alert-' . $msg))					<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>				@endif			@endforeach			<form class="form-horizontal" role="form" >				<div class="form-body">					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name">{{ __('admin.city_name_ar') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" readonly="true" id="name_ar" name="name_ar"  value="{{ $city->name_ar }}" placeholder="{{ __('admin.city_name_ar') }}">							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name_en">{{ __('admin.city_name_en') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" readonly="true" id="name_en" name="name_en" value="{{ $city->name_en }}"  placeholder="{{ __('admin.city_name_en') }}">							<div class="form-control-focus"> </div>						</div>					</div>					<div class="form-group form-md-line-input">						<label class="col-md-2 control-label" for="name">{{ __('admin.city_belong') }}</label>						<div class="col-md-10">							<input type="text" class="form-control" readonly="true" id="name_en" name="name_en" value="{{ $city->countrie->name_en }} - {{ $city->countrie->name_en }}"  placeholder="{{ __('admin.city_name_en') }}">							<div class="form-control-focus"> </div>						</div>					</div>			</form>		</div>	</div>	<!-- END SAMPLE FORM PORTLET-->@stop@section('page_plugins')	<script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>@endsection@section('page_scripts')	<script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>@endsection