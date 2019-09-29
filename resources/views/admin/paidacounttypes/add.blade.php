@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/sections') }}" >
        {{ __('admin.sections') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.sections_title_add') }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.paid_acounts_type_add') }} </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/paidacounttypes') }}"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="group_id">خاص بفئة العضوية:</label>
                                                <div class="col-md-10">
                                                	<select name="user_type" class="form-control">
                                                            <option value="0">{{ __('admin.paid_acounts_main_level') }}</option>
                                                            @foreach ($userlevels as $userlevel)
                                                               <option value="{{ $userlevel->slug }}">@if(Lang::locale() == 'ar') {{ $userlevel->name_ar }} @else {{ $userlevel->name_en }}  @endif</option>
                                                            @endforeach
                                                	</select>
                                                </div>
                                            </div>
                                            <div  id="subsection" style="display:none;">
                                                <div class="form-group form-md-line-input"  >
                                                    <label class="col-md-2 control-label" for="group_id">{{ __('admin.sections_subparent') }}</label>
                                                    <div class="col-md-10">
                                                        <select  class="form-control  "  name="sub_id" id="subsection2">
                                                            <option value="0">{{ __('admin.sections_choose_type') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">{{ __('admin.paid_acounts_type_name') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" required="required" id="name_ar" name="title"  value="{{ old('name_ar') }}" placeholder="{{ __('admin.paid_acounts_type_name') }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">قيمة الاشتراك الشهري</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" required="required" id="name_ar" name="month_value"  value="{{ old('name_ar') }}" placeholder="">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="name">قيمة الاشتراك السنوي</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" required="required" id="name_ar" name="year_value"  value="{{ old('name_ar') }}" placeholder="">
                                                    <div class="form-control-focus"> </div>
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
        <script type="text/javascript">
            $(document).ready(function(){
                $('select[name=parent_id]').change(function () {
                    var value = $(this).val() ;
                    if(value != 0){
                        $.post( "{{url('admin/sections_lists')}}", { parent_section: value })
                            .done(function( data ) {
                                if(data.length != 0){
                                    $('#subsection2').html(data);
                                    $('#subsection').show('fast') ;
                                }else{
                                    $('#subsection').hide('fast') ;
                                }
                            });
                    }else{
                        $('#subsection').hide('fast') ;
                    }
                }) ;
            });
        </script>
@endsection