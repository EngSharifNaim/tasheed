
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> <a target="_blank" href="#" ><img src="{{ ASSETS }}/layouts/layout2/img/logo-default.png" style="width:100px;height:50px;"></a>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
          
            <!--[if lt IE 9]>
<script src="{{ ASSETS }}/global/plugins/respond.min.js"></script>
<script src="{{ ASSETS }}/global/plugins/excanvas.min.js"></script> 
<script src="{{ ASSETS }}/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="{{ ASSETS }}/global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
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
            <script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
            @yield('page_scripts')
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{ ASSETS }}/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="{{ ASSETS }}/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
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
    </body>

</html>