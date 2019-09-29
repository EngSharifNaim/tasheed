@extends(ad.'.layouts.app')
@section('head_title')
{{ __('admin.users_edite_title') }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.users_edite_title') }} </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/users') }}/{{ $user->id }}"  enctype="multipart/form-data">
                                        <div class="form-body">
                                          <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="group_id">{{ __('admin.users_adgroup') }}</label>
                                                <div class="col-md-10">
                                                    <select name="level" class="form-control">
														@foreach($userlevels as $userlevel)
                                                            <option value="{{ $userlevel->slug }}" @if($user->level === $userlevel->slug) selected @endif>{{ $userlevel->name_en }} - {{ $userlevel->name_ar }}</option>
													     @endforeach	
                                                            <option value="user" @if($user->level == 'user') selected @endif>{{ __('admin.users_level_client') }}</option>
                                                            <option value="dealer" @if($user->level == 'dealer') selected @endif>{{ __('admin.users_level_dealer') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="first_name">{{ __('admin.first_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="{{ __('admin.first_name') }}" value="{{ $user->first_name }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="last_name">{{ __('admin.last_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="{{ __('admin.last_name') }}" value="{{ $user->last_name }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.users_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name" name="name"  placeholder="{{ __('admin.users_name') }}" value="{{ $user->name }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="phone">{{ __('admin.settings_site_phone') }}</label>
                                                <div class="col-md-10">
                                                    <input type="phone" class="form-control" id="phone" name="phone"  placeholder="{{ __('admin.settings_site_phone') }}" value="{{ $user->phone }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="email">{{ __('admin.email_title') }}</label>
                                                <div class="col-md-10">
                                                    <input type="email" class="form-control" id="email" name="email"  placeholder="{{ __('admin.email_title') }}" value="{{ $user->email }}">
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
		                                                    <input type="radio" id="active_yes" name="active" value="yes" class="md-radiobtn" @if($user->active == 'yes') checked @endif>
		                                                    <label for="active_yes">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span>{{ __('admin.yes') }} </label>
		                                                </div>
		                                                <div class="md-radio has-error">
		                                                    <input type="radio" id="active_no" name="active" value="no" class="md-radiobtn" @if($user->active == 'no') checked @endif>
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
                                                    <button type="submit" class="btn blue">{{ __('admin.edit_title') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                    </form>

                                    <form action="{{ URL::to(ADMIN.'/users_addresses_delete') }}" method='POST'>
                                        <!---------------------------------->
                                        <!---end user addresse ------------------->
                                        <!-------------------------------------->
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
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
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th> {{ __('admin.user_addresse_ar') }} </th>
                                                <th> {{ __('admin.user_addresse_en') }}</th>
                                                <th> {{ __('admin.country_title') }} </th>
                                                <th> {{ __('admin.city_title') }} </th>
                                                <th> {{ __('admin.region_title') }} </th>
                                                <th> {{  __('admin.options_title') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($user_addresses)
                                                @foreach($user_addresses as $user_addresse)
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $user->id }}" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td> {{ $user_addresse->addresse_ar }} </td>
                                                        <td>
                                                            {{ $user_addresse->addresse_en }} </td>
                                                        <td>
                                                            {{ $user_addresse->countrie->name_ar }}
                                                        </td>
                                                        <td>
                                                            {{ $user_addresse->citie->name_ar }}
                                                        </td>
                                                        <td>
                                                            {{ $user_addresse->region->name_ar }}
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-left" user="menu">
                                                                    <li>
                                                                        <a href="{{ URL::to(ADMIN.'/users_addresses') }}/{{ $user_addresse->id }}">
                                                                            <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ URL::to(ADMIN.'/users_addresses') }}/{{ $user_addresse->id }}/edit">
                                                                            <i class="icon-note"></i> {{ __('admin.editing_title') }} </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">

                                            <button type="submit" name="delete" class="btn btn-danger" onclick='return confirm("{{ __('admin.delete_confirm') }}");'><li class="fa fa-trash-o"></li> {{ __('admin.delete_mass_title') }}</button>

                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
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
@section('page_scripts')

@stop