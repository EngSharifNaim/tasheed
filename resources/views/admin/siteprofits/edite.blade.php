@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/siteprofits') }}" >
        {{ __('admin.siteprofits') }}  </a> <i class="fa fa-angle-right"></i>
{{ __('admin.siteprofitsedit') }}
@stop
@section('content')
  <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> {{ __('admin.siteprofitsedit') }} <i class="fa fa-angle-right"></i>رقم الطلب :  {{ $siteprofit->id }} / صاحب الطلب : {{ $siteprofit->user->name }} </span>
                                    </div>
                                </div>
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">  {{ __('admin.siteprofits') }}  </span>
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
                                    <form class="form-horizontal" role="form" method="post" action="{{ url(ADMIN.'/siteprofits') }}/{{ $siteprofit->id }}"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="order_date">{{ __('admin.siteprofitstime') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="order_date" name="order_date"  value="{{ $siteprofit->created_at->diffforhumans() }} " readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <!---order user owner --------------->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="siteprofitsdealername">{{ __('admin.siteprofitsdealername') }}</label>
                                                <div class="col-md-10">
                                                    <input type="hidden" name="user_id" value="{{ $siteprofit->user_id }}">
                                                    <input type="text" class="form-control" id="order_owner" name="username"  value="{{ $siteprofit->user->name }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <!--order number ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="order_number">{{ __('admin.order_number') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="order_number" name="order_number"  value="{{ $siteprofit->id }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <!--order total ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="siteprofitstotal">{{ __('admin.siteprofitstotal') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="order_total" name="order_total"  value="{{ $siteprofit->total }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <!--tax_added ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="siteprofitsiteprofit">{{ __('admin.siteprofitsiteprofit') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="siteprofitsiteprofit" name="siteprofitsiteprofit"  value="{{ $siteprofit->site_profit }}" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>    <!--percentage ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="tax_rate">{{ __('admin.siteprofitspercenatge') }}</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="tax_rate" name="siteprofitspercenatge"  value="  {{ $siteprofit->user->sitepercetage }}%" readonly="true">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>  <!--delivery addresse ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="addresse_id">{{ __('admin.siteprofitsdealeraddresse') }}</label>
                                                <div class="col-md-10">
                                                    <select name="addresse_id" class="form-control" readonly="true" disabled="true">
                                                        @foreach($siteprofit->user->users_addresses as $addresse)
                                                            <option value="{{ $addresse->id }}" @if($addresse->id == $siteprofit->user->userActiveAddresse->id) selected="true" @endif>@if(Lang::locale() == 'ar') {{ $addresse->countrie->name_ar }} - {{ $addresse->citie->name_ar }}- {{ $addresse->region->name_ar }}- {{ $addresse->region->addresse_ar }} @else {{ $addresse->countrie->name_en }} - {{ $addresse->citie->name_en }}- {{ $addresse->region->name_en }}- {{ $addresse->region->addresse_en }} @endif</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> <!--pay status ---->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="pay_status">{{ __('admin.siteprofitsstatus') }}</label>
                                                <div class="col-md-10">
                                                    <select name="pay_status" class="form-control">
                                                        <option value="0" @if( $siteprofit->status === 0 ) selected="true" @endif> {{ __('admin.siteprofitsstatuszero') }} </option>
                                                        <option value="1" @if( $siteprofit->status  === 1 ) selected="true" @endif> {{ __('admin.siteprofitsstatusone') }} </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <!--order status ---->

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

       
@endsection