@extends(ad.'.layouts.app')
@section('head_title')
    {{ __('admin.settings_title') }}
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.settings_title') }} </span>
            </div>
        </div>
        <div class="portlet-body form">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <form class="form-horizontal" role="form" method="post" action="settings"  enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                <div class="form-body">
				<!----->
					<div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1"> التفعيل المباشر بدون اى خطوه اضافيه</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
							
                                <div class="md-radio has-success">
                                    <input type="radio" id="activetypea" name="data[activetypea]" value="yes" class="md-radiobtn" @if(isset($variables['activetypea']) && $variables['activetypea'] == 'yes') checked @endif>
                                    <label for="activetypea">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> مباشرة   </label>
                                </div>
                                <div class="md-radio has-error">
                                    <input type="radio" id="activetypea2" name="data[activetypea]" value="no" class="md-radiobtn"  @if(isset($variables['activetypea']) && $variables['activetypea'] == 'no') checked @endif>
                                    <label for="activetypea2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>    بالخطوات التاليه </label>
                                </div>
                            </div>
                        </div>
                    </div>
				<!----->
				<div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1"> تفعيل نظام الاشتراكات</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
							
                                <div class="md-radio has-success">
                                    <input type="radio" id="paidacount" name="data[paidacount]" value="yes" class="md-radiobtn" @if(isset($variables['paidacount']) && $variables['paidacount'] == 'yes') checked @endif>
                                    <label for="paidacount">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> مفعل   </label>
                                </div>
                                <div class="md-radio has-error">
                                    <input type="radio" id="paidacount2" name="data[paidacount]" value="no" class="md-radiobtn"  @if(isset($variables['paidacount']) && $variables['paidacount'] == 'no') checked @endif>
                                    <label for="paidacount2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> غير مفعل </label>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1"> التحكم بنظام تفعيل العضوية</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio has-success">
                                    <input type="radio" id="site_activetsregister" name="data[site_activetsregister]" value="yes" class="md-radiobtn" @if(isset($variables['site_activetsregister']) && $variables['site_activetsregister'] == 'yes') checked @endif>
                                    <label for="site_activetsregister">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> رساله نصيه  </label>
                                </div>
                                <div class="md-radio has-error">
                                    <input type="radio" id="site_activetsregister2" name="data[site_activetsregister]" value="no" class="md-radiobtn"  @if(isset($variables['site_activetsregister']) && $variables['site_activetsregister'] == 'no') checked @endif>
                                    <label for="site_activetsregister2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> ايميل </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1"> التحكم بنظام تفعيل العضوية</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio has-success">
                                    <input type="radio" id="site_activetsregister" name="data[site_activetsregister]" value="yes" class="md-radiobtn" @if(isset($variables['site_activetsregister']) && $variables['site_activetsregister'] == 'yes') checked @endif>
                                    <label for="site_activetsregister">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> رساله نصيه  </label>
                                </div>
                                <div class="md-radio has-error">
                                    <input type="radio" id="site_activetsregister2" name="data[site_activetsregister]" value="no" class="md-radiobtn"  @if(isset($variables['site_activetsregister']) && $variables['site_activetsregister'] == 'no') checked @endif>
                                    <label for="site_activetsregister2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> ايميل </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_title">{{ __('admin.settings_site_title') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_title" name="data[site_title]" @if(isset($variables['site_title'])) value="{{ $variables['site_title'] }}" @endif placeholder="{{ __('admin.settings_site_title') }}" required="true"->
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_title_en">{{ __('admin.settings_site_title_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_title_en" name="data[site_title_en]" @if(isset($variables['site_title_en'])) value="{{ $variables['site_title_en'] }}" @endif placeholder="{{ __('admin.settings_site_title_en') }}" required="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_url">{{ __('admin.settings_site_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_url" name="data[site_url]" @if(isset($variables['site_url']))  value="{{ $variables['site_url'] }}" @endif  placeholder="{{ __('admin.settings_site_url') }}" required="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_path">{{ __('admin.settings_site_path') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_path" name="data[site_path]" @if(isset($variables['site_path']))  value="{{ $variables['site_path'] }}" @endif  placeholder="{{ __('admin.settings_site_path') }}" required="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
					<div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="sitetax">عموله الموقع بدون الضريبه</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="sitetax" name="data[sitetax]" @if(isset($variables['sitetax']))  value="{{ $variables['sitetax'] }}" @endif  placeholder="عموله الموقع" required="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_meta">{{ __('admin.settings_site_meta') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_meta" class="form-control input-large" data-role="tagsinput" name="data[site_meta]" @if(isset($variables['site_meta']))  value="{{ $variables['site_meta'] }}" @endif  placeholder="{{ __('admin.settings_site_meta') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_kayword">{{ __('admin.settings_site_keyword') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_kayword" name="data[site_kayword]" @if(isset($variables['site_kayword']))  value="{{ $variables['site_kayword'] }}" @endif  placeholder="{{ __('admin.settings_site_keyword') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_email">{{ __('admin.settings_site_email') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_email" name="data[site_email]" @if(isset($variables['site_email']))  value="{{ $variables['site_email'] }}" @endif  placeholder="{{ __('admin.settings_site_email') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_mobile">{{ __('admin.settings_site_mobile') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_mobile" name="data[site_mobile]" @if(isset($variables['site_mobile']))  value="{{ $variables['site_mobile'] }}" @endif  placeholder="{{ __('admin.settings_site_mobile') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_phone">{{ __('admin.settings_site_phone') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_phone" name="data[site_phone]" @if(isset($variables['site_phone']))  value="{{ $variables['site_phone'] }}" @endif  placeholder="{{ __('admin.settings_site_phone') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="facebook_url">{{ __('admin.settings_facebook_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="facebook_url" name="data[facebook_url]" @if(isset($variables['facebook_url']))  value="{{ $variables['facebook_url'] }}" @endif  placeholder="{{ __('admin.settings_facebook_url') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="twitter_url">{{ __('admin.settings_twitter_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="twitter_url" name="data[twitter_url]" @if(isset($variables['twitter_url']))  value="{{ $variables['twitter_url'] }}" @endif  placeholder="{{ __('admin.settings_twitter_url') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="google_plus">{{ __('admin.settings_gplus_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="google_plus" name="data[google_plus]" @if(isset($variables['google_plus']))  value="{{ $variables['google_plus'] }}" @endif  placeholder="{{ __('admin.settings_gplus_url') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="instagram">{{ __('admin.settings_instgram_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="instagram" name="data[instagram]" @if(isset($variables['instagram']))  value="{{ $variables['instagram'] }}" @endif  placeholder="{{ __('admin.settings_instgram_url') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_skype">{{ __('admin.settings_skype_url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_skype" name="data[site_skype]" @if(isset($variables['site_skype']))  value="{{ $variables['site_skype'] }}" @endif  placeholder="{{ __('admin.settings_skype_url') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!-----zezo----------------------------->
                    <!---------------whats up-------------->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_whatup">{{ __('admin.settings_site_whatup') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_whatup" name="data[site_whatup]" @if(isset($variables['site_whatup']))  value="{{ $variables['site_whatup'] }}" @endif  placeholder="{{ __('admin.settings_site_whatup') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!------------about us------------->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_aboutus">{{ __('admin.settings_site_aboutus') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" id="site_aboutus" name="data[site_aboutus]"   placeholder="{{ __('admin.settings_site_aboutus') }}" required="true">@if(isset($variables['site_aboutus']))  {{ $variables['site_aboutus'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_aboutus">{{ __('admin.settings_site_aboutus_en') }}</label>
                        <div class="col-md-10">
                            <textarea required="true" type="text" class="form-control" row="7" id="site_aboutus_en" name="data[site_aboutus_en]"   placeholder="{{ __('admin.settings_site_aboutus_en') }}">@if(isset($variables['site_aboutus_en']))  {{ $variables['site_aboutus_en'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!---fax ------------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_fax">{{ __('admin.settings_site_fax') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_fax" name="data[site_fax]" @if(isset($variables['site_fax']))  value="{{ $variables['site_fax'] }}" @endif  placeholder="{{ __('admin.settings_site_fax') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!-----site_addresse------------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_addresse">{{ __('admin.settings_site_addresse') }}</label>
                        <div class="col-md-10">
                            <input type="text"  class="form-control" id="site_addresse" name="data[site_addresse]" @if(isset($variables['site_addresse']))  value="{{ $variables['site_addresse'] }}" @endif  placeholder="{{ __('admin.settings_site_addresse') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_addresse_en">{{ __('admin.site_addresse_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_addresse_en" name="data[site_addresse_en]" @if(isset($variables['site_addresse_en']))  value="{{ $variables['site_addresse_en'] }}" @endif  placeholder="{{ __('admin.site_addresse_en') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!-----youtube------------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="site_youtube">{{ __('admin.settings_site_youtube') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="site_youtube" name="data[site_youtube]" @if(isset($variables['site_youtube']))  value="{{ $variables['site_youtube'] }}" @endif  placeholder="{{ __('admin.settings_site_youtube') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!---dashboard welcome message ------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="dashbaord_welcome_message_ar">{{ __('admin.dashbaord_welcome_message_ar') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="dashbaord_welcome_message_ar" name="data[dashbaord_welcome_message_ar]"   placeholder="{{ __('admin.dashbaord_welcome_message_ar') }}">@if(isset($variables['dashbaord_welcome_message_ar']))  {{ $variables['dashbaord_welcome_message_ar'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="dashbaord_welcome_message_en">{{ __('admin.settings_site_aboutus_en') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="dashbaord_welcome_message_en" name="data[dashbaord_welcome_message_en]"   placeholder="{{ __('admin.dashbaord_welcome_message_en') }}">@if(isset($variables['dashbaord_welcome_message_en']))  {{ $variables['dashbaord_welcome_message_en'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!----end------------->
                    <!---checkout message ------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="checkout_message_ar">{{ __('admin.checkout_message_ar') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="checkout_message_ar" name="data[checkout_message_ar]"   placeholder="{{ __('admin.checkout_message_ar') }}">@if(isset($variables['checkout_message_ar']))  {{ $variables['checkout_message_ar'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="checkout_message_en">{{ __('admin.checkout_message_en') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="checkout_message_en" name="data[checkout_message_en]"   placeholder="{{ __('admin.checkout_message_en') }}">@if(isset($variables['checkout_message_en']))  {{ $variables['checkout_message_en'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!---{{ __('site.refound_systemes') }} ------>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="checkout_message_ar">{{ __('admin.refound_systemes_ar') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="refound_systemes_ar" name="data[refound_systemes_ar]"   placeholder="{{ __('admin.refound_systemes_ar') }}">@if(isset($variables['refound_systemes_ar']))  {{ $variables['refound_systemes_ar'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="checkout_message_en">{{ __('admin.checkout_message_en') }}</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" row="7" id="refound_systemes_en" name="data[refound_systemes_en]"   placeholder="{{ __('admin.refound_systemes_en') }}">@if(isset($variables['refound_systemes_en']))  {{ $variables['refound_systemes_en'] }} @endif</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!----end------------->
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>
                            <button type="submit" class="btn blue">{{ __('admin.edit_title') }}</button>
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
    <script src="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ ASSETS }}/pages/scripts/components-bootstrap-tagsinput.min.js" type="text/javascript"></script>
@endsection
@section('page_scripts')

    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>


@endsection
@section('page_styles')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection