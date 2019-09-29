@extends('layouts.cp')
@section('page_title')
  {{ __('site.edit_order') }} {{ $order->id }}
@stop

@section('content')
    <div class="col-lg-9 content-copouns">
        <div class="">
            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger  ">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endforeach
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert  alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
                <form method="post" action="{{ url('/update-dealer-order') }}/{{$order->id}}" >
                    <input type="hidden" name="order_id" value="{{$order->id}}" >
                    <div class="left-form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-label" for="order_date">{{ __('admin.order_date') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="order_date" name="order_date"  value="{{ $order->created_at->diffforhumans() }} " readonly="true">
                            </div>
                        </div>
                        <!---order user owner --------------->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 control-label" for="order_owner">{{ __('admin.order_user') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="order_owner" name="username"  value="{{ $order->user->name }}" readonly="true">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                        <!--order number ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="order_number">{{ __('admin.order_number') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="order_number" name="order_number"  value="{{ $order->id }}" readonly="true">

                            </div>
                        </div>
                        <!--order total ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 control-label" for="order_total">{{ __('admin.order_total') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="order_total" name="order_total"  value="{{ $order->total }}" readonly="true">

                            </div>
                        </div>
                        <!--tax_added ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="tax_total">{{ __('admin.tax_total') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="tax_total" name="tax_total"  value="{{ $order->tax }}" readonly="true">

                            </div>
                        </div>
                       <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="sitetax">نسبه عموله الموقع</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="sitetax" name="sitetax"  value=" @if(isset($settings['sitetax']))  {{ $settings['sitetax'] }} @endif %" readonly="true">

                            </div>
                        </div>      
				  <!--percentage ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="tax_rate">{{ __('admin.tax_rate') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="text" class="form-control" id="tax_rate" name="tax_rate"  value="{{ $order->tax_percentage }}%" readonly="true">

                            </div>
                        </div>  <!--delivery addresse ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="addresse_id" >{{ __('admin.delivery_addresse') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <select name="addresse_id"  readonly="true" disabled="true"  class="form-control" @if($order->order_status != 'in_progress')  readonly="true" disabled="true" @endif>
                                    @foreach($order->user->users_addresses as $addresse)
                                        <option value="{{ $addresse->id }}" @if($addresse->id == $order->addresse_id) selected="true" @endif   >@if(Lang::locale() == 'ar') @if(!empty($addresse->countrie->name_ar)) {{ $addresse->countrie->name_ar }} @endif - @if(!empty($addresse->citie->name_ar)) {{ $addresse->citie->name_ar }} @endif - @if(!empty($addresse->region->name_ar)) {{ $addresse->region->name_ar }} @endif  @else  @if(!empty($addresse->countrie->name_en)) {{ $addresse->countrie->name_en }} @endif - @if(!empty($addresse->citie->name_en)) {{ $addresse->citie->name_en }} @endif - @if(!empty($addresse->region->name_en))  {{ $addresse->region->name_en }} @endif  @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!--pay status ---->
                        <div class="form-group row">
                            <label class="col-sm-2 col-md-4 col-form-labell" for="pay_status">{{ __('admin.pay_status') }}</label>
                            <div class="col-sm-10 col-md-8">
                                <select name="pay_status" class="form-control" readonly="true" disabled="true">
                                    <option value="{{ $order->pay_status }}" @if( $order->pay_status == 'oncash') selected="true" @endif> {{ __('admin.oncash') }} </option>
                                    <option value="{{ $order->pay_status }}" @if( $order->pay_status == 'payfort') selected="true" @endif> {{ __('admin.payfort') }} </option>

                                </select>
                            </div>
                        </div>
                        <!--order status ---->
                        <div class="form-group row">
                            <label class="col-sm-4 col-md-4 col-form-labell" for="order_statuss">{{ __('admin.order_status') }}</label>
                            <div class="col-sm-10 col-md-8">
                                 <select name="order_status" class="form-control" @if($order->order_status == 'refunded' || $order->order_status == 'cancelled' ) disabled="true" readonly="true" @endif>
                                    <option value= 'in_progress' @if($order->order_status == 'in_progress') selected @endif  > {{ __('admin.in_progress') }} </option>
                                    <option value='delevried' @if($order->order_status == 'delevried') selected @endif > {{ __('admin.delevried') }}  </option>
                                    <option value='in_prepration'  @if($order->order_status == 'in_prepration') selected @endif> {{ __('admin.in_prepration') }}  </option>
                                    <option value='on_delevery'  @if($order->order_status == 'on_delevery') selected @endif> {{ __('admin.on_delevery') }}  </option>
                                    <option value='refunded'  @if($order->order_status == 'refunded') selected @endif> {{ __('admin.refunded') }}  </option>
                                    <option value='cancelled' @if($order->order_status == 'cancelled') selected @endif> {{ __('admin.cancelled') }}  </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="reset" class="btn default" @if($order->order_status == 'refunded' || $order->order_status == 'cancelled')  readonly="true" disabled="true" @endif>{{ __('admin.reset_title') }}</button>
                                    <button type="submit" class="btn blue" @if($order->order_status == 'refunded' || $order->order_status == 'cancelled')  readonly="true" disabled="true" @endif>{{ __('admin.edit_title') }}</button>
                                </div>
                            </div>
                        </div>
                    {{ csrf_field() }}
                    </div>
                </form>
				 @if($order->order_product)
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                    <thead>
                    <tr>
                        <th> {{ __('admin.product_name') }} </th>
                        <th> {{ __('site.orders_user') }} </th>
                        <th> {{ __('admin.qty') }}</th>
                        <th> {{ __('admin.price') }} </th>
                    </tr>
                    </thead>
                    <tbody>
                   
                        @foreach($order->order_product as $order_product )
					       @if(!empty($order_product->product))
                            <tr class="odd gradeX">
                                <td>@if(!empty($order_product)) {{ $order_product->product->name_ar }} @endif </td>
                                <td>
                                    @if(!empty($order_product->user)) {{ $order_product->user->name }} @endif
                                </td>
                                <td>
                                    {{ $order_product->qty }}

                                </td>
                                <td>
                                    {{ $order_product->price }}
                                </td>
                            </tr>
							@endif
                        @endforeach
                    
                    </tbody>
                </table>
                @endif 
        </div>
        </div>
         </div>
    </div>
    </div>
@stop



