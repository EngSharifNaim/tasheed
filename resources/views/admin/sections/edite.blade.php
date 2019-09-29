@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/sections') }}" >
        {{ __('admin.sections') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.sections_title_edite') }}
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.sections_title_edite') }} <i class="fa fa-angle-right"></i> @if(Lang::locale() == 'ar') {{ $section->name_ar }} @else  {{ $section->name_en }} @endif</span>
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
            <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/sections') }}/{{ $section->id }}"  enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="group_id">{{ __('admin.sections_parent') }}</label>
                        <div class="col-md-10">
                            <select name="parent_id" class="form-control" id="parent">
                                <option value="0">{{ __('admin.sections_main_sections') }}</option>
                                @foreach ($sections as $sec)
                                    <option value="{{ $sec->id }}" @if($section->parent_id === $sec->id ) selected="true" @endif >@if(Lang::locale() == 'ar') {{ $sec->name_ar }} @else {{ $sec->name_en }}  @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div  id="subsection" style="display: none ; ">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="group_id">{{ __('admin.sections_subparent') }}</label>
                            <div class="col-md-10">
                                <select  class="form-control  "  name="sub_id" id="subsection2">
                                    <option value="0"  >{{ __('admin.sections_choose_type') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.sections_name') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name_ar" name="name_ar"  placeholder="{{ __('admin.sections_name') }}" value="{{ $section->name_ar }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name_en">{{ __('admin.sections_name_en') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name_en" name="name_en"  placeholder="{{ __('admin.sections_name') }}" value="{{ $section->name_en }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_ar">{{ __('admin.sections_content') }}</label>
                        <div class="col-md-10" style="text-align:right">
                            <textarea class="ckeditor form-control cke_contents_rtl " style="text-align:right" id="description_ar" name="description_ar"  placeholder="{{ __('admin.sections_content') }}">{{ $section->description_ar }}</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="description_en">{{ __('admin.sections_content_en') }}</label>
                        <div class="col-md-10" >
                            <textarea class="ckeditor form-control" id="description_en" name="description_en"  placeholder="{{ __('admin.sections_content_en') }}">{{ $section->description_en }}</textarea>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="name">{{ __('admin.sections_image') }}</label>
                        <div class="col-md-10">
                            @if ($section->photo)
                                <img src="{{ URL::to('public') }}{{ $section->photo }}" width="200" height="200">
                            @endif
                                <div class="col-md-10">
                                    <input type="file" class="form-control" id="name_ar" name="image"  placeholder="{{ __('admin.sections_image') }}" >
                                    <div class="form-control-focus"> </div>
                                </div></div>

                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="active">:{{ __('admin.active_status') }}</label>
                        <div class="col-md-10">
                            <div class="radio-list">
                                @if ( $section->active == 'yes')
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
    <script type="text/javascript">
        $(document).ready(function(){
        // ajax code when page loaded
                var value = $('select[name=parent_id]').val() ;
                $.post( "{{url('admin/sections_lists')}}", { parent_section: value , id : {{ $section->id }} })
                    .done(function( data ) {
                        if (value != 0){
                            if (data.length != 0) {
                                $('#subsection2').html(data);
                                $('#subsection').show('fast');
                                var element = document.getElementById('subsection2');
                                element.value = {{ $section->sub_section }} ;
                            } else {
                                var element = document.getElementById('subsection2');
                                element.value = 0;
                            }
                        }else{
                            $('#subsection').hide('fast');
                            var element = document.getElementById('subsection2');
                            element.value = 0;
                        }
                    });
            //ajax code when any change happen to select
            $('select[name=parent_id]').change(function () {
                var value = $(this).val() ;
                if(value != 0){
                    $.post( "{{url('admin/sections_lists')}}", { parent_section: value , id : {{ $section->id }} })
                        .done(function( data ) {
                            if(data.length != 0){
                                $('#subsection2').html(data);
                                $('#subsection').show('fast') ;    //show  subsection when main sections hav childs
                                var element = document.getElementById('subsection2');   // when undo changes return do to his normal type
                                element.value = {{ $section->sub_section }} ;
                            }else{
                                $('#subsection').hide('fast') ;  //hide subsection when parent sections doesnt have any childs
                                var element = document.getElementById('subsection2');
                                element.value = 0 ;   // and also assign subsection to be 0 because parent doesnt have any sub sectuib
                            }
                        });
                }else{
                    $('#subsection').hide('fast');
                    var element = document.getElementById('subsection2');   // assign 0 to subsection when make this section main
                    element.value = 0;
                }
            }) ;
        });
    </script>
@endsection