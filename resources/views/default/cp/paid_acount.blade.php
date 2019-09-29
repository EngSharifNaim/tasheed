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
                            الخطط المتوفرة
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" action="{{ url('paidacounts_new') }}" method='POST'>
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
                            @if(!$myacount)
                            <thead>
                            <tr>
                                <th> نوع الاشتراك </th>
                                <th> الاشتراك السنوي </th>
                                <th> الاشتراك الشهري </th>
                                <th> مدة الاشتراك </th>
                                <th> ارسل الطلب </th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($paidacounts as $paidacount)
                                    <tr class="odd gradeX">

                                        <td>
                                            <input type="text" name="plan_id" value="{{$paidacount->id}}" style="display: none">
                                            {{ $paidacount->title }}
                                        </td>

                                        <td >
                                            {{ $paidacount->year_value }}
                                        </td>
                                        <td >
                                            {{ $paidacount->month_value }}
                                        </td>
                                        <td >
                                            <select name="paidlong">
                                                <option value="12">سنوي</option>
                                                <option value="1">ِشهري</option>
                                            </select>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>اسم المرسل</td>
                                        <td>رقم الحوالة</td>
                                        <td>اسم البنك</td>
                                        <td>صورة الحوالة</td>
                                    </tr>
                                    <tr class="odd gradeX">


                                        <td>
                                            <input type="text" required name="sender" class="form-control" placeholder="اسم المرسل">

                                        </td>

                                        <td >
                                            <input type="text" required name="payId" class="form-control" placeholder="رقم الحوالة">
                                        </td>
                                        <td >
                                            <input type="text" required name="banck" class="form-control" placeholder="اسم البنك">
                                        </td>
                                        <td >
                                            <input type="file" required name="image" id="image" class="form-control">
                                        </td>
                                        <td>
                                            <div class="col-md-12">

                                                <button type="submit" class="btn btn-primary">ارسل طلب الاشتراك</button>

                                            </div>
                                        </td>

                                    </tr>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="icon-settings"></i>بيانات الحوالة المالية</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">اسم المرسل</label>
                                                            <input type="text" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">رقم الحوالة</label>
                                                            <input type="text" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">اسم البنك</label>
                                                            <input type="text" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">صورة الحوالة</label>
                                                            <input type="file" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">ملاحظة</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                    <button type="button" class="btn btn-primary">ارسل الطلب</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                                @if(isset($haseacount))

                            <p class="alert alert-danger">
                                {{$haseacount}}

                            </p>
                            @if(isset($myacount))
                                @foreach($paidacounts as $pa)
                                    <div class="row">
                                        <div class="col col-md-4">

                                            نوع الاشتراك : {{$pa->title}}

                                        </div>
                                        <div class="col col-md-4">
                                            تاريخ البداية :
                                            @if($myacount->begin_at == '')
                                                بانتظار التفعيل ..
                                            @else
                                            {{$myacount->begin_at}}
                                                @endif

                                        </div>
                                        <div class="col col-md-4">
                                            تاريخ الانتهاء :
                                            @if($myacount->end_at == '')
                                                بانتظار التفعيل ..
                                            @else
                                             {{$myacount->end_at}}
                                                @endif
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                @endif
                            </tbody>
                        </table>
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



