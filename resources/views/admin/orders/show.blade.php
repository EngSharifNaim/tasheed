@extends(ad.'.layouts.app')
@section('head_title')
    <a href="{{ URL::to(ADMIN.'/orders') }}" >
        {{ __('admin.orders') }}  </a> <i class="fa fa-angle-right"></i>
    {{ __('admin.order_view') }}
@stop
@section('content')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase"> {{ __('admin.order_view') }} <i class="fa fa-angle-right"></i> {{ $order->id }} / {{ $order->user->name }} </span>
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
            <form class="form-horizontal" role="form"    enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="order_date">{{ __('admin.order_date') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="order_date" name="order_date"  value="{{ $order->created_at->diffforhumans() }} " readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!---order user owner --------------->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="order_owner">{{ __('admin.order_user') }}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                            <input type="text" class="form-control" id="order_owner" name="username"  value="{{ $order->user->name }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!--order number ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="order_number">{{ __('admin.order_number') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="order_number" name="order_number"  value="{{ $order->id }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!--order total ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="order_total">{{ __('admin.order_total') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="order_total" name="order_total"  value="{{ $order->total }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <!--tax_added ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="tax_total">{{ __('admin.tax_total') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="tax_total" name="tax_total"  value="{{ $order->tax }}" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>    <!--percentage ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="tax_rate">{{ __('admin.tax_rate') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="tax_rate" name="tax_rate"  value="{{ $order->tax_percentage }}%" readonly="true">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>  <!--delivery addresse ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="addresse_id">{{ __('admin.delivery_addresse') }}</label>
                        <div class="col-md-10">
                            <select name="addresse_id" class="form-control" readonly="true" disabled="true">
                                @foreach($order->user->users_addresse as $addresse)
                                    <option value="{{ $addresse->id }}" @if($addresse->id == $order->addresse_id) selected="true" @endif>@if(Lang::locale() == 'ar') {{ $addresse->countrie->name_ar }} - {{ $addresse->citie->name_ar }}- {{ $addresse->region->name_ar }}- {{ $addresse->region->addresse_ar }} @else {{ $addresse->countrie->name_en }} - {{ $addresse->citie->name_en }}- {{ $addresse->region->name_en }}- {{ $addresse->region->addresse_en }} @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div> <!--pay status ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="pay_status">{{ __('admin.pay_status') }}</label>
                        <div class="col-md-10">
                            <select name="pay_status" class="form-control" readonly="true" disabled="true">
                                <option value="{{ $order->pay_status }}" @if( $order->pay_status == 'oncash') selected="true" @endif> {{ __('admin.oncash') }} </option>
                                <option value="{{ $order->pay_status }}" @if( $order->pay_status == 'payfort') selected="true" @endif> {{ __('admin.payfort') }} </option>

                            </select>
                        </div>
                    </div>
                    <!--order status ---->
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="order_status">{{ __('admin.order_status') }}</label>
                        <div class="col-md-10">
                            <select name="order_status" class="form-control" readonly="true" disabled="true">
                                <option value= 'in_progress' @if($order->order_status == 'in_progress') selected @endif  > {{ __('admin.in_progress') }} </option>
                                <option value='delevried' @if($order->order_status == 'delevried') selected @endif > {{ __('admin.delevried') }}  </option>
                                <option value='in_prepration'  @if($order->order_status == 'in_prepration') selected @endif> {{ __('admin.in_prepration') }}  </option>
                                <option value='on_delevery'  @if($order->order_status == 'on_delevery') selected @endif> {{ __('admin.on_delevery') }}  </option>
                                <option value='refunded'  @if($order->order_status == 'refunded') selected @endif> {{ __('admin.refunded') }}  </option>
                                <option value='cancelled' @if($order->order_status == 'cancelled') selected @endif> {{ __('admin.cancelled') }}  </option>
                            </select>
                        </div>
                    </div>

            </form>
            <center>{{ __('admin.required_products') }}</center>
            <hr>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                <thead>
                <tr>
                    <th> {{ __('admin.product_name') }} </th>
                    <th> {{ __('admin.product_owner') }} </th>
                    <th> {{ __('admin.qty') }}</th>
                    <th> {{ __('admin.price') }} </th>
                </tr>
                </thead>
                <tbody>

                @if($order->order_product)
                    @foreach($order->order_product as $order_product )
                        <tr class="odd gradeX">
                            <td> {{ $order_product->product->name_ar }} </td>
                            <td>
                                {{ $order_product->product->user->name }}
                            </td>
                            <td>
                                {{ $order_product->qty }}

                            </td>
                            <td>
                                {{ $order_product->price }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>


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