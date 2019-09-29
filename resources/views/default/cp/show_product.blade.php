@extends('layouts.cp')
@section('page_title')
    @if(Lang::locale() == 'ar')   {{ $product->name_ar }} @else {{ $product->name_en }} @endif
@stop
@section('content')
            <div class="col-lg-9 content-copouns">
                <!---add product form ------->
                <!-- BEGIN SAMPLE FORM PORTLET-->
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
                        <form class="form-horizontal" >
                            <div class="form-body">
                                <!---main level 0 ------>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="group_id">{{ __('admin.sections_parent') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" required="required" id="name_ar"   value="{{ $product->mainsection->name_ar }} / {{ $product->mainsection->name_en }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true" disabled="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!--sub level 1 --->
                                @if($product->sub_section_id > 0 )
                                    <div   >
                                        <div class="form-group form-md-line-input"  >
                                            <label class="row control-label" for="group_id">{{ __('admin.sections_subparent') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $product->subsection->name_ar }} / {{ $product->subsection->name_en }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true" disabled="true">
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            <!---sub sub level 2--->
                                @if($product->sub_sub_section_id > 0 )
                                    <div   >
                                        <div class="form-group form-md-line-input"  >
                                            <label class="row control-label" for="group_id">{{ __('admin.products_subsubsection') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $product->subsubsection->name_ar }} / {{ $product->subsubsection->name_en }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true" disabled="true">
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            <!---brand ---------->
                                @if($product->brand_id)
                                    <div  id="brands_section">
                                        <div class="form-group form-md-line-input"   >
                                            <label class="row control-label" for="group_id">{{ __('admin.products_brand') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $product->brands->name_ar }} / {{ $product->brands->name_en }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true" disabled="true">
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            <!---colors ---------->
                                
                                <!---product owner  ---------->
                                <div class="form-group form-md-line-input"  >
                                    <label class="row control-label" for="group_id">{{ __('admin.products_productowner') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $product->user->name }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true">
                                    </div>
                                </div>
                                <!---end------------>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_name_ar') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ $product->name_ar }}" placeholder="{{ __('admin.products_name_ar') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name_en">{{ __('admin.products_name_en') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" required id="name_en" name="name_en" value="{{ $product->name_en }}"  placeholder="{{ __('admin.products_name_en') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!--describtion---------->
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="description_en">{{ __('admin.products_description_ar') }}</label>
                                    <div class="col-md-10">
                                        <p  >{!! $product->description_ar !!}  </p>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="description_en">{{ __('admin.products_description_en') }}</label>
                                    <div class="col-md-10">
                                        <p  >{!! $product->description_en !!} </p>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!----price------>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_price') }}</label>
                                    <div class="col-md-10">
                                        <input type="number" required="required" class="form-control" id="price" name="price" value="{{ $product->price }}"  placeholder="{{ __('admin.products_price') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="min_price">{{ __('admin.products_price_onsale') }}</label>
                                    <div class="col-md-10">
                                        <input type="number" required="required" class="form-control" id="min_price" name="min_price" value="{{ $product->min_price }}"  placeholder="{{ __('admin.products_price_onsale') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!---quantity----->
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_quantity') }}</label>
                                    <div class="col-md-10">
                                        <input type="number" required="required" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" placeholder="{{ __('admin.products_quantity') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_minquantity') }}</label>
                                    <div class="col-md-10">
                                        <input type="number" required="required" class="form-control" id="min_quantity" name="min_quantity" value="{{ $product->min_quantity }}"  placeholder="{{ __('admin.products_minquantity') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_maxquantity') }}</label>
                                    <div class="col-md-10">
                                        <input type="number"  class="form-control" id="max_quantity" name="max_quantity" value="{{ $product->max_quantity }}" placeholder="{{ __('admin.products_maxquantity') }}" readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!---keywords----->
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_keywords_ar') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" name="keywords_ar" class="form-control input-large" value="{{ $product->keywords_ar }}" >
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_keywords_en') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" name="keywords_en" class="form-control input-large" value="{{ $product->keywords_en }}"  readonly="true">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!---images---->
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_image') }}</label>
                                    <div class="col-md-10">
                                        <div class="col-md-10">
                                            @if ($product->image)
                                                <img src="{{ URL::to('/') }}{{ $product->image }}" width="200" height="200">
                                            @endif
                                        </div>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="name">{{ __('admin.products_images') }}</label>
                                    <div class="col-md-10">
                                        <div class="col-md-10">
                                            @if ($product->images)
                                                @foreach( explode(",",$product->images ) as $image )
                                                    <img src="{{ URL::to('/') }}{{ $image }}" width="200" height="200">
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!------بلد المنشا----->
                                @if(!empty($product->manfacture_country))
                                    <div class="form-group form-md-line-input">
                                        <label class="row control-label" for="group_id">{{ __('admin.country_manfature') }}</label>
                                        <div class="col-md-6">
                                            <p>{{ $product->countries_products->name_ar }}</p>
                                        </div>
                                    </div>
                                @endif
                            <!--------->
                                <!---details ar  update ----->
                                @if($product->details_ar !=  0 )
                                    <div class="form-group">
                                        <label class="row control-label"> {{__('admin.product_options')}} :</label>
                                        <div class="col-md-10">
                                            <div id="details_ar_list" >
                                                @foreach(explode(",",$product->details_ar ) as $key=>$detail_ar )
                                                    <div class="parent">
                                                        <input type="text" class="form-control input-inline input-medium" name="details_ar[]" placeholder="{{ __('admin.product_option') }}" value="{{ $detail_ar }}"  readonly="true">
                                                        <br/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            <!----end details ar   ------>
                                <!---details en  update ----->
                                @if($product->details_en != "" )
                                    <div class="form-group">
                                        <label class="row control-label"> {{__('admin.product_options')}} :</label>
                                        <div class="col-md-10">
                                            <div id="details_en_list">

                                                @foreach(explode(",",$product->details_en ) as $key=>$detail_en )
                                                    <div class="parent">
                                                        </br>
                                                        <input class="form-control input-inline input-medium"  value="{{ $detail_en }}" readonly="true">
                                                        <br/>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!----end details en   ------>
                                <!---make product feature---->
                              
                                <!----status-------->
                                <div class="form-group form-md-line-input">
                                    <label class="row control-label" for="active">{{ __('admin.active_status') }} : </label>
                                    <div class="col-md-10">
                                        <div class="radio-list">
                                            @if ( $product->active == 'yes')
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios26" value='yes' checked="true" disabled="true"> {{ __('admin.active') }}</label>
                                            @else
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios27" value='no' checked="true" disabled="true"> {{ __('admin.inactive') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!---form actions--->
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>
                                            <button type="submit" class="btn blue">{{ __('admin.add_title') }}</button>
                                        </div>
                                    </div>
                                </div>
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                        </form></div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
            <!----end add product--------->
        </div>
    </div>
    </div>
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
@section('page_script')
    <script src="{{ ASSETS }}/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        /*
        if (document.readyState === "complete") {
            alert(1) ;
        }*/
        $(document.body).on('click', "button[name=delete_details_en_items]", function(e){
            var ids = $(this).attr('id');
            $(this).parent('.parent').remove();
        }) ;
        $(document.body).on('click', "button[name=delete_details_ar_items]", function(e){
            var ids = $(this).attr('id');
            $(this).parent('.parent').remove();
        }) ;

        $(document).ready(function(){
            //details ar
            $("button[name=add_details_ar]").click(function(){

                $("div#details_ar_list").append('<div class="parent"><input type="text" class="form-control input-inline input-medium" name="details_ar[]" placeholder="{{ __("admin.product_option") }}" required><button name="delete_details_ar_items" id="" class="btn btn-green" type="button"> {{ __("admin.delete_title") }} </button></br></br></div>');

            });
            //details en
            $("button[name=add_details_en]").click(function(){
                $("div#details_en_list").append('<div class="parent"><input type="text" class="form-control input-inline input-medium" name="details_en[]" placeholder="{{ __("admin.product_option") }}" required><button name="delete_details_en_items" id="" class="btn btn-green" type="button"> {{ __("admin.delete_title") }} </button></br></br></div>');

            });

            //
            var value = "{{ $product->section_id }}";
            var value_sub_section = "{{ $product->sub_section_id }}";
            var value_sub_sub_section = "{{ $product->sub_sub_section_id }}";
            var brand_id = "{{ $product->brand_id }}" ;
            //loading sub section when load page
            $.post( "{{url('admin/sections_lists')}}", { parent_section : value , current : value_sub_section   })
                .done(function( data ) {
                    if(data.length != 0 && value != 0){
                        $('#subsection').show('fast');
                        $('#subsection2').html(data);
                        $.get("{{url('brands_list')}}", {section: value , brand : brand_id })
                            .done(function (data) {
                                if (data.length != 0) {
                                    $('#brands').html(data);
                                    $('#brands_section').show('fast');
                                }
                            });
                    }
                });
            //end loading sub section and start loading sub sub section
            $.post( "{{url('sections_lists')}}", {  parent_section: value , subsection : value_sub_section , current : value_sub_sub_section } )
                .done(function( data ) {
                    if (data.length != 0 && value_sub_section != 0 && value != 0) {
                        $('#subsubsection2').html(data);
                        $('#subsubsection').show('fast');
                    }
                });
            //end loading sub sub section
            //loading brands when load page
                    @if($product->brand_id != null  || $product->brand_id > 0  )
            var brand_id = "{{ $product->brand_id }}";

            $.get("{{url('brands_list')}}", {section: value , brand : brand_id })
                .done(function (data) {
                    if (data.length != 0) {
                        $('#brands').html(data);
                        $('#brands_section').show('fast');
                        // var element = document.getElementById('brands');
                        // element.value = brand_id ;
                    } else if (value_sub_section > 0) {
                        $.get("{{url('brands_list')}}", {section: value_sub_section})
                            .done(function (data) {
                                if (data.length != 0) {
                                    $('#brands').html(data);
                                    $('#brands_section').show('fast');
                                    var element = document.getElementById('brands');
                                    element.value = brand_id ;
                                } else {
                                    $.get("{{url('brands_list')}}", {section: value_sub_sub_section , brand : brand_id})
                                        .done(function (data) {
                                            if (data.length != 0) {
                                                $('#brands').html(data);
                                                $('#brands_section').show('fast');
                                            }
                                        });
                                }
                            });
                    }
                });

            @endif

            //end loading brands
            //end main
            //start loading second level section sub section
            $('select[name=parent_id]').change(function () {
                var value = $(this).val() ;
                //load brands for main section
                if(value != 0) {
                    $.get("{{url('brands_list')}}", {section: value})
                        .done(function (data) {
                            if (data.length != 0) {
                                $('#brands').html(data);
                                $('#brands_section').show('fast');
                            }
                        });
                }else{
                    var element = document.getElementById('subsection2');
                    element.value = 0;
                    var element = document.getElementById('subsubsection2');
                    element.value = 0;
                    var element = document.getElementById('brands');
                    element.value = 0;
                }
                //end loading brands
                $.post( "{{url('sections_lists')}}", { parent_section: value })
                    .done(function( data ) {
                        if(data.length != 0 && value != 0){
                            $('#subsection').show('fast') ;
                            $('#subsection2').html(data);
                        }else{
                            $('#subsection').hide('fast') ;
                            $('#brands_section').hide('fast') ;
                            $('#subsubsection').hide('fast') ;
                            var element = document.getElementById('subsection2');
                            element.value = 0;
                            var element = document.getElementById('subsubsection2');
                            element.value = 0;
                            var element = document.getElementById('brand_id');
                            element.value = 0;
                        }
                    });
                //start loading third level  sub sub section
                $('select[name=sub_id]').change(function(){
                    var parent = $('select[name=parent_id]').val() ;  //get main section id
                    var subsectionid = $('select[name=sub_id]').val() ; //get sub section id
                    if(subsectionid == 0  ){  // check if subsection his value 0 mean no data  hide third level and assign default value 0
                        $('#subsubsection').hide('fast') ;
                        $('#brands_section').hide('fast') ;
                        var element = document.getElementById('subsubsection2');
                        element.value = 0;
                    }else{
                        $.get("{{url('brands_list')}}", {section: subsectionid})
                            .done(function (data) {
                                if (data.length != 0) {
                                    $('#brands').html(data);
                                    $('#brands_section').show('fast');
                                }
                            });
                    }//end this part mean if sub value 0 then  assign 0 to sub sub and hide it
                    $.post( "{{url('sections_lists')}}", {  parent_section: parent , subsection : subsectionid } )
                        .done(function( data ) {
                            if(data.length != 0 && subsectionid != 0 && parent != 0 ){
                                $('#subsubsection2').html(data);
                                $('#subsubsection').show('fast') ;
                            }else{
                                var element = document.getElementById('subsubsection2');
                                element.value = 0;
                                $('#subsubsection').hide('fast') ;
                            }
                        });
                })  //end  loading third level section

                //third level
                $('select[name=sub_sub_id]').change(function(){
                    var sub_sub_section = $('select[name=sub_sub_id]').val() ; //get sub section id
                    //alert(sub_sub_section) ;
                    if(sub_sub_section != 0  ){
                        $.get("{{url('brands_list')}}", {section: sub_sub_section })
                            .done(function (data) {
                                if (data.length != 0) {
                                    $('#brands').html(data);
                                    $('#brands_section').show('fast');
                                }
                            });
                    }
                })
            }) ;

        });
    </script>

@endsection
@section('header_style')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection




