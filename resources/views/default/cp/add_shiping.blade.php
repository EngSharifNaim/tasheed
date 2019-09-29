@extends('layouts.cp')
@section('page_title')
    {{ __('admin.shiping_add') }}
@stop

@section('content')

    <div class="col-lg-9">
        <!---add product form ------->
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="content-copouns portlet-body form">
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
            <form class="form-horizontal" role="form" method="post" action="{{ url('/add_shiping_data') }}"  enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row" style="margin:0 0 15px">
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
                        <div id="shiping_data">
                        </div>
                        <div class="form-actions">
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
        <!-- END SAMPLE FORM PORTLET-->
    </div>
    <!----end add product--------->
    </div>
    </div>
    </div> </div>
@stop
@section('page_plugins')
    <script src="{{ ASSETS }}/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="{{ ASSETS }}/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ ASSETS }}/pages/scripts/components-bootstrap-tagsinput.min.js" type="text/javascript"></script>
@endsection
@section('page_scribt')
    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document.body).on('change', "select[name=countrie_id]", function(e){
                var value = $(this).val() ;
               @if(count($shipings) == 0 )
               $.post( "{{url('get_shipings_cities')}}", { countrie: value })
                    .done(function( data ) {
                        // $('select[name=citie_id]').html(data);
                        $('#shiping_data').html(data);

                    });
               @else
                var user_id = parseInt("{{ Auth::user()->id }}");
              //  if(vals != 0){
                    $.post( "{{url('get_user_shiping')}}", { countrie: value  , user_id: user_id })
                        .done(function( data ) {
                            $('#shiping_data').html(data);
                        });
                @endif
             //   }
            }) ;
        });
        $(document).ready(function(){
            var vals = $("select[name=countrie_id] :selected").val();
            var user_id = parseInt("{{ Auth::user()->id }}");
            if(vals != 0){
                $.post( "{{url('get_user_shiping')}}", { countrie: vals  , user_id: user_id })
                    .done(function( data ) {
                        $('#shiping_data').html(data);
                    });
            }
        });
        //
    </script>
@endsection
@section('header_style')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection




