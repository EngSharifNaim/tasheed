@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/advertisments') }}" >
        {{ __('admin.advertisments') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.advertisments_add') }}
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.advertisments_add') }} </span>
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
            <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/advertisments') }}"  enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.advertisments_name') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ old('name_ar') }}" placeholder="{{ __('admin.advertisments_name_ar') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.advertisments_name_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" required id="name_en" name="name_en" value="{{ old('name_en') }}"  placeholder="{{ __('admin.advertisments_name_en') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.advertisments_link') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"  id="link" name="link" value="{{ old('link') }}"  placeholder="{{ __('admin.advertisments_link') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_ar">{{ __('admin.advertisments_code') }}</label>
                        <div class="col-md-10">
                            <textarea class=" form-control" id="adverise_code" name="adverise_code"   placeholder="{{ __('admin.advertisments_code') }}">{{ old('adverise_code') }}</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.advertisments_image') }}</label>
                        <div class="col-md-10">
                            <input type="file"  class="form-control" id="image" name="image"  placeholder="{{ __('admin.advertisments_image') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="group_id">{{ __('admin.advertisments_section') }}</label>
                        <div class="col-md-10">
                            <select name="section_id" class="form-control">
                                <option value="0">{{ __('admin.sections_choose') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }}  @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--
                     'advertisments_beside_slider' => 'الاعلان بجانب السليدر' ,
    'advertisments_up_newest_product' => 'الاعلان اعلى احدث المنتجات' ,
    'advertisments_up_most_view' => 'الاعلان اعلى اكثر مشاهده' ,
    'advertisments_inside_section' => 'الاعلان الاول فى صفحه الاقسام' ,
    'advertisments_inside_section_beside_page' => 'الاعلان الجانبى فى صفحه الاقسام' ,
    'advertisments_inside_product' => 'الاعلان داخل المنتج' ,
    'advertisments_in_last_descount' => ' اعلان اخر التخفيض' ,
    --->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="location">{{ __('admin.advertisments_location') }}</label>
                        <div class="col-md-10">
                            <select name="location" class="form-control" required="required">
                                <option value="0">{{ __('admin.advertisments_location') }}</option>
                                <option value="1" >{{ __('admin.advertisments_beside_slider') }} </option>
                                <option value="2" > {{ __('admin.advertisments_up_newest_product') }}</option>
                                <option value="3" > {{ __('admin.advertisments_up_most_view') }}</option>
                                <option value="4" > {{ __('admin.advertisments_inside_section') }}</option>
                                <option value="5" > {{ __('admin.advertisments_inside_section_beside_page') }}</option>
                                <option value="6" >{{ __('admin.advertisments_inside_product') }} </option>
                                <option value="7" >{{ __('admin.advertisments_in_last_descount') }} </option>
                                <option value="8" >{{ __('admin.advertise_in_brand_page') }} </option>
                                <option value="9" >{{ __('admin.ads_in_top_page') }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">{{ __('admin.advertisments_start-date') }}</label>
                        <div class="col-md-10">
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control" readonly name="start_date">
                                <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                            </div>
                            <!-- /input-group -->
                            <span class="help-block"> {{ __('admin.select_date') }} </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">{{ __('admin.advertisments_end-date') }}</label>
                        <div class="col-md-10">
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control" name="end_date" readonly>
                                <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                            </div>
                            <!-- /input-group -->
                            <span class="help-block"> {{ __('admin.select_date') }} </span>
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
    <script src="{{ ASSETS }}/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ ASSETS }}/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection