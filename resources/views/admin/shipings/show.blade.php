@extends(ad.'.layouts.app')

@section('head_title')
    <a href="{{ URL::to(ADMIN.'/regions') }}" >
        {{ __('admin.region') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.region_show') }} <i class="fa fa-angle-right"></i> {{ $region->name_ar }} / {{ $region->name_en }}
@stop

@section('content')
    <div class="portlet light ">


        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.region_show') }}  <i class="fa fa-angle-right"></i> {{ $region->name_ar }} / {{ $region->name_en }}</span>
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
                <form class="form-horizontal" role="form" method="post" >
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ __('admin.seller') }}  :</label>
                            <div class="col-md-10">
                                <select name="seller_id" class="form-control input-inline input-medium">
                                    <option value="0">{{ __('admin.seller') }}</option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}"> {{ $seller->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ __('admin.city_belong') }}  :</label>
                            <div class="col-md-10">
                                <select name="countrie_id" class="form-control input-inline input-medium">
                                    <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                                    @foreach ($countries as $countrie)
                                        <option value="{{ $countrie->id }}">@if(Lang::locale() =='ar') {{ $countrie->name_ar }} @else {{ $countrie->name_en }} @endif </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ __('admin.max_weight_for_shiping_coast') }} :</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control input-inline input-medium" name="h_w_for_shiping_coast" value="{{ old('h_w_for_shiping_coast') }}" placeholder="{{ __('admin.max_weight_for_shiping_coast') }}"  required = "true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ __('admin.coast_per_k') }} :</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control input-inline input-medium" name="coast_per_k_after_h_w" value="{{ old('coast_per_k_after_h_w') }}" placeholder="{{ __('admin.coast_per_k') }}"  required = "true">
                            </div>
                        </div>
                        <div class="row" id="shiping_data">

                        </div>


                    </div>
                    {{ csrf_field() }}
                </form>

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