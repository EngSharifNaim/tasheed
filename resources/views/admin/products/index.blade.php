@extends(ad.'.layouts.app')

@section('head_title')
    {{ __('admin.products') }}
@stop

@section('content')

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{ __('admin.products') }}</span>
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
                                <th> {{ __('admin.sections') }} --   <select name="filter_section"  class=" " placeholder="" aria-controls="sample_1_2" >
                                        @foreach($sections as $section )
                                            <option value="{{ $section->id }}" >@if(Lang::locale() == 'ar') {{ $section->name_ar }} @else {{ $section->name_en }} @endif </option>
                                        @endforeach
                                    </select></th>
                                <th> {{  __('admin.options_title') }} </th>
                            </tr>
                          
                            </thead>
                            <tbody class="filter_result">

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
                                          @if(isset($product->user))  {{ $product->user->name }} @endif
                                        </td><td>
                                            {{ $product->mainsection['name_ar'] }}
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

@stop
@section('page_scripts')

    <script type="text/javascript">
        $(document.body).on('change', "select[name=filter_section]", function(e){
            //
            var section_id = $('select[name="filter_section"] option:selected').val();
            $.ajax({
                type: "get",
                dataType: "html",
                url: "{{url('filter-product')}}",
                data:'section_id='+section_id ,
               /* beforeSend:function(){
                    $('#loading').show('fast');
                },*/
                success: function (response) {
                    // document.getElementById("filter_result").innerHTML = response;
                    $(".filter_result").html(response);
                    $('#loading').hide('fast');
                }
            });
        }) ;
        </script>
 @stop