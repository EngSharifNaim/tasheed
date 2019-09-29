@extends(ad.'.layouts.app')
@section('head_title')
{{ __('admin.users_add_title') }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.users_add_title') }} </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/users') }}"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="group_id">{{ __('admin.users_adgroup') }}</label>
                                                <div class="col-md-10">
                                                	<select name="level" class="form-control">
													@foreach($userlevels as $userlevel)
                                                            <option value="{{ $userlevel->slug }}">{{ $userlevel->name_en }} - {{ $userlevel->name_ar }}</option>
													@endforeach		
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="first_name">{{ __('admin.first_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="{{ __('admin.first_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="last_name">{{ __('admin.last_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="{{ __('admin.last_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="phone">{{ __('admin.settings_site_mobile') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="phone" name="phone"  placeholder="{{ __('admin.settings_site_mobile') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.users_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name" name="name"  placeholder="{{ __('admin.users_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="email">{{ __('admin.email_title') }}</label>
                                                <div class="col-md-10">
                                                    <input type="email" class="form-control" id="email" name="email"  placeholder="{{ __('admin.email_title') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="password">{{ __('admin.users_password') }}</label>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control" id="password" name="password"  placeholder="{{ __('admin.users_password') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="password">{{ __('admin.users_active') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-radio-inline">
		                                                <div class="md-radio">
		                                                    <input type="radio" id="active_yes" name="active" value="yes" class="md-radiobtn" checked>
		                                                    <label for="active_yes">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span>{{ __('admin.yes') }} </label>
		                                                </div>
		                                                <div class="md-radio has-error">
		                                                    <input type="radio" id="active_no" name="active" value="no" class="md-radiobtn">
		                                                    <label for="active_no">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.no') }} </label>
		                                                </div>
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