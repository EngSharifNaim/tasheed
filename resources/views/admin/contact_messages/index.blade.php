@extends(ad.'.layouts.app')
@section('head_title')
    {{ __('admin.conatct_us_management') }}
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
                                        <span class="caption-subject bold uppercase">{{ __('admin.conatct_us_management') }}</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
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
                                    <form action="{{ URL::to(ADMIN.'/contact_messages_mass_delete') }}" method='POST'>
                                                {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                        <thead>
                                            <tr>


                                                <th>{{ __('admin.conatct_message_time') }}</th>
                                                <th> {{ __('admin.contact_us_title') }} </th>
                                                <th> {{ __('admin.contact_us_email') }}</th>
                                                <th> {{ __('admin.contact_us_name') }} </th>
                                                <th>{{  __('admin.options_title') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            @if($messages)
                                          @foreach($messages as $message)
                                            <tr class="odd gradeX">
                                                <td>
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $message->id }}" />
                                                        <span></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    {{ $message->created_at->diffforhumans() }}
                                                </td>
                                                <td>
                                                    {{ $message->title  }}
                                                </td>
                                                <td>
                                                    {{ $message->email  }}
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-left" page="menu">
                                                            <li>
                                                                <a href="{{ URL::to(ADMIN.'/contact_messages') }}/{{ $message->id }}">
                                                                    <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                        <div class="col-md-12" style="padding:0px">
                                            <div class="col-md-12   " style=""><button type="submit" value="1" name="delete" class="btn btn-danger" onclick='return confirm("{{ __('admin.delete_confirm') }}");'><li class="fa fa-trash-o"></li> {{ __('admin.delete_mass_title') }}</button>
                                                <button type="submit" name="archive" value="1" class="btn btn-warning" onclick='return confirm("{{ __('admin.contact_us_archived') }}");'> {{ __('admin.contact_us_archived') }}</button>
                                                <button type="submit" name="unarchive" value="1" class="btn btn" onclick='return confirm("{{ __('admin.contact_unarchieve_message') }}");'> {{ __('admin.contact_unarchieve_message') }}</button>
                                            </div>

                                        </div>

                            </form>
                            <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->

                             
</div>
</div>
@stop