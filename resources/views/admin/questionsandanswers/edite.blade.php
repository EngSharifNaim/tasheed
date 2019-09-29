@extends(ad.'.layouts.app')


@section('head_title')

	<a href="{{ URL::to(ADMIN.'/questionsandanswers') }}" >
		{{ __('admin.questionsandanswers') }}  </a> <i class="fa fa-angle-right"></i>
	{{ __('admin.questionsandanswers_update') }}  <i class="fa fa-angle-right"></i> {{ $question->name_ar }} / {{ $question->name_en }}

@stop



@section('content')


	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light ">
		<div class="portlet-title">
			<div class="caption font-green-haze">
				<i class="icon-settings font-green-haze"></i>
				<span class="caption-subject bold uppercase"> {{ __('admin.questionsandanswers_update') }} <i class="fa fa-angle-right"></i> {{ $question->name_ar }} / {{ $question->name_en }}</span>
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



			<form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/questionsandanswers') }}/{{ $question->id }}"  enctype="multipart/form-data">

				<div class="form-body">

					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="name">{{ __('admin.questionsandanswers_question_name_ar') }}</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="name_ar" name="name_ar"  placeholder="{{ __('admin.questionsandanswers_question_name_ar') }}" value="{{$question->name_ar}}">
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="name_en">{{ __('admin.questionsandanswers_question_name_en') }}</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="name_en" name="name_en"  placeholder="{{ __('admin.questionsandanswers_question_name_en') }}" value="{{$question->name_en}}">
							<div class="form-control-focus"> </div>
						</div>
					</div>

					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="description_ar">{{ __('admin.questionsandanswers_question_answers_ar') }}</label>
						<div class="col-md-10">
							<textarea class="ckeditor form-control" id="description_ar" name="description_ar"  placeholder="{{ __('admin.questionsandanswers_question_answers_ar') }}"> {{ $question->description_ar }}</textarea>
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="description_en">{{ __('admin.questionsandanswers_question_answers_en') }}</label>
						<div class="col-md-10">
							<textarea class="ckeditor form-control" id="description_en" name="description_en"  placeholder="{{ __('admin.questionsandanswers_question_answers_en') }}"> {{ $question->description_en }} </textarea>
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="active">:{{ __('admin.active_status') }}</label>
						<div class="col-md-10">
							<div class="radio-list">
								@if ( $question->active == 'yes')
									<label class="radio-inline">
										<input type="radio" name="active" id="optionsRadios26" value='yes' checked="true"> {{ __('admin.active') }}</label>
									<label class="radio-inline">
										<input type="radio" name="active" id="optionsRadios27" value='no'> {{ __('admin.inactive') }} </label>
								@else
									<label class="radio-inline">
										<input type="radio" name="active" id="optionsRadios26" value='yes'> {{ __('admin.active') }}</label>
									<label class="radio-inline">
										<input type="radio" name="active" id="optionsRadios27" value='no' checked="true"> {{ __('admin.inactive') }}</label>
								@endif
							</div>
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