@extends(ad.'.layouts.app')


@section('head_title')
@section('head_title')
	<a href="{{ URL::to(ADMIN.'/moderators') }}" >
		{{ __('admin.moderators') }}  </a> <i class="fa fa-angle-right"></i>
	{{ $user->name }}

@stop

@stop



@section('content')


  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.menu_moderators_show') }} </span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
								
                                    <form class="form-horizontal" role="form">
                                    
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="display_name">{{ __('admin.moderators_name') }}</label>
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
                                             <hr/>
                                            <h4>{{ __('admin.groups_permissions') }} </h4>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_admin_login') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="admin_read" class="md-check" name="parmession[admin][]" value="read" @if ($user->hasPermission('read-admin')) checked @endif disabled>
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
		                                                    <input type="checkbox" id="settings_read" class="md-check" name="parmession[settings][]" value="read" @if ($user->hasPermission('read-settings')) checked @endif disabled>
		                                                    <label for="settings_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="settings_update" class="md-check"  name="parmession[settings][]" value="update" @if ($user->hasPermission('update-settings')) checked @endif disabled>
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
		                                                    <input type="checkbox" id="moderators_create" class="md-check" name="parmession[moderators][]" value="create" @if ($user->hasPermission('create-moderators')) checked @endif disabled>
		                                                    <label for="moderators_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="moderators_read" class="md-check" name="parmession[moderators][]" value="read" @if ($user->hasPermission('read-moderators')) checked @endif disabled>
		                                                    <label for="moderators_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="moderators_update" class="md-check"  name="parmession[moderators][]" value="update" @if ($user->hasPermission('update-moderators')) checked @endif disabled>
		                                                    <label for="moderators_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="moderators_delete" class="md-check"  name="parmession[moderators][]" value="delete" @if ($user->hasPermission('delete-moderators')) checked @endif disabled>
		                                                    <label for="moderators_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_users') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="users_create" class="md-check" name="parmession[users][]" value="create" @if ($user->hasPermission('create-users')) checked @endif disabled>
		                                                    <label for="users_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="users_read" class="md-check" name="parmession[users][]" value="read" @if ($user->hasPermission('read-users')) checked @endif disabled>
		                                                    <label for="users_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="users_update" class="md-check"  name="parmession[users][]" value="update" @if ($user->hasPermission('update-users')) checked @endif disabled>
		                                                    <label for="users_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="users_delete" class="md-check"  name="parmession[users][]" value="delete" @if ($user->hasPermission('delete-users')) checked @endif disabled>
		                                                    <label for="users_delete">
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
		                                                    <input type="checkbox" id="users_create" class="md-check" name="parmession[users][]" value="create" @if ($user->hasPermission('create-users')) checked @endif disabled>
		                                                    <label for="users_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="users_read" class="md-check" name="parmession[users][]" value="read" @if ($user->hasPermission('read-users')) checked @endif disabled>
		                                                    <label for="users_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="users_update" class="md-check"  name="parmession[users][]" value="update" @if ($user->hasPermission('update-users')) checked @endif disabled>
		                                                    <label for="users_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="users_delete" class="md-check"  name="parmession[users][]" value="delete" @if ($user->hasPermission('delete-users')) checked @endif disabled>
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
		                                                    <input type="checkbox" id="categories_create" class="md-check" name="parmession[categories][]" value="create" @if ($user->hasPermission('create-categories')) checked @endif disabled>
		                                                    <label for="categories_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="categories_read" class="md-check" name="parmession[categories][]" value="read" @if ($user->hasPermission('read-categories')) checked @endif disabled>
		                                                    <label for="categories_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="categories_update" class="md-check"  name="parmession[categories][]" value="update" @if ($user->hasPermission('update-categories')) checked @endif disabled>
		                                                    <label for="categories_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="categories_delete" class="md-check"  name="parmession[categories][]" value="delete" @if ($user->hasPermission('delete-categories')) checked @endif disabled>
		                                                    <label for="categories_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_products') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="products_create" class="md-check" name="parmession[products][]" value="create" @if ($user->hasPermission('create-products')) checked @endif disabled>
		                                                    <label for="products_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="products_read" class="md-check" name="parmession[products][]" value="read" @if ($user->hasPermission('read-products')) checked @endif disabled>
		                                                    <label for="products_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="products_update" class="md-check"  name="parmession[products][]" value="update" @if ($user->hasPermission('update-products')) checked @endif disabled>
		                                                    <label for="products_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="products_delete" class="md-check"  name="parmession[products][]" value="delete" @if ($user->hasPermission('delete-products')) checked @endif disabled>
		                                                    <label for="products_delete">
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
		                                                    <input type="checkbox" id="brands_create" class="md-check" name="parmession[brands][]" value="create" @if ($user->hasPermission('create-brands')) checked @endif disabled>
		                                                    <label for="brands_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="brands_read" class="md-check" name="parmession[brands][]" value="read" @if ($user->hasPermission('read-brands')) checked @endif disabled>
		                                                    <label for="brands_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="brands_update" class="md-check"  name="parmession[brands][]" value="update" @if ($user->hasPermission('update-brands')) checked @endif disabled>
		                                                    <label for="brands_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="brands_delete" class="md-check"  name="parmession[brands][]" value="delete" @if ($user->hasPermission('delete-brands')) checked @endif disabled>
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
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="messages_create" class="md-check" name="parmession[messages][]" value="create" @if ($user->hasPermission('create-messages')) checked @endif disabled>
		                                                    <label for="messages_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="messages_read" class="md-check" name="parmession[messages][]" value="read" @if ($user->hasPermission('read-messages')) checked @endif disabled>
		                                                    <label for="messages_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="messages_update" class="md-check"  name="parmession[messages][]" value="update" @if ($user->hasPermission('update-messages')) checked @endif disabled>
		                                                    <label for="messages_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="messages_delete" class="md-check"  name="parmession[messages][]" value="delete" @if ($user->hasPermission('delete-messages')) checked @endif disabled>
		                                                    <label for="messages_delete">
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
		                                                    <input type="checkbox" id="pages_create" class="md-check" name="parmession[pages][]" value="create" @if ($user->hasPermission('create-pages')) checked @endif disabled>
		                                                    <label for="pages_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="pages_read" class="md-check" name="parmession[pages][]" value="read" @if ($user->hasPermission('read-pages')) checked @endif disabled>
		                                                    <label for="pages_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="pages_update" class="md-check"  name="parmession[pages][]" value="update" @if ($user->hasPermission('update-pages')) checked @endif disabled>
		                                                    <label for="pages_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="pages_delete" class="md-check"  name="parmession[pages][]" value="delete" @if ($user->hasPermission('delete-pages')) checked @endif disabled>
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
		                                                    <input type="checkbox" id="slideshow_create" class="md-check" name="parmession[slideshow][]" value="create" @if ($user->hasPermission('create-slideshow')) checked @endif disabled>
		                                                    <label for="slideshow_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="slideshow_read" class="md-check" name="parmession[slideshow][]" value="read" @if ($user->hasPermission('read-slideshow')) checked @endif disabled>
		                                                    <label for="slideshow_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="slideshow_update" class="md-check"  name="parmession[slideshow][]" value="update" @if ($user->hasPermission('update-slideshow')) checked @endif disabled>
		                                                    <label for="slideshow_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="slideshow_delete" class="md-check"  name="parmession[slideshow][]" value="delete" @if ($user->hasPermission('delete-slideshow')) checked @endif disabled>
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
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="contactus_create" class="md-check" name="parmession[contactus][]" value="create" @if ($user->hasPermission('create-contactus')) checked @endif disabled>
		                                                    <label for="contactus_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="contactus_read" class="md-check" name="parmession[contactus][]" value="read" @if ($user->hasPermission('read-contactus')) checked @endif disabled>
		                                                    <label for="contactus_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="contactus_update" class="md-check"  name="parmession[contactus][]" value="update" @if ($user->hasPermission('update-contactus')) checked @endif disabled>
		                                                    <label for="contactus_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="contactus_delete" class="md-check"  name="parmession[contactus][]" value="delete" @if ($user->hasPermission('delete-contactus')) checked @endif disabled>
		                                                    <label for="contactus_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_countries') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-success">
		                                                    <input type="checkbox" id="countries_create" class="md-check" name="parmession[countries][]" value="create" @if ($user->hasPermission('create-countries')) checked @endif disabled>
		                                                    <label for="countries_create">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.adding_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="countries_read" class="md-check" name="parmession[countries][]" value="read" @if ($user->hasPermission('read-countries')) checked @endif disabled>
		                                                    <label for="countries_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-info">
		                                                    <input type="checkbox" id="countries_update" class="md-check"  name="parmession[countries][]" value="update" @if ($user->hasPermission('update-countries')) checked @endif disabled>
		                                                    <label for="countries_update">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.editing_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="countries_delete" class="md-check"  name="parmession[countries][]" value="delete" @if ($user->hasPermission('delete-countries')) checked @endif disabled>
		                                                    <label for="countries_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">{{ __('admin.permissions_systemlog') }}</label>
                                                <div class="col-md-10">
		                                            <div class="md-checkbox-inline">
		                                                <div class="md-checkbox has-warning">
		                                                    <input type="checkbox" id="systemlog_read" class="md-check" name="parmession[systemlog][]" value="read" @if ($user->hasPermission('read-systemlog')) checked @endif disabled>
		                                                    <label for="systemlog_read">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.show_title') }} </label>
		                                                </div>
		                                                <div class="md-checkbox has-error">
		                                                    <input type="checkbox" id="systemlog_delete" class="md-check"  name="parmession[systemlog][]" value="delete" @if ($user->hasPermission('delete-systemlog')) checked @endif disabled>
		                                                    <label for="systemlog_delete">
		                                                        <span></span>
		                                                        <span class="check"></span>
		                                                        <span class="box"></span> {{ __('admin.delete_title') }} </label>
		                                                </div>
		                                            </div>
                                                </div>
                                            </div>
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