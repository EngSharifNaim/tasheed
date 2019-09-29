@extends('layouts.cp')
@section('page_title')
    {{ __('site.dashborad') }}
@stop
@section('content')
        <div class="col-lg-9 content-copouns">
            <div class="">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        @if(Auth::user()->sitepercetage > 0)
                                        <a href="{{ URL::to('/add-product') }}" class="add-to-cart btn btn-default "> {{ __('admin.products_add') }}
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        @else
                                            <a href="{{ URL::to('/edit-profile') }}" class="add-to-cart btn btn-default "> {{ __('site.add_sitepercentage') }}
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <form action="{{ URL::to('/products_mass_delete') }}" method='POST'>
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
                                 {{--   <th style="width: 20px;">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>--}}
                                    <th> {{ __('admin.products_name') }}</th>
                                    <th> {{ __('admin.products_image') }} </th>
                                    <th> {{ __('admin.products_price') }} </th>
                                    <th> {{  __('admin.options_title') }} </th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($products)
                                    @foreach($products as $product)
                                        <tr class="odd gradeX">
                                           {{-- <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $product->id }}" />
                                                    <span></span>
                                                </label>
                                            </td>--}}
                                            <td>
                                                <a href="{{ url('/') }}/@if(Lang::locale() == 'ar'){{ str_replace(' ', '_', $product->name_ar) }}@else{{ str_replace(' ', '_', $product->name_ar) }} @endif/{{$product->id}}" > @if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</a>
                                            </td>

                                            <td>
                                                @if ($product->image)
                                                    <img src="{{ URL::to('public/') }}{{ $product->image }}" width="100" height="100">
                                                @endif
                                            </td>
                                            <td>{{ $product->price }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" page="menu">
                                                        
                                                        <li>
                                                            <a href="{{url('edit-product/'.$product->id.'/edit')}}">
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
{{--
                            <div class="col-md-12">

                                <button type="submit" name="delete" class="btn btn-danger" onclick='return confirm("{{ __('admin.delete_confirm') }}");'><li class="fa fa-trash-o"></li> {{ __('admin.delete_mass_title') }}</button>

                            </div>--}}
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->


            </div>
        </div>
    </div>
    </div>
@stop

@section('page_plugins')
            <!--[if lt IE 9]>

    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ ASSETS }}/global/plugins/js.cookie.min.js" type="text/javascript"></script>
     <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ ASSETS }}/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    @yield('page_plugins')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ ASSETS }}/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ ASSETS }}/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
      @stop
@section('page_scribt')
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
    <script type="text/javascript">
        var TableDatatablesManaged = function () {
            var initTable1_2 = function () {
                var table = $('#sample_1_2');
                // begin first table
                table.dataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "{{ __('admin.datatable_sEmptyTable')}}",
                        "info": "{{ __('admin.datatable_sInfo')}}",
                        "infoEmpty": "{{ __('admin.datatable_sInfoEmpty')}}",
                        "infoFiltered": "{{ __('admin.datatable_sInfoFiltered')}}",
                        "lengthMenu": "{{ __('admin.datatable_sLengthMenu')}}",
                        "search": "{{ __('admin.datatable_sSearch')}}",
                        "zeroRecords": "{{ __('admin.datatable_sZeroRecords')}}",
                        "paginate": {
                            "previous":"{{ __('admin.datatable_sPrevious')}}",
                            "next": "{{ __('admin.datatable_sNext')}}",
                            "last": "{{ __('admin.datatable_sLast')}}",
                            "first": "{{ __('admin.datatable_sFirst')}}"
                        }
                    },

                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                    // So when dropdowns used the scrollable div should be removed.
                    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],

                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "columnDefs": [
                        {  // set default column settings
                            'orderable': false,
                            'targets': [0]
                        },
                        {
                            "searchable": false,
                            "targets": [0]
                        },
                        {
                            "className": "dt-right",
                            //"targets": [2]
                        }
                    ],

                    "order": [
                        [1, "asc"]
                    ], // set first column as a default sort by asc

                    initComplete: function () {

                        // username column
                        this.api().column(1).every(function(){
                            var column = this;
                            var select = $('<select class="form-control input-sm"><option value="">Select</option></select>')
                                .appendTo( $(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );

                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        });

                    }
                });

                var tableWrapper = jQuery('#sample_1_2_wrapper');

                table.find('.group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            $(this).prop("checked", true);
                            $(this).parents('tr').addClass("active");
                        } else {
                            $(this).prop("checked", false);
                            $(this).parents('tr').removeClass("active");
                        }
                    });
                });

                table.on('change', 'tbody tr .checkboxes', function () {
                    $(this).parents('tr').toggleClass("active");
                });
            }
            return {

                //main function to initiate the module
                init: function () {
                    if (!jQuery().dataTable) {
                        return;
                    }

                    initTable1_2();

                }

            };

        }();



    </script>
@stop



