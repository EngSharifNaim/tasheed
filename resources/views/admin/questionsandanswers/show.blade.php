@extends(ad.'.layouts.app')


@section('head_title')

	<a href="{{ URL::to(ADMIN.'/questionsandanswers') }}" >
		{{ __('admin.questionsandanswers') }}  </a> <i class="fa fa-angle-right"></i>
	{{ __('admin.questionsandanswers_show') }} <i class="fa fa-angle-right"></i> {{ $question->name_ar }} / {{ $question->name_en }}

@stop



@section('content')


	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light ">
		<div class="portlet-title">
			<div class="caption font-green-haze">
				<i class="icon-settings font-green-haze"></i>
				<span class="caption-subject bold uppercase"> {{ __('admin.questionsandanswers_show') }} <i class="fa fa-angle-right"></i> {{ $question->name_ar }} / {{ $question->name_en }} </span>
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



			<form class="form-horizontal" role="form"  >

				<div class="form-body">

					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="name">{{ __('admin.questionsandanswers_question_name_ar') }}</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="name_ar" name="name_ar"  placeholder="{{ __('admin.questionsandanswers_question_name_ar') }}"  readonly="true" value="{{$question->name_ar}}">
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="name_en">{{ __('admin.questionsandanswers_question_name_en') }}</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="name_en" name="name_en"  placeholder="{{ __('admin.questionsandanswers_question_name_en') }}" value="{{$question->name_en}}" readonly="true">
							<div class="form-control-focus"> </div>
						</div>
					</div>

					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="description_ar">{{ __('admin.questionsandanswers_question_answers_ar') }}</label>
						<div class="col-md-10">
							{!!  $question->description_ar !!}
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="description_en">{{ __('admin.questionsandanswers_question_answers_en') }}</label>
						<div class="col-md-10">
							<p> {!!  $question->description_en !!}   </textarea>
							<div class="form-control-focus"> </div>
						</div>
					</div>
					<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} :</label>
						<div class="col-md-10">
							<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" readonly="true" name="{{ $question->active }}" id="optionsRadios26" value='{{ $question->active  }}' checked> @if($question->active == 'yes') {{ __('admin.active') }} @else {{ __('admin.inactive') }} @endif </label>

							</div>
						</div>
					</div>
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