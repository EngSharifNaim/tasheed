@extends(ad.'.layouts.app')


@section('head_title')

    <a href="{{ URL::to(ADMIN.'/pages') }}" >
        {{ __('admin.pages') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.pages_show') }}

@stop



@section('content')


  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.pages_show') }} <i class="fa fa-angle-right"></i>  {{ $page->name_ar }} / {{ $page->name_en }}  </span>
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



                                    <form class="form-horizontal" role="form">
                                    
                                        <div class="form-body">
                                            @if($page->parent_id != 0 )
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="group_id">{{ __('admin.pages_parent') }}</label>
                                                <div class="col-md-10">

                                                        <input type="text" class="form-control" id="g"  readonly="true"   value="{{ $page->parent_name_ar }} - {{ $page->parent_name_en }}">
                                                        <div class="form-control-focus"> </div>

                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.pages_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name_ar" name="name_ar"  readonly="true" value="{{ $page->name_ar }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name_en">{{ __('admin.pages_name_en') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="name_en" name="name_en"  readonly="true" value="{{ $page->name_en }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            @if($page->url)
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="url">{{ __('admin.pages_url') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="url" name="url"  readonly="true" value="{{ $page->url }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="description_ar">{{ __('admin.pages_content') }}</label>
                                                <div class="col-md-10">
                                                    <p>{!! $page->description_ar !!}</p>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="description_en">{{ __('admin.pages_content_en') }}</label>
                                                <div class="col-md-10">
                                                    <p>{!! $page->description_en !!}</p>
                                                </div>
                                            </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" for="active">{{ __('admin.page_location') }} : </label>
                                                    <div class="col-md-10">
                                                        <div class="radio-list">
                                                            @if ($page->page_location == 'top_bar')
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios26" value='top_bar' checked="true" disabled="true"> {{ __('admin.top_bar') }}</label>
                                                              @elseif ($page->page_location == 'menu')
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios28" value='menu' checked="true" disabled="true"> {{ __('admin.menu') }}</label>
                                                             @elseif($page->page_location == 'contact_page')
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios28" value='menu' checked="true" disabled="true"> {{ __('admin.contact_page') }}</label>
                                                              @elseif($page->page_location == 'hep')
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios28" value='menu' checked="true" disabled="true"> {{ __('admin.help_page') }}</label>
                                                               @elseif($page->page_location == 'page_condition_snodd')
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios29" value='page_condition_snodd' checked="true" disabled="true"> {{ __('admin.page_condition_snodd') }}
                                                                </label>
                                                              @else
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="page_location" id="optionsRadios28" value='footer' checked="true" disabled="true"> {{ __('admin.footer') }}</label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" for="sorting">{{ __('admin.sorting') }}</label>
                                                    <div class="col-md-10">
                                                        <input type="number" class="ckeditor form-control" id="sorting" name="sorting" value="{{ $page->sorting }}"  placeholder="{{ __('admin.sorting') }}" readonly="true">
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} :</label>
                                                    <div class="col-md-10">
                                                        <div class="radio-list">
                                                            <label class="radio-inline">
                                                                <input type="radio" readonly="true" name="{{ $page->active }}" id="optionsRadios26" value='{{ $page->active  }}' checked> @if($page->active == 'yes') {{ __('admin.active') }} @else {{ __('admin.inactive') }} @endif </label>

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