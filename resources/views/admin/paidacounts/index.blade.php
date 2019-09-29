@extends(ad.'.layouts.app')
{{--@section('head_title')--}}
{{--    {{ __('admin.paid') }}--}}
{{--@stop--}}
@section('content')
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
  <div class="col-md-12">
      @if(isset($activate))
          <span class="alert alert-success">
                                            {{$activate}}

                                        </span>
  @endif

  <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">الاشتراكات المدفوعة</span>
                                    </div>
                                </div>
                                <div class="portlet-body">

                                </div>
                              <form action="{{ URL::to(ADMIN.'/siteprofits') }}" method='POST'>
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
                                                <th>مدة الاشتراك </th>
                                                <th> اسم المشترك </th>
                                                <th> نوع الاشتراك </th>
                                                <th> من تاريخ </th>
                                                <th> الى تاريخ</th>
                                                <th>  تفاصيل</th>
                                                <th>  الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            @if($paidacounts)
                                          @foreach($paidacounts as $paidacount)
                                            <tr class="odd gradeX">
                                                <td>
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $paidacount->id }}" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    @if($paidacount->paidlong == 12)
                                                        سنوي
                                                    @endif
                                                        @if($paidacount->paidlong == 1)
                                                            شهري
                                                        @endif
                                                     </td>
                                                <td>
                                                  {{ $paidacount->User->name }}
                                                </td>
                                                <td>
                                                    @if($paidacount->paidacounttype)
                                                  {{ $paidacount->paidacounttype->title }}
                                                        @endif
                                                    
                                                </td>
                                                <td>
                                                    {{ $paidacount->begin_at }}
                                                </td>
                                                <td>
                                                    {{ $paidacount->end_at }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_{{$paidacount->id}}">
                                                        عرض التفاصيل
                                                    </button>
                                                </td>
                                               
                                                <td>
                                                @if($paidacount->active == 'no')
                                                    <a href="{{url('/paidacounts/activate/') . '/' . $paidacount->id}}" class="btn btn-success">
                                                    تفعيل
                                                    </a>
                                                    @else
                                                        <a href="{{url('/paidacounts/deactivate/') . '/' . $paidacount->id}}" class="btn btn-danger">
                                                    الغاء التفعيل
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModalCenter_{{$paidacount->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="dialog" style="width: 900px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">تفاصيل الحوالة المالية</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col col-md-6">صورة الحوالة</div>
                                                                <div class="col col-md-2">رقم الحوالة</div>
                                                                <div class="col col-md-2">اسم المرسل</div>
                                                                <div class="col col-md-2">اسم البنك</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col col-md-6"><img name="img" src="{{ URL::to('public/images/') }}{{'/' . $paidacount->image}}" width="400px"></div>
                                                                <div class="col col-md-2">{{$paidacount->payId}}</div>
                                                                <div class="col col-md-2">{{$paidacount->sender}}</div>
                                                                <div class="col col-md-2">{{$paidacount->banck}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                <div class="col-md-12">
                               

                                </div>
                            </form>
                            <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->

                             
</div>
</div>
@stop