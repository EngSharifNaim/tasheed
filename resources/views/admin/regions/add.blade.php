@extends(ad.'.layouts.app')@section('head_title')@section('head_title')	<a href="{{ URL::to(ADMIN.'/regions') }}" >		{{ __('admin.region') }}  </a> <i class="fa fa-angle-right"></i>	{{ __('admin.region') }}@stop@section('content')<div class="portlet light ">	<div class="portlet-title">		<div class="caption font-green-haze">			<i class="icon-settings font-green-haze"></i>			<span class="caption-subject bold uppercase"> {{ __('admin.region_add') }} </span>		</div>	</div>	<div class="portlet-body form">	@if (count($errors))		@foreach ($errors->all() as $error)			<p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>		@endforeach	@endif    @foreach (['danger', 'warning', 'success', 'info'] as $msg)      @if(Session::has('alert-' . $msg))      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>      @endif    @endforeach		<form class="form-horizontal" role="form" method="post" action="{{ URL::to('admin/regions') }}"  enctype="multipart/form-data">			<div class="form-body">				<div class="form-group">					<label class="col-md-2 control-label">{{ __('admin.city_belong') }}  :</label>					<div class="col-md-10">						<select name="countrie_id" class="form-control input-inline input-medium">							<option value="0">{{ __('admin.choosecountryfirst') }}</option>							@foreach ($countries as $countrie)								<option value="{{ $countrie->id }}">{{ $countrie->name_ar }} - {{ $countrie->name_en }}</option>							@endforeach						</select>					</div>				</div>				<div class="form-group">					<label class="col-md-2 control-label">  : {{ __('admin.belongcity') }}</label>					<div class="col-md-10">						<select name="citie_id" class="form-control input-inline input-medium">							<option value="0">{{ __('admin.choosecountryfirst') }}</option>						</select>					</div>				</div>				<div class="form-group">					<label class="col-md-2 control-label">{{ __('admin.region_name_ar') }} :</label>					<div class="col-md-10">						<input type="text" class="form-control input-inline input-medium" name="name_ar" value="{{ old('name_ar') }}" placeholder="{{ __('admin.region_name_ar') }}">					</div>				</div>				<div class="form-group">					<label class="col-md-2 control-label">{{ __('admin.region_name_en') }} :</label>					<div class="col-md-10">						<input type="text" class="form-control input-inline input-medium" name="name_en"  value="{{ old('name_en') }}" placeholder="{{ __('admin.region_name_en') }}">					</div>				</div>				<div class="form-actions">					<div class="row">						<div class="col-md-offset-2 col-md-10">							<button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>							<button type="submit" class="btn blue">{{ __('admin.add_title') }}</button>						</div>					</div>				</div>			</div>			{{ csrf_field() }}		</form>	</div></div>@stop@section('page_plugins')	<script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>	<script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>@endsection@section('page_scripts')	<script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>	<script type="text/javascript">        $(document).ready(function(){            $('select[name=countrie_id]').change(function () {                var value = $(this).val() ;                $.post( "{{url('admin/cities_list')}}", { countrie: value })                    .done(function( data ) {                        $('select[name=citie_id]').html(data);                    });            }) ;        });        //	</script>@stop