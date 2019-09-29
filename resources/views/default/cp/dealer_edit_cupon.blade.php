@extends('layouts.cp')
@section('page_title')
    {{ __('site.add_cupons') }}
@stop

@section('content')
    <div class="col-lg-9 content-copouns">
        <div class="">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-body">
                    @if (count($errors))
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endforeach
                    @endif
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert    alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                    <form  role="form" method="post" action="{{ url('/edit-cupon') }}/{{ $cupon->id }}" >
                        <div class="left-form">
                            <!----min price ------------------->
                            	<!---discount_percentage------------>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" for="discount_percentage">{{ __('admin.discount_percentage') }}</label>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" required id="discount_percentage" name="discount_percentage" value="{{ $cupon->discount_percentage }}"  placeholder="200">%
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>	<!---discount_percentage------------>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" for="discount_monay">{{ __('admin.discount_monay') }}</label>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" required id="discount_monay" name="discount_monay" value="{{ $cupon->discount_monay }}"  placeholder="200">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <!-----end-	<!---start date------------>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">{{ __('admin.cupon_start_date') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control" readonly name="start_date" required="true" value="{{ $cupon->start_date }}">
                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> {{ __('admin.select_date') }} </span>
                                </div>
                            </div>	<!---end date------------>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">{{ __('admin.cupon_end_date') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control" readonly name="end_date" required="true" value="{{ $cupon->end_date }}">
                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> {{ __('admin.select_date') }} </span>
                                </div>
                            </div>
                            <!----choose cupon for product only------------->
                            <div class="form-group row">
                                <label class="col-md-3 control-label">{{ __('admin.choose_product_cupon') }}  :</label>
                                <div class="col-md-6">
                                    <select name="product_id" class="form-control input-inline input-medium">
                                        <option value="0">{{ __('admin.choose_product') }}</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if($product->id == $cupon->product_id ) selected="true" @endif>@if(Lang::locale() == 'ar') {{ $product->name_ar }} @else {{ $product->name_en }} @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                            
                            <!---end -------->
                            <div class="form-group row">
                                <label class="col-md-2 control-label" for="active">{{ __('admin.active_status') }} : </label>
                                <div class="col-md-10">
                                    <div class="radio-list">
                                        @if ($cupon->active == 'yes')
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
                            <div class="form-group row">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>
                                        <button type="submit" class="btn blue">{{ __('admin.add_title') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
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
@section('header_style')
    <link href="{{ ASSETS }}/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    @endsection
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
    <script src="{{ ASSETS }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ ASSETS }}/pages/scripts/form-validation.min.js" type="text/javascript"></script>

@stop
@section('page_scribt')
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name=countrie_id]').change(function () {
                var value = $(this).val() ;
                $.post( "{{url('/cities_list')}}", { countrie: value })
                    .done(function( data ) {
                        $('select[name=citie_id]').html(data);
                    });
            }) ;
            $('select[name=citie_id]').change(function () {
                var city = $("select[name=citie_id] :selected").val();
                if(city != 0){
                    $.post( "{{url('/regions_list')}}", { citie: city })
                        .done(function( data ) {
                            $('select[name=region_id]').html(data);
                        });
                }
            }) ;
        });
        //
    </script>


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



