@extends(ad.'.layouts.app')

@section('head_title') {{ __('admin.reviews') }} @stop

@section('content')

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{ __('admin.reviews') }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ URL::to(ADMIN.'/reviews_mass_delete') }}" method='POST'>
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
                                <th> {{ __('admin.reviews_who_do') }}</th>

                                <th> {{ __('admin.reviews_value') }} </th>
                                <th> {{ __('admin.reviews_item') }} </th>
                                <th> {{ __('admin.reviews_time') }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($reviews)
                                @foreach($reviews as $review)
                                    <tr class="odd gradeX">
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $review->id }}" />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td> @if($review->user){{ $review->user->name }} @endif     </td>
                                        <td>{{ $review->rating}}</td>
                                        <td>
                                            @if(Lang::locale() == 'ar')
                                             @if($review->reviewable )   {{ $review->reviewable->name_ar }} @endif
                                            @else
                                                @if($review->reviewable)   {{ $review->reviewable->name_en }} @endif
                                            @endif
                                        </td>
                                        <td> {{ $review->created_at->diffforhumans() }} </td>
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