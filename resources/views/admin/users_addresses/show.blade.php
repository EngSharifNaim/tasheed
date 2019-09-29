@extends(ad.'.layouts.app')

@section('head_title')

    {{ __('admin.update_user_addresse') }} <i class="fa fa-angle-right"></i>  <a href="{{ URL::to(ADMIN.'/users') }}/{{ $users_addresse->user_id }}/edit">{{ $users_addresse->user->name }} </a>
@stop

@section('content')
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.users_edite_title') }} </span>
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
            <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">
                <div class="form-body">
                    <!------------------------------------------------>
                    <div class="form-group ">
                        <label class="col-md-2 control-label">{{ __('site.addresse_arabic_lang') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="name_ar" class="form-control form-control-" id="colFormLabel" placeholder="{{ __('site.addresse_arabic_lang') }}" value="{{ $users_addresse->addresse_ar }}" required="true" readonly="true">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2 control-label">{{ __('site.addresse_english_lang') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="name_en"  class="form-control form-control" id="colFormLabel" placeholder="{{ __('site.addresse_english_lang') }}" value="{{ $users_addresse->addresse_en }}" required="true" readonly="true">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="colFormLabel" name="name_en" class="col-md-2 control-label">{{ __('admin.city_belong') }}
                        </label>
                        <div class="col-md-10">
                            <select name="countrie_id" class="form-control " required="true" readonly="true" disabled="true">
                                <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                                @foreach ($countireslist as $countrie)
                                    <option value="{{ $countrie->id }}" @if($users_addresse->countrie_id == $countrie->id ) selected="true" @endif>@if(Lang::locale() == 'ar') {{ $countrie->name_ar }} @else {{ $countrie->name_en }} @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2 control-label">{{ __('admin.belongcity') }}</label>
                        <div class="col-md-10">
                            <select name="citie_id" class="form-control " required="true" disabled="true">
                                <option value="{{ $users_addresse->citie->id }}">@if(Lang::locale() == 'ar')  {{ $users_addresse->citie->name_ar }} @else {{ $users_addresse->citie->name_en }}  @endif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2 control-label">{{ __('site.region_id') }}</label>
                        <div class="col-md-10">
                            <select name="region_id" class="form-control " required="true" disabled="true">
                                <option value="{{ $users_addresse->region->id }}">@if(Lang::locale() == 'ar')  {{ $users_addresse->region->name_ar }} @else {{ $users_addresse->region->name_en }}  @endif</option>
                            </select>
                        </div>
                    </div>
                    <!------------------------------------------------>

                </div>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            </form>

            <div class="clearfix"></div>
        </div>
    </div>

@stop
@section('page_plugins')
    <script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
@endsection
@section('page_scripts')
    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>

@stop