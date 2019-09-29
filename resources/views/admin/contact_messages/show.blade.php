@extends(ad.'.layouts.app')


@section('head_title')

{{ __('admin.message_show') }}

@stop



@section('content')


  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.message_show') }} </span>
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



                                        <div class="form-body">

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.contact_us_title') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" readonly value="{{ $message->title }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name_en">{{ __('admin.contact_us_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" readonly value="{{ $message->name }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="url">{{ __('admin.contact_us_email') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="url" readonly  placeholder="{{ __('admin.contact_us_email') }}" value="{{ $message->email }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="url">{{ __('admin.sender_mobile') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="url" readonly  placeholder="{{ __('admin.sender_mobile') }}" value="{{ $message->mobile }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="description_ar">{{ __('admin.message_text') }}</label>
                                                <div class="col-md-10">
                                                    <p>{!! $message->text !!}  </textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>



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