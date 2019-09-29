@extends(ad.'.layouts.app')
@section('head_title')
	<a href="{{ URL::to(ADMIN.'/roles') }}" >
		{{ __('admin.roles') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.groups_edit_page_title') }}  <i class="fa fa-angle-right"></i> {{ $role->name }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.groups_edit_page_title') }} </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/roles') }}/{{ $role->id }}"  enctype="multipart/form-data">
										<div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="display_name">{{ __('admin.groups_display_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $role->display_name }}" placeholder="{{ __('admin.groups_display_name_holder') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="site_title">{{ __('admin.groups_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="site_title" name="name" value="{{ $role->name }}"  placeholder="{{ __('admin.groups_name_holder') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.groups_description') }}</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="description" rows="3" placeholder="{{ __('admin.groups_description_holder') }}">{{ $role->description }}</textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                             <hr/>
                                            <h4>{{ __('admin.groups_permissions') }}</h4>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_admin_login') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="admin_read" class="md-check" name="parmession[admin][]" value="read" @if ($role->hasPermission('read-admin')) checked @endif>
		                                                    <label for="admin_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.yes') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_settings') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="settings_read" class="md-check" name="parmession[settings][]" value="read" @if ($role->hasPermission('read-settings')) checked @endif>
		                                                    <label for="settings_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="settings_update" class="md-check"  name="parmession[settings][]" value="update" @if ($role->hasPermission('update-settings')) checked @endif>
		                                                    <label for="settings_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_moderators') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="moderators_create" class="md-check" name="parmession[moderators][]" value="create" @if ($role->hasPermission('create-moderators')) checked @endif>
		                                                    <label for="moderators_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="moderators_read" class="md-check" name="parmession[moderators][]" value="read" @if ($role->hasPermission('read-moderators')) checked @endif>
		                                                    <label for="moderators_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="moderators_update" class="md-check"  name="parmession[moderators][]" value="update" @if ($role->hasPermission('update-moderators')) checked @endif>
		                                                    <label for="moderators_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="moderators_delete" class="md-check"  name="parmession[moderators][]" value="delete" @if ($role->hasPermission('delete-moderators')) checked @endif>
		                                                    <label for="moderators_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_roles') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="roles_create" class="md-check" name="parmession[roles][]" value="create" @if ($role->hasPermission('create-roles')) checked @endif>
		                                                    <label for="roles_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="roles_read" class="md-check" name="parmession[roles][]" value="read" @if ($role->hasPermission('read-roles')) checked @endif>
		                                                    <label for="roles_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="roles_update" class="md-check"  name="parmession[roles][]" value="update" @if ($role->hasPermission('update-roles')) checked @endif>
		                                                    <label for="roles_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="roles_delete" class="md-check"  name="parmession[roles][]" value="delete" @if ($role->hasPermission('delete-roles')) checked @endif>
		                                                    <label for="roles_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_members') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="users_create" class="md-check" name="parmession[users][]" value="create" @if ($role->hasPermission('create-users')) checked @endif>
		                                                    <label for="users_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="users_read" class="md-check" name="parmession[users][]" value="read" @if ($role->hasPermission('read-users')) checked @endif>
		                                                    <label for="users_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="users_update" class="md-check"  name="parmession[users][]" value="update" @if ($role->hasPermission('update-users')) checked @endif>
		                                                    <label for="users_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="users_delete" class="md-check"  name="parmession[users][]" value="delete" @if ($role->hasPermission('delete-users')) checked @endif>
		                                                    <label for="users_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_categories') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="categories_create" class="md-check" name="parmession[sections][]" value="create" @if ($role->hasPermission('create-sections')) checked @endif>
		                                                    <label for="categories_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="categories_read" class="md-check" name="parmession[sections][]" value="read" @if ($role->hasPermission('read-sections')) checked @endif>
		                                                    <label for="categories_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="categories_update" class="md-check"  name="parmession[sections][]" value="update" @if ($role->hasPermission('update-sections')) checked @endif>
		                                                    <label for="categories_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="categories_delete" class="md-check"  name="parmession[sections][]" value="delete" @if ($role->hasPermission('delete-sections')) checked @endif>
		                                                    <label for="categories_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_brands') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="brands_create" class="md-check" name="parmession[brands][]" value="create" @if ($role->hasPermission('create-brands')) checked @endif>
		                                                    <label for="brands_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="brands_read" class="md-check" name="parmession[brands][]" value="read" @if ($role->hasPermission('read-brands')) checked @endif>
		                                                    <label for="brands_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="brands_update" class="md-check"  name="parmession[brands][]" value="update" @if ($role->hasPermission('update-brands')) checked @endif>
		                                                    <label for="brands_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="brands_delete" class="md-check"  name="parmession[brands][]" value="delete" @if ($role->hasPermission('delete-brands')) checked @endif>
		                                                    <label for="brands_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_messages') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">

		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="chat_read" class="md-check" name="parmession[chat][]" value="read" @if ($role->hasPermission('read-chat')) checked @endif>
		                                                    <label for="chat_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>

		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="chat_delete" class="md-check"  name="parmession[chat][]" value="delete" @if ($role->hasPermission('delete-chat')) checked @endif>
		                                                    <label for="chat_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_pages') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="pages_create" class="md-check" name="parmession[pages][]" value="create" @if ($role->hasPermission('create-pages')) checked @endif>
		                                                    <label for="pages_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="pages_read" class="md-check" name="parmession[pages][]" value="read" @if ($role->hasPermission('read-pages')) checked @endif>
		                                                    <label for="pages_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="pages_update" class="md-check"  name="parmession[pages][]" value="update" @if ($role->hasPermission('update-pages')) checked @endif>
		                                                    <label for="pages_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="pages_delete" class="md-check"  name="parmession[pages][]" value="delete" @if ($role->hasPermission('delete-pages')) checked @endif>
		                                                    <label for="pages_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_slideshow') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="slideshow_create" class="md-check" name="parmession[slideshow][]" value="create" @if ($role->hasPermission('create-slideshow')) checked @endif>
		                                                    <label for="slideshow_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="slideshow_read" class="md-check" name="parmession[slideshow][]" value="read" @if ($role->hasPermission('read-slideshow')) checked @endif>
		                                                    <label for="slideshow_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="slideshow_update" class="md-check"  name="parmession[slideshow][]" value="update" @if ($role->hasPermission('update-slideshow')) checked @endif>
		                                                    <label for="slideshow_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="slideshow_delete" class="md-check"  name="parmession[slideshow][]" value="delete" @if ($role->hasPermission('delete-slideshow')) checked @endif>
		                                                    <label for="slideshow_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_contactus') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">

		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="contact_messages_read" class="md-check" name="parmession[contact_messages][]" value="read" @if ($role->hasPermission('read-contact_messages')) checked @endif>
		                                                    <label for="contact_messages_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="contact_messages_update" class="md-check"  name="parmession[contact_messages][]" value="update" @if ($role->hasPermission('update-contact_messages')) checked @endif>
		                                                    <label for="contact_messages_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="contact_messages_delete" class="md-check"  name="parmession[contact_messages][]" value="delete" @if ($role->hasPermission('delete-contact_messages')) checked @endif>
		                                                    <label for="contact_messages_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <!----system log ------------->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_systemlog') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="systemlog_read" class="md-check" name="parmession[systemlog][]" value="read" @if ($role->hasPermission('read-systemlog')) checked @endif>
		                                                    <label for="systemlog_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="systemlog_delete" class="md-check"  name="parmession[systemlog][]" value="delete" @if ($role->hasPermission('delete-systemlog')) checked @endif>
		                                                    <label for="systemlog_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
											<!----add by zezo --->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_sliders') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="sliders_create" class="md-check" name="parmession[sliders][]" value="create" @if ($role->hasPermission('create-sliders')) checked @endif>
															<label for="sliders_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="sliders_read" class="md-check" name="parmession[sliders][]" value="read" @if ($role->hasPermission('read-sliders')) checked @endif>
															<label for="sliders_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="sliders_update" class="md-check"  name="parmession[sliders][]" value="update" @if ($role->hasPermission('update-sliders')) checked @endif>
															<label for="sliders_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="sliders_delete" class="md-check"  name="parmession[sliders][]" value="delete" @if ($role->hasPermission('delete-sliders')) checked @endif>
															<label for="sliders_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---country-------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_countries') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="countries_create" class="md-check" name="parmession[countries][]" value="create" @if ($role->hasPermission('create-countries')) checked @endif>
															<label for="countries_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="countries_read" class="md-check" name="parmession[countries][]" value="read" @if ($role->hasPermission('read-countries')) checked @endif>
															<label for="countries_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="countries_update" class="md-check"  name="parmession[countries][]" value="update" @if ($role->hasPermission('update-countries')) checked @endif>
															<label for="countries_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="countries_delete" class="md-check"  name="parmession[countries][]" value="delete" @if ($role->hasPermission('delete-countries')) checked @endif>
															<label for="countries_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!----city----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_cities') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="cities_create" class="md-check" name="parmession[cities][]" value="create" @if ($role->hasPermission('create-cities')) checked @endif>
															<label for="cities_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="cities_read" class="md-check" name="parmession[cities][]" value="read" @if ($role->hasPermission('read-cities')) checked @endif>
															<label for="cities_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="cities_update" class="md-check"  name="parmession[cities][]" value="update" @if ($role->hasPermission('update-cities')) checked @endif>
															<label for="cities_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="cities_delete" class="md-check"  name="parmession[cities][]" value="delete" @if ($role->hasPermission('delete-cities')) checked @endif>
															<label for="cities_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---regions---->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_regions') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="regions_create" class="md-check" name="parmession[regions][]" value="create" @if ($role->hasPermission('create-regions')) checked @endif>
															<label for="regions_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="regions_read" class="md-check" name="parmession[regions][]" value="read" @if ($role->hasPermission('create-regions')) checked @endif>
															<label for="regions_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="regions_update" class="md-check"  name="parmession[regions][]" value="update" @if ($role->hasPermission('create-regions')) checked @endif>
															<label for="regions_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="regions_delete" class="md-check"  name="parmession[regions][]" value="delete" @if ($role->hasPermission('create-regions')) checked @endif>
															<label for="regions_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---colors----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.colors_mangment') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="colors_create" class="md-check" name="parmession[colors][]" value="create" @if ($role->hasPermission('create-colors')) checked @endif>
															<label for="colors_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="colors_read" class="md-check" name="parmession[colors][]" value="read" @if ($role->hasPermission('read-colors')) checked @endif>
															<label for="colors_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="colors_update" class="md-check"  name="parmession[colors][]" value="update" @if ($role->hasPermission('update-colors')) checked @endif>
															<label for="colors_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="colors_delete" class="md-check"  name="parmession[colors][]" value="delete" @if ($role->hasPermission('delete-colors')) checked @endif>
															<label for="colors_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---sizes----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.sizes_mangment') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="sizes_create" class="md-check" name="parmession[sizes][]" value="create" @if ($role->hasPermission('create-sizes')) checked @endif>
															<label for="sizes_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="sizes_read" class="md-check" name="parmession[sizes][]" value="read" @if ($role->hasPermission('read-sizes')) checked @endif>
															<label for="sizes_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="sizes_update" class="md-check"  name="parmession[sizes][]" value="update" @if ($role->hasPermission('update-sizes')) checked @endif>
															<label for="sizes_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="sizes_delete" class="md-check"  name="parmession[sizes][]" value="delete" @if ($role->hasPermission('delete-sizes')) checked @endif>
															<label for="sizes_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---products----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.products_mangment') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="products_create" class="md-check" name="parmession[products][]" value="create" @if ($role->hasPermission('create-products')) checked @endif>
															<label for="products_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="products_read" class="md-check" name="parmession[products][]" value="read" @if ($role->hasPermission('read-products')) checked @endif>
															<label for="products_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="products_update" class="md-check"  name="parmession[products][]" value="update" @if ($role->hasPermission('update-products')) checked @endif>
															<label for="products_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="products_delete" class="md-check"  name="parmession[products][]" value="delete" @if ($role->hasPermission('delete-products')) checked @endif>
															<label for="products_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---orders----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.orders_mangment') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">

														<div class="md-checkbox has-warning">
															<input type="checkbox" id="orders_read" class="md-check" name="parmession[orders][]" value="read" @if ($role->hasPermission('read-orders')) checked @endif>
															<label for="orders_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="orders_update" class="md-check"  name="parmession[orders][]" value="update" @if ($role->hasPermission('update-orders')) checked @endif>
															<label for="orders_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="orders_delete" class="md-check"  name="parmession[orders][]" value="delete" @if ($role->hasPermission('delete-orders')) checked @endif>
															<label for="orders_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---reports----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.reports_mangment') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="reports_create" class="md-check" name="parmession[reports][]" value="create" @if ($role->hasPermission('create-reports')) checked @endif>
															<label for="reports_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="reports_read" class="md-check" name="parmession[reports][]" value="read" @if ($role->hasPermission('read-reports')) checked @endif>
															<label for="reports_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="reports_update" class="md-check"  name="parmession[reports][]" value="update" @if ($role->hasPermission('update-reports')) checked @endif>
															<label for="reports_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="reports_delete" class="md-check"  name="parmession[reports][]" value="delete" @if ($role->hasPermission('delete-reports')) checked @endif>
															<label for="reports_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---Questions And Answers----->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.questionsandanswers_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="questionsandanswers_create" class="md-check" name="parmession[questionsandanswers][]" value="create" @if ($role->hasPermission('create-questionsandanswers')) checked @endif>
															<label for="questionsandanswers_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="questionsandanswers_read" class="md-check" name="parmession[questionsandanswers][]" value="read" @if ($role->hasPermission('read-questionsandanswers')) checked @endif>
															<label for="questionsandanswers_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="questionsandanswers_update" class="md-check"  name="parmession[questionsandanswers][]" value="update" @if ($role->hasPermission('update-questionsandanswers')) checked @endif>
															<label for="questionsandanswers_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="questionsandanswers_delete" class="md-check"  name="parmession[questionsandanswers][]" value="delete" @if ($role->hasPermission('delete-questionsandanswers')) checked @endif>
															<label for="questionsandanswers_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---currencies ------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.currencies_mange') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="currencies_create" class="md-check" name="parmession[currencies][]" value="create" @if ($role->hasPermission('create-currencies')) checked @endif>
															<label for="currencies_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="currencies_read" class="md-check" name="parmession[currencies][]" value="read" @if ($role->hasPermission('read-currencies')) checked @endif>
															<label for="currencies_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="currencies_update" class="md-check"  name="parmession[currencies][]" value="update" @if ($role->hasPermission('update-currencies')) checked @endif>
															<label for="currencies_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="currencies_delete" class="md-check"  name="parmession[currencies][]" value="delete" @if ($role->hasPermission('delete-currencies')) checked @endif>
															<label for="currencies_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---reviews ------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.reviews_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="reviews_create" class="md-check" name="parmession[reviews][]" value="create" @if ($role->hasPermission('create-reviews')) checked @endif>
															<label for="reviews_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="reviews_read" class="md-check" name="parmession[reviews][]" value="read" @if ($role->hasPermission('read-reviews')) checked @endif>
															<label for="reviews_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="reviews_update" class="md-check"  name="parmession[reviews][]" value="update" @if ($role->hasPermission('update-reviews')) checked @endif>
															<label for="reviews_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="reviews_delete" class="md-check"  name="parmession[reviews][]" value="delete" @if ($role->hasPermission('delete-reviews')) checked @endif>
															<label for="reviews_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!---advertisments ------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.advertisments_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="advertisments_create" class="md-check" name="parmession[advertisments][]" value="create" @if ($role->hasPermission('create-advertisments')) checked @endif>
															<label for="advertisments_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="advertisments_read" class="md-check" name="parmession[advertisments][]" value="read" @if ($role->hasPermission('read-advertisments')) checked @endif>
															<label for="advertisments_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="advertisments_update" class="md-check"  name="parmession[advertisments][]" value="update" @if ($role->hasPermission('update-advertisments')) checked @endif>
															<label for="advertisments_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="advertisments_delete" class="md-check"  name="parmession[advertisments][]" value="delete" @if ($role->hasPermission('delete-advertisments')) checked @endif>
															<label for="advertisments_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--->
											<!---measurements_units ------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.measurements_units_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="measurements_units_create" class="md-check" name="parmession[measurements_units][]" value="create" @if ($role->hasPermission('create-measurements_units')) checked @endif>
															<label for="measurements_units_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="measurements_units_read" class="md-check" name="parmession[measurements_units][]" value="read" @if ($role->hasPermission('read-measurements_units')) checked @endif>
															<label for="measurements_units_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="measurements_units_update" class="md-check"  name="parmession[measurements_units][]" value="update" @if ($role->hasPermission('update-measurements_units')) checked @endif>
															<label for="measurements_units_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="measurements_units_delete" class="md-check"  name="parmession[measurements_units][]" value="delete" @if ($role->hasPermission('delete-measurements_units')) checked @endif>
															<label for="measurements_units_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--->
											<!---cupons ------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.cupons_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="cupons_create" class="md-check" name="parmession[cupons][]" value="create" @if ($role->hasPermission('create-cupons')) checked @endif>
															<label for="cupons_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="cupons_read" class="md-check" name="parmession[cupons][]" value="read" @if ($role->hasPermission('read-cupons')) checked @endif>
															<label for="cupons_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="cupons_update" class="md-check"  name="parmession[cupons][]" value="update" @if ($role->hasPermission('update-cupons')) checked @endif>
															<label for="cupons_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="cupons_delete" class="md-check"  name="parmession[cupons][]" value="delete" @if ($role->hasPermission('delete-cupons')) checked @endif>
															<label for="cupons_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--shipings ---->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.shipings_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="shipings_create" class="md-check" name="parmession[shipings][]" value="create" @if ($role->hasPermission('create-shipings')) checked @endif>
															<label for="shipings_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="shipings_read" class="md-check" name="parmession[shipings][]" value="read" @if ($role->hasPermission('read-shipings')) checked @endif>
															<label for="shipings_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="shipings_update" class="md-check"  name="parmession[shipings][]" value="update" @if ($role->hasPermission('update-shipings')) checked @endif>
															<label for="shipings_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="shipings_delete" class="md-check"  name="parmession[shipings][]" value="delete" @if ($role->hasPermission('delete-shipings')) checked @endif>
															<label for="shipings_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!----subscribers_manage-------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.subscribers_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="newsletters_read" class="md-check" name="parmession[newsletters][]" value="read" @if ($role->hasPermission('delete-newsletters')) checked @endif>
															<label for="newsletters_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="newsletters_delete" class="md-check"  name="parmession[newsletters][]" value="delete" @if ($role->hasPermission('delete-newsletters')) checked @endif>
															<label for="newsletters_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--->
											<!----user_addresses_manage-------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.user_addresses_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="users_addresses_create" class="md-check" name="parmession[users_addresses][]" value="create" @if ($role->hasPermission('create-users_addresses')) checked @endif >
															<label for="users_addresses_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="users_addresses_read" class="md-check" name="parmession[users_addresses][]" value="read" @if ($role->hasPermission('read-users_addresses')) checked @endif>
															<label for="users_addresses_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="users_addresses_update" class="md-check"  name="parmession[users_addresses][]" value="update" @if ($role->hasPermission('update-users_addresses')) checked @endif>
															<label for="users_addresses_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="users_addresses_delete" class="md-check"  name="parmession[users_addresses][]" value="delete" @if ($role->hasPermission('delete-users_addresses')) checked @endif>
															<label for="users_addresses_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--->
											<!----site percenatge amount from sall-------------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.siteprofits_manage') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="siteprofits_read" class="md-check" name="parmession[siteprofits][]" value="read"  @if ($role->hasPermission('read-siteprofits')) checked @endif>
															<label for="siteprofits_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="siteprofits_update" class="md-check"  name="parmession[siteprofits][]" value="update" @if ($role->hasPermission('update-siteprofits')) checked @endif>
															<label for="siteprofits_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="siteprofits_delete" class="md-check"  name="parmession[siteprofits][]" value="delete" @if ($role->hasPermission('delete-siteprofits')) checked @endif>
															<label for="siteprofits_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.userlevels') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-success">
															<input type="checkbox" id="userlevels_create" class="md-check" name="parmession[userlevels][]" value="create" @if ($role->hasPermission('create-userlevels')) checked @endif>
															<label for="userlevels_create">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.adding_title') }} </label>
														</div>
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="userlevels_read" class="md-check" name="parmession[userlevels][]" value="read" @if ($role->hasPermission('read-userlevels')) checked @endif>
															<label for="userlevels_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="userlevels_update" class="md-check"  name="parmession[userlevels][]" value="update" @if ($role->hasPermission('update-userlevels')) checked @endif >
															<label for="userlevels_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														<div class="md-checkbox has-error">
															<input type="checkbox" id="userlevels_delete" class="md-check"  name="parmession[userlevels][]" value="delete" @if ($role->hasPermission('delete-userlevels')) checked @endif>
															<label for="userlevels_delete">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.delete_title') }} </label>
														</div>
													</div>
												</div>
											</div>
											<!--->
											    <!--- control in mobile sending message------------->
											<div class="form-group form-md-line-input">
												<label class="col-md-2 control-label" for="form_control_1">{{ __('admin.mobilymessages') }}</label>
												<div class="col-md-10">
													<div class="md-checkbox-inline">
														<div class="md-checkbox has-warning">
															<input type="checkbox" id="mobilymessages_read" class="md-check" name="parmession[mobilymessages][]" value="read" @if ($role->hasPermission('read-mobilymessages')) checked @endif >
															<label for="mobilymessages_read">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.show_title') }} </label>
														</div>
														<div class="md-checkbox has-info">
															<input type="checkbox" id="mobilymessages_update" class="md-check"  name="parmession[mobilymessages][]" value="update" @if ($role->hasPermission('update-mobilymessages')) checked @endif >
															<label for="mobilymessages_update">
																<span></span>
																<span class="check"></span>
																<span class="box"></span> {{ __('admin.editing_title') }} </label>
														</div>
														
													</div>
												</div>
											</div>
											<!--->
											<!--->
											
											<!----reports-------------------->
											<!--->
											<!----end abdelaziz update------->
											<!---------end added zezo ------>
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