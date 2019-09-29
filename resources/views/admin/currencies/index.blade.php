@extends(ad.'.layouts.app')

@section('head_title') {{ __('admin.currencies') }} @stop

@section('content')

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{ __('admin.currencies') }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{ URL::to(ADMIN.'/currencies/create') }}" class="btn sbold green"> {{ __('admin.currencies_add') }}
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ URL::to(ADMIN.'/currencies_mass_delete') }}" method='POST'>
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
                                <th> {{ __('admin.currencies_name_ar') }}</th>
                                <th> {{ __('admin.currencies_value_to_dollar') }}</th>
                                <th> {{ __('admin.currencies_icon') }} </th>
                                <th> {{  __('admin.options_title') }} </th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($currencies)
                                @foreach($currencies as $currencie)
                                    <tr class="odd gradeX">
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $currencie->id }}" />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            @if(Lang::locale() == 'ar')
                                                <a href="{{ URL::to(ADMIN.'/currencies') }}/{{ $currencie->id }}/edit">{{ $currencie->name_ar }} </a>
                                            @else
                                               <a href="{{ URL::to(ADMIN.'/currencies') }}/{{ $currencie->id }}/edit">{{ $currencie->name_en }} </a>
                                            @endif
                                        </td>
                                        <td> {{ $currencie->value_to_dollar }} </td>

                                        <td>
                                            @if ($currencie->icon)
                                                <img src="{{ URL::to('public') }}{{ $currencie->icon }}" width="100" height="100">
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-left" page="menu">
                                                    <li>
                                                        <a href="{{ URL::to(ADMIN.'/currencies') }}/{{ $currencie->id }}">
                                                            <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ URL::to(ADMIN.'/currencies') }}/{{ $currencie->id }}/edit">
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