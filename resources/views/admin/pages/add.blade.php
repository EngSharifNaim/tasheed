@extends(ad.'.layouts.app') 
@section('head_title')

    <a href="{{ URL::to(ADMIN.'/pages') }}" >
        {{ __('admin.pages') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.pages_add_title') }}

@stop 
@section('content') 

  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.pages_add_title') }} </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/pages') }}"  enctype="multipart/form-data">                                     
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="group_id">{{ __('admin.pages_parent') }}</label>
                                                <div class="col-md-10">
                                                	<select name="parent_id" class="form-control">
                                                            <option value="0">{{ __('admin.pages_main_page') }}</option>
                                                            @foreach ($parents as $parent) 
                                                              <option value="{{ $parent->id }}"> @if(Lang::locale() == 'ar')  {{ $parent->name_ar }} @else  {{ $parent->name_ar }} @endif </option> 
                                                            @endforeach
                                                	</select>                                                    
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.pages_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name_ar" name="name_ar"  placeholder="{{ __('admin.pages_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name_en">{{ __('admin.pages_name_en') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name_en" name="name_en"  placeholder="{{ __('admin.pages_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="url">{{ __('admin.pages_url') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="url" name="url"  placeholder="{{ __('admin.pages_url') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="description_ar">{{ __('admin.pages_content') }}</label>
                                                <div class="col-md-10">
                                                    <textarea class="ckeditor form-control" id="description_ar" name="description_ar"  placeholder="{{ __('admin.pages_content') }}"></textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="description_en">{{ __('admin.pages_content_en') }}</label>
                                                <div class="col-md-10">
                                                    <textarea class="ckeditor form-control" id="description_en" name="description_en"  placeholder="{{ __('admin.pages_content_en') }}"></textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="sorting">{{ __('admin.sorting') }}</label>
                                                <div class="col-md-10">
                                                    <input type="number" class="ckeditor form-control" id="sorting" name="sorting" value="{{ old('sorting') }}"  placeholder="{{ __('admin.sorting') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="active">{{ __('admin.page_location') }} : </label>
                                                <div class="col-md-10">
                                                    <div class="radio-list">
                                                        @if (old('active') == 'top_bar')
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios26" value='top_bar' checked="true"> {{ __('admin.top_bar') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios27" value='menu'> {{ __('admin.menu') }} </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios28" value='footer'> {{ __('admin.footer') }} </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='contact_page' > {{ __('admin.contact_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='help' > {{ __('admin.help_page') }}
                                                            </label> 														
                                                        @elseif (old('active') == 'menu')
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios26" value='top_bar'> {{ __('admin.top_bar') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios27" value='menu' checked="true"> {{ __('admin.menu') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios28" value='footer' > {{ __('admin.footer') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='contact_page' checked="true"> {{ __('admin.contact_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='help' > {{ __('admin.help_page') }}
                                                            </label> 															
                                                        @elseif (old('active') == 'contact_page')
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios26" value='top_bar'> {{ __('admin.top_bar') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios27" value='menu' > {{ __('admin.menu') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios28" value='footer' > {{ __('admin.footer') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='contact_page' checked="true"> {{ __('admin.contact_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='help' > {{ __('admin.help_page') }}
                                                            </label> 														
                                                        @elseif (old('active') == 'help')
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios26" value='top_bar'> {{ __('admin.top_bar') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios27" value='menu' > {{ __('admin.menu') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios28" value='footer' > {{ __('admin.footer') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='contact_page' > {{ __('admin.contact_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='help' checked="true"> {{ __('admin.help_page') }}
                                                            </label> 		 											
														@else
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios26" value='top_bar'> {{ __('admin.top_bar') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios27" value='menu' > {{ __('admin.menu') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios28" value='footer'checked="true" > {{ __('admin.footer') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='contact_page' > {{ __('admin.contact_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='help' > {{ __('admin.help_page') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="page_location" id="optionsRadios29" value='page_condition_snodd' > {{ __('admin.page_condition_snodd') }}
                                                            </label> 															
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} : </label>
                                                <div class="col-md-10">
                                                    <div class="radio-list">
                                                        @if (old('active') == 'yes')
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
											 <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="activemenu"> اظهار فى التطبيق: </label>
                                                <div class="col-md-10">
                                                    <div class="radio-list">
                                                        @if (old('menu') == 'yes')
                                                            <label class="radio-inline">
                                                                <input type="radio" name="menu" id="optionsRadios26" value='yes' checked="true"> {{ __('admin.active') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="menu" id="optionsRadios27" value='no'> {{ __('admin.inactive') }} </label>
                                                        @else
                                                            <label class="radio-inline">
                                                                <input type="radio" name="menu" id="optionsRadios26" value='yes'> {{ __('admin.active') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="menu" id="optionsRadios27" value='no' checked="true"> {{ __('admin.inactive') }}</label>
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