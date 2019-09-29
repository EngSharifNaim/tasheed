@extends('layouts.cp')
@section('page_title')
    {{ __('site.add_product') }}
@stop

@section('content')
            <div class="col-lg-9">
                <!---add product form ------->
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="content-copouns portlet-body form">
                    @if (count($errors))
                        @foreach ($errors->all() as $error)
                            <p class=" alert  alert-danger ">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endforeach
                    @endif
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class=" alert   alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/save_product') }}"  enctype="multipart/form-data">
                        <div class="form-body">
                            <!---main level 0 ------>
                            <div class="form-group form-md-line-input">
                                <label class="editeprofile-lable" for="parent_id">{{ __('admin.sections_parent') }}</label>
                                <div class="">
                                    <select name="parent_id" class="form-control" required="true" >
                                        <option value="0">{{ __('admin.sections_choose_type') }}</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }}  @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--sub level 1 --->
                            <div  id="subsection" style="display:none;">
                                <div class="form-group form-md-line-input"  >
                                    <label class="editeprofile-lable control-label" for="sub_id">{{ __('admin.sections_subparent') }}</label>
                                    <div class="col-md-12">
                                        <select  class="form-control  "  name="sub_id" id="subsection2">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---sub sub level 2--->
                            <div  id="subsubsection" style="display:none;">
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-12 control-label" for="sub_sub_id">{{ __('admin.products_subsubsection') }}</label>
                                    <div class="col-md-12">
                                        <select  class="form-control  "  name="sub_sub_id" id="subsubsection2">

                                        </select>
                                    </div>
                                </div>
                            </div>
							<input type="hidden" name="brand_id" value="0" >
                            <!---brand ---------
                            <div  id="brands_section" style="display: none ;">
                                <div class="form-group form-md-line-input"   >
                                    <label class="row control-label" for="brand_id">{{ __('admin.products_brand') }}</label>
                                    <div class="col-md-10">
                                        <select  class="form-control  "  name="brand_id"  id="brands">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---colors ---------->                            
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_name_ar') }}</label>
                                <div class="">
                                    <input type="text" title="  لابد من ادخال اسم المنتج باللغه العربيه  ويكون اكثر من ثلاثه حروف"  pattern="^[\u0621-\u064A\s0-9]+$" class="form-control" required="required" id="name_ar" name="name_ar"  value="{{ old('name_ar') }}" placeholder="{{ __('admin.products_name_ar') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name_en">{{ __('admin.products_name_en') }}</label>
                                <div class="">
                                    <input type="text" class="form-control" id="name_en" name="name_en" pattern="^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$" title="لابد من ادخال اسم المنتج باللغه الانجليزيه ويكون اكثر من ثلاثه حروف" value="{{ old('name_en') }}"  placeholder="{{ __('admin.products_name_en') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <!--describtion---------->
{{--                            <div class="form-group form-md-line-input">--}}
{{--                                <label class="control-label" for="description_en">{{ __('admin.products_description_ar') }}</label>--}}
{{--                                <div class="">--}}
{{--                                    <textarea class="ckeditor form-control" id="description_ar" name="description_ar"  placeholder="{{ __('admin.products_description_ar') }}">{{ old('description_ar') }}</textarea>--}}
{{--                                    <div class="form-control-focus"> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-md-line-input">--}}
{{--                                <label class="control-label" for="description_en">{{ __('admin.products_description_en') }}</label>--}}
{{--                                <div class="">--}}
{{--                                    <textarea class="ckeditor form-control" id="description_en" name="description_en"  pattern="^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$" title="لابد من ادخال اسم المنتج باللغه الانجليزيه ويكون اكثر من ثلاثه حروف"  placeholder="{{ __('admin.products_description_en') }}">{{ old('description_en') }}</textarea>--}}
{{--                                    <div class="form-control-focus"> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!----price------>
                                <!-----weight---------------->
                             
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="price">{{ __('admin.products_price') }}</label>
                                <div class="">
                                    <input type="number" required="required" class="form-control" id="price" name="price" value="{{ old('price') }}"  placeholder="{{ __('admin.products_price') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="min_price">{{ __('admin.products_price_onsale') }}</label>
                                <div class="">
                                    <input type="number" class="form-control" id="min_price" name="min_price" value="{{ old('min_price') }}"  placeholder="{{ __('admin.products_price_onsale') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <!---quantity----->
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_quantity') }}</label>
                                <div class="">
                                    <input type="number" required="required" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="{{ __('admin.products_quantity') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_minquantity') }}</label>
                                <div class="">
                                    <input type="number" required="required" class="form-control" id="min_quantity" name="min_quantity" value="{{ old('min_quantity') }}"  placeholder="{{ __('admin.products_minquantity') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_maxquantity') }}</label>
                                <div class="">
                                    <input type="number" required="required" class="form-control" id="max_quantity" name="max_quantity" value="{{ old('max_quantity') }}" placeholder="{{ __('admin.products_maxquantity') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <!---keywords----->
                            {{--<div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_keywords_ar') }}</label>
                                <div class="">
                                    <input type="text" name="keywords_ar" class="form-control input-large" value="{{ old('keywords_ar') }}" data-role="tagsinput">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_keywords_en') }}</label>
                                <div class="">
                                    <input type="text" name="keywords_en" class="form-control input-large" value="{{ old('keywords_en') }}" data-role="tagsinput">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>--}}
                            <!---images---->
                            <div class="form-group form-md-line-input">
                                <label class="control-label" for="name">{{ __('admin.products_image') }}</label>
                                <i style="font-size: 10px; font-family: Tahoma; color: #4f0a0f">الحد الأقصى لعدد الصور 5 صور</i>
                                <div class="">
                                    <input type="file" required="required" class="form-control" id="image" name="image"  placeholder="{{ __('admin.products_image') }}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
{{--                            <div class="form-group form-md-line-input">--}}
{{--                                <label class=" control-label" for="name">{{ __('admin.products_images') }}</label>--}}
{{--                                <div class="">--}}
{{--                                    <input type="file"  class="form-control" id="logo" name="images[]"  placeholder="{{ __('admin.products_images') }}" multiple>--}}
{{--                                    <div class="form-control-focus"> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-md-line-input">--}}
{{--                                <label class=" control-label" for="name">{{ __('admin.products_images') }}</label>--}}
{{--                                <div class="">--}}
{{--                                    <input type="file"  class="form-control" id="logo" name="images[]"  placeholder="{{ __('admin.products_images') }}" multiple>--}}
{{--                                    <div class="form-control-focus"> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="input-group control-group increment" >
                                <input type="file" name="images[]" class="form-control" multiple>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="form-group form-md-line-input">--}}
{{--                                <label class=" control-label" for="name">{{ __('admin.products_galary') }}</label>--}}
{{--                                <div class="">--}}
{{--                                    <input type="file"  class="form-control" id="logo" name="images_1"  placeholder="{{ __('admin.products_images') }}" multiple>--}}
{{--                                    <div class="form-control-focus"> </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!----details ------->
							<input type="hidden" name="manfacture_country" value="0" >
                            <!------بلد المنشا----
                            <div class="form-group form-md-line-input">
                                <label class=" control-label" for="manfacture_country">{{ __('admin.country_manfature') }}</label>
                                <div class="">
                                    <select name="manfacture_country" class="form-control"  >
                                        <option value=" ">{{ __('admin.country_manfature') }}</option>
                                        @foreach ($countireslist as $country)
                                            <option value="{{ $country->id }}">@if(Lang::locale() == 'ar') {{ $country->name_ar }} @else {{ $country->name_en }}  @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-----delete_details_en_items---->
                            <div class="form-group form-md-line-input">
                                <label class=" control-label">{{__('admin.product_options')}} :</label>
                                <div class="">
                                    <!---->
                                    <button name="add_details_ar" class="btn btn-green add_details_ar" type="button"> {{ __('admin.product_option_add') }}</button>
                                    <div id="delete_details_ar_list">
                                        <div class="parent"><br/>
                                            <input type="text" class="form-control input-inline input-medium" name="details_ar[]" placeholder="{{ __('admin.product_option') }}">
                                            <button name="delete_details_ar_items" id="ar1" class="btn btn-green" type="button"> {{ __('admin.delete_title') }} </button>
                                            <br/>
                                        </div>
                                        <br/>
                                    </div>
                                    <!---->
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class=" control-label">{{ __('admin.product_options_en') }} :</label>
                                <div class="">
                                    <!----->
                                    <button name="add_details_en" class="btn btn-green add_details_en" type="button"> {{ __('admin.product_option_add_en') }}</button>
                                    <div id="delete_details_en_list">
                                        <div class="parent"><br/>
                                            <input type="text" pattern="^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$" title="لابد من ادخال ميزه المنتج باللغه الانجليزيه ويكون اكثر من ثلاثه حروف" class="form-control input-inline input-medium" name="details_en[]" placeholder="{{ __('admin.product_option') }}">
                                            <button name="delete_details_en_items" id="en1" class="btn btn-green" type="button"> {{ __('admin.delete_title') }} </button>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-----measuremets unit------------>
                          
                            <!---make product feature---->
                      
                            <!----status-------->
                            <div class="form-group form-md-line-input">
                                <label class=" control-label" for="active">{{ __('admin.active_status') }} : </label>
                                <div class="">
                                    <div class="radio-list">
                                        @if (old('active') == 'yes')
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
                                <!---form actions--->
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="reset" class="btn default">{{ __('admin.reset_title') }}</button>
                                        <button type="submit" class="btn blue">{{ __('admin.add_title') }}</button>
                                    </div>
                                </div>
                            </div>
                        {{ csrf_field() }}
                    </form>
                </div>
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
        $(document.body).on('click', "button[name=delete_details_en_items]", function(e){
            var ids = $(this).attr('id');
            $(this).parent('.parent').remove();
        }) ;
        $(document.body).on('click', "button[name=delete_details_ar_items]", function(e){
            var ids = $(this).attr('id');
            $(this).parent('.parent').remove();
        })
        $(document).ready(function(){
            var id = 1 ;

            $(" button[name=add_details_ar]").on('click' ,  function(){
                var idd = 1 +  id++ ;
                $("div#delete_details_ar_list").append('<div class="parent"><br/><input type="text" class="form-control input-inline input-medium" name="details_ar[]" placeholder="{{ __("admin.product_option") }}" ><button name="delete_details_ar_items" id="ar'+idd+'" class="btn btn-green delete_option_ar" type="button"> {{ __("admin.delete_title") }} </button></br></div>');

            });
            $(" button[name=add_details_en]").on('click' ,  function(){
                var idd = 1 +  id++ ;
                $("div#delete_details_en_list").append('<div class="parent"><br/><input pattern="^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$" title="لابد من ادخال ميزه المنتج باللغه الانجليزيه ويكون اكثر من ثلاثه حروف" type="text" class="form-control input-inline input-medium" name="details_en[]" placeholder="{{ __("admin.product_option") }}" ><button name="delete_details_en_items" id="en'+idd+'" class="btn btn-green delete_option_en" type="button"> {{ __("admin.delete_title") }} </button></br></div>');

            });
            //add more details             //
            // $('#brands_section').show('fast') ;
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
        //
    </script>

    <script type="text/javascript">
        var count = 0;

        $(document).ready(function() {

            $(".btn-success").click(function(){
                if(count < 2) {
                    var html = $(".clone").html();
                    $(".increment").after(html);
                    count++;
                }
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
                count--;
            });

        });

    </script>

@endsection
@section('header_style')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ ASSETS }}/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection




