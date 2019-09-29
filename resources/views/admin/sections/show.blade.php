@extends(ad.'.layouts.app')
@section('head_title')

    <a href="{{ URL::to(ADMIN.'/sections') }}" >
        {{ __('admin.sections') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.sections_show') }} - @if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.sections_show') }} </span>
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
               <div class="form-body">
                    <form class="form-horizontal" role="form">
                    <div class="form-group form-md-line-input">
                       <label class="col-md-2 control-label" for="name">{{ __('admin.sections_image') }}</label>
                       <div class="col-md-10">
                           @if ($section->photo)
                               <img src="{{ URL::to('public') }}{{ $section->photo }}" width="200" height="200">
                           @endif
                       </div>

                   </div>
                    @if($section->parent_id !=0  )
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="mainsection">{{ __('admin.sections_main_sections') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="mainsection" name="mainsection" readonly="true"   value="{{ $section->parent->name_ar }} - {{ $section->parent->name_en }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    @endif
                    @if($section->sub_section != 0 )
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="mainsection">{{ __('admin.sections_subparent') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="mainsection" name="mainsection" readonly="true"   value="{{ $section->subsection->name_ar }} - {{ $section->subsection->name_en }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    @endif
                        <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.sections_name') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name_ar" name="name_ar" readonly="true"  placeholder="{{ __('admin.sections_name') }}" value="{{ $section->name_ar }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.sections_name_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name_en" name="name_en"  readonly placeholder="{{ __('admin.sections_name') }}" value="{{ $section->name_en }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_ar">{{ __('admin.sections_content') }}</label>
                        <div class="col-md-10" style="text-align:right">
                            <p>  {!! $section->description_ar !!}</p>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_en">{{ __('admin.sections_content_en') }}</label>
                        <div class="col-md-10" >
                            <p>  {!! $section->description_en !!}</p>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} :</label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" readonly="true" name="{{ $section->active }}" id="optionsRadios26" value='{{ $section->active  }}' checked> @if($section->active == 'yes') {{ __('admin.active') }} @else {{ __('admin.inactive') }} @endif </label>

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