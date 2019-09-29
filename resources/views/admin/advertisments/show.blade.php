@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/advertisments') }}" >
        {{ __('admin.advertisments') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.advertisments_update') }}  <i class="fa fa-angle-right"></i>@if(Lang::locale() == 'ar') {{ $advertisment->name_ar }} @else {{ $advertisment->name_en }} @endif
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.advertisments_update') }}  <i class="fa fa-angle-right"></i> @if(Lang::locale() == 'ar') {{ $advertisment->name_ar }} @else {{ $advertisment->name_en }} @endif</span>
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
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.advertisments_name') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" disabled="true" required="required" id="name_ar" name="name_ar"  value="{{ $advertisment->name_ar }}" placeholder="{{ __('admin.advertisments_name_ar') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.advertisments_name_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" disabled="true" required id="name_en" name="name_en" value="{{ $advertisment->name_en }}"  placeholder="{{ __('admin.advertisments_name_en') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.advertisments_link') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" disabled="true"  id="link" name="link" value="{{ $advertisment->link }}"  placeholder="{{ __('admin.advertisments_link') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_ar">{{ __('admin.advertisments_code') }}</label>
                        <div class="col-md-10">
                            <textarea class=" form-control" disabled="true" id="adverise_code" name="adverise_code"   placeholder="{{ __('admin.advertisments_code') }}">{{ $advertisment->adverise_code }}</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.advertisments_image') }}</label>
                        <div class="col-md-10">
                            @if(!empty( $advertisment->image))
                                <img src="{{ URL::to('public') }}{{ $advertisment->image }}" width="200" height="200">
                            @endif
                             <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="group_id">{{ __('admin.advertisments_section') }}</label>
                        <div class="col-md-10">
                            <select disabled="true" name="section_id" class="form-control">
                                <option >{{ __('admin.sections_choose') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" @if($advertisment->section_id == $section->id) selected="true" @endif >@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }}  @endif</option>
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
                            <select name="location" disabled="true" class="form-control" disabled="true">
                                <option>{{ __('admin.advertisments_location') }}</option>
                                <option value="1" @if($advertisment->location == 1 ) selected="true" @endif>{{ __('admin.advertisments_beside_slider') }} </option>
                                <option value="2" @if($advertisment->location == 2 ) selected="true" @endif> {{ __('admin.advertisments_up_newest_product') }}</option>
                                <option value="3" @if($advertisment->location == 3 ) selected="true" @endif> {{ __('admin.advertisments_up_most_view') }}</option>
                                <option value="4" @if($advertisment->location == 4 ) selected="true" @endif> {{ __('admin.advertisments_inside_section') }}</option>
                                <option value="5" @if($advertisment->location == 5 ) selected="true" @endif> {{ __('admin.advertisments_inside_section_beside_page') }}</option>
                                <option value="6" @if($advertisment->location == 6 ) selected="true" @endif>{{ __('admin.advertisments_inside_product') }} </option>
                                <option value="7" @if($advertisment->location == 7 ) selected="true" @endif>{{ __('admin.advertisments_in_last_descount') }} </option>
                                <option value="8" @if($advertisment->location == 8 ) selected="true" @endif>{{ __('admin.advertise_in_brand_page') }} </option>
                                <option value="9" @if($advertisment->location == 9 ) selected="true" @endif>{{ __('admin.ads_in_top_page') }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">{{ __('admin.advertisments_start-date') }}</label>
                        <div class="col-md-10">
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" disabled="true" class="form-control"  value="{{$advertisment->start_date }}" readonly name="start_date">
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
                                <input type="text" disabled="true" class="form-control" value="{{$advertisment->end_date }}" name="end_date" readonly>
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
                                @if ($advertisment->active == 'yes')
                                    <label class="radio-inline">
                                        <input type="radio" disabled="true" name="active" id="optionsRadios26" value='yes' checked="true"> {{ __('admin.active') }}</label>
                                @else
                                   <label class="radio-inline">
                                        <input type="radio"  disabled="true" name="active" id="optionsRadios27" value='no' checked="true"> {{ __('admin.inactive') }}</label>
                                @endif
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