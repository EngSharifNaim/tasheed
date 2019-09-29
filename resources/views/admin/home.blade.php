@extends(ad.'.layouts.app') 

@section('page_styles')
        <link href="{{ ASSETS }}/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@section('head_title')

{{ __('admin.dashboard') }}



@stop
                  
                 
<!-----last product---------->
                     <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">{{ __('admin.last_product_register') }}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a href="{{ URL::to(ADMIN.'/products/create') }}" class="btn sbold green"> {{ __('admin.products_add') }}
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ URL::to(ADMIN.'/products_mass_delete') }}" method='POST'>
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
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
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                        <thead>
                                        <tr>
                                            <th>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th> {{ __('admin.products_name') }}</th>
                                            <th> {{ __('admin.products_image') }} </th>
                                            <th> {{ __('admin.products_price') }} </th>
                                            <th> {{ __('admin.products_productowner') }} </th>
                                            <th> {{  __('admin.options_title') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if($products)
                                            @foreach($products as $product)
                                                <tr class="odd gradeX">
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $product->id }}" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if(Lang::locale() == 'ar')
                                                            <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">{{ $product->name_ar }} </a>
                                                        @else
                                                            <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">{{ $product->name_en }} </a>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($product->image)
                                                            <img src="{{ URL::to('public') }}{{ $product->image }}" width="100" height="100">
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>
                                                     @if(isset($product->user))   {{ $product->user->name }} @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" page="menu">
                                                                <li>
                                                                    <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}">
                                                                        <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">
                                                                        <i class="icon-note"></i> {{ __('admin.editing_title') }} </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

                                    <div class="col-md-12">

                                        <button type="submit" name="delete" class="btn btn-danger" onclick='return confirm("{{ __('admin.delete_confirm') }}");'><li class="fa fa-trash-o"></li> {{ __('admin.delete_mass_title') }}</button>

                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->


                    </div>
                </div>
                 <!----end last products----->
<!---last order ----------------->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">{{ __('admin.last_orders_today') }}</span>
                </div>
            </div>
            <div class="portlet-body">
            </div>
            <form action="{{ URL::to(ADMIN.'/orders_mass_delete') }}" method='POST'>
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
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
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                    <thead>
                    <tr>
                        <th>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
                                <span></span>
                            </label>
                        </th>
                        <th> {{ __('admin.order_date') }} </th>
                        <th> {{ __('admin.order_user') }} </th>
                        <th> {{ __('admin.order_number') }}</th>
                        <th> {{ __('admin.order_status') }} </th>
                        <th> {{ __('admin.pay_status') }} </th>
                        <th> {{ __('admin.order_total') }} </th>
                        <th> {{  __('admin.options_title') }} </th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($orders)
                        @foreach($orders as $order)
                            <tr class="odd gradeX">
                                <td>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $order->id }}" />
                                        <span></span>
                                    </label>
                                </td>
                                <td> {{ $order->created_at->diffforhumans() }} </td>
                                <td>
                                 @if(isset($order->user))    {{ $order->user->name }} @endif
                                </td>
                                <td>
                                    {{ $order->id }}

                                </td>
                                <td>
                                    {{ __('admin.'.$order->order_status.'')}}
                                </td>
                                <td>
                                    {{ __('admin.'.$order->payment_type.'')}}
                                </td>
                                <td>
                                    {{ $order->total }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" order="menu">
                                            <li>
                                                <a href="{{ URL::to(ADMIN.'/orders') }}/{{ $order->id }}">
                                                    <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                                            </li>
                                            <li>
                                                <a href="{{ URL::to(ADMIN.'/orders') }}/{{ $order->id }}/edit">
                                                    <i class="icon-note"></i> {{ __('admin.editing_title') }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <div class="col-md-12">

                    <button type="submit" name="delete" class="btn btn-danger" onclick='return confirm("{{ __('admin.delete_confirm') }}");'><li class="fa fa-trash-o"></li> {{ __('admin.delete_mass_title') }}</button>

                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->


</div>
<!----end last order ------------------>
      
@endsection

@section('page_scripts')
<script src="{{ ASSETS }}/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/pages/scripts/dashboard.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/highcharts/js/highcharts.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/highcharts/js/highcharts-3d.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/highcharts/js/highcharts-more.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->

            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{ ASSETS }}/pages/scripts/charts-highcharts.min.js" type="text/javascript"></script>
@endsection
