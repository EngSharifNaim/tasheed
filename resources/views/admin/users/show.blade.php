@extends(ad.'.layouts.app')
@section('head_title')
{{ __('admin.menu_users_show') }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.menu_users_show') }} </span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="display_name">{{ __('admin.users_adgroup') }}</label>
                                                <div class="col-md-10">
                                                   @if($user->level == 'user') {{ __('admin.users_level_client') }} @else {{ __('admin.users_level_dealer') }} @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="display_name">{{ __('admin.users_name') }}</label>
                                                <div class="col-md-10">
                                                   {{ $user->name }}
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="site_title">{{ __('admin.email_title') }}</label>
                                                <div class="col-md-10">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="first_name">{{ __('admin.first_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="{{ __('admin.first_name') }}" value="{{ $user->first_name }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="last_name">{{ __('admin.last_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="{{ __('admin.last_name') }}" value="{{ $user->last_name }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.users_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name" name="name"  placeholder="{{ __('admin.users_name') }}" value="{{ $user->name }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="phone">{{ __('admin.settings_site_phone') }}</label>
                                                <div class="col-md-10">
                                                    <input type="phone" class="form-control" id="phone" name="phone"  placeholder="{{ __('admin.settings_site_phone') }}" value="{{ $user->phone }}" readonly="true" >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                    </form>
                                    <form action="#" method='POST'>
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

                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

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