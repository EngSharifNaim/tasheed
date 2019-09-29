@extends('layouts.app')
@section('page_title')
    تسجيل الدخول
@endsection
@section('content')
    <section class="bread2">
        <div class="container">
            <div class="row bread-crumb">
                <div class="col-lg-4">
                    <ul>
                        <li><a href="#">الصفحة الرئيسية <i class="fas fa-angle-left"></i> </a></li>
                        <li><a href="#">انشاء حساب زبوم</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container copouns">
        <div class="row">
            <div class="col-lg-12 register-client">
                <div class="text-center">

                    <img src="{{ URL::to('public') }}/{{theme_url('images/line.png')}}">

                    <br><br>
                    @if(Auth::guest())
                        <h4>فضلا قم بتعبئة النموذج التالى للإشتراك بالموقع</h4>
                    @endif

                    <br><br>

                </div>
                @if (count($errors))
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endforeach
                @endif
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has($msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach

                <div class="alert alert-danger print-error-msg" id="print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                @if(!Auth::guest())



                    <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                        <h4>أنت مسجل دخول بالفعل</h4>
                        <br><br>
                        <a href="{{ url('/') }}" class="alert alert-success print-success-msg">الانتقال إلى الرئيسية</a>&nbsp;&nbsp;


                        <a href="{{ url('/logout') }}" class="alert alert-success print-success-msg" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{ trans('site.logout') }} </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>




                    </div>

                @else


                    <form  enctype="multipart/form-data" method="post" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        @if(isset($type) && $type == 'dealer')
                            <input type="hidden" name="level" value="dealer">
                            <input type='hidden' name='lat' id='lat' value="24.701726">
                            <input type='hidden' name='lng' id='lng' value="46.6892553">
                        @else
                            <input type="hidden" name="level" value="user">
                            <input type='hidden' name='lat' id='lat'>
                            <input type='hidden' name='lng' id='lng'>

                        @endif

                        <div class="form-group">


                            <input type="text" class="form-control input-inline input-medium" name="name" placeholder="{{ trans('site.register_name') }}" value="{{ old('name') }}">

                        </div>
                        <div class="form-group">

                            <input type="email" class="form-control" name="email" placeholder="{{ trans('site.register_email') }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                            @endif
                        </div>


                        <div class="form-group">


                            <input type="password" class="form-control input-inline input-medium" name="password" placeholder="{{ trans('site.register_password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                            @endif


                        </div>

                        <div class="form-group">



                            <input type="password" class="form-control input-inline input-medium" name="password_confirmation" placeholder="{{ trans('site.register_password_confirmation') }}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                            @endif

                        </div>

                        <div class="form-group">



                            <div class="radio-list">



                                @if(old('sex') == "male" )

                                    <label class="radio-inline">

                                        <input type="radio" name="sex" id="optionsRadios26" value='male' style="top: 0px;" checked> {{ trans('site.register_male') }}

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="sex" id="optionsRadios27" value='fmale' style="top: 0px;"> {{ trans('site.register_fmale') }}
                                    </label>

                                @else

                                    <label class="radio-inline">

                                        <input type="radio" name="sex" id="optionsRadios26" value='male' style="top: 0px;"> {{ trans('site.register_male') }}

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="sex" id="optionsRadios27" value='fmale' style="top: 0px;" checked> {{ trans('site.register_fmale') }}
                                    </label>

                                @endif

                            </div>


                        </div>

                        <div class="form-group">
                            <select  class="form-control "  name="countrie_id">
                                @foreach($countireslist as $country)
                                    @if(old('countrie_id') ==  $country->id )
                                        <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                    @else
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>






                        <div class="form-group">
                            <select  class="form-control "  name="citie_id">
                                <option value="0">اختر البلد اولا</option>
                            </select>
                        </div>

                        <div class="form-group">



                            <input type="text" class="form-control" name="area" placeholder="الحي(باللغة العربية ، مثال : حي المحمدية)" value="{{ old('area') }}">


                        </div>

                        <div class="form-group">


                            <input type="text" class="form-control" name="hous_number" placeholder="{{ trans('site.register_hous_number') }}" value="{{ old('hous_number') }}">


                        </div>
                        <div class="form-group">



                            <input type="text" class="form-control" name="address" placeholder="{{ trans('site.register_address_place_holder') }}" value="{{ old('address') }}">

                        </div>



                        @if(isset($type) && $type == 'dealer')

                            <div class="form-group">


                                <select id='deliver'  class="form-control can_deliver" name="can_deliver">
                                    <option value="no">خدمة التوصيل</option>
                                    <option value="yes">يوجد خدمة توصيل</option>
                                    <option value="no">لا يوجد خدمة توصيل</option>
                                </select>

                            </div>
                            <div class="form-group">



                                <input type="number" class="form-control show_price" name="delivery_price" min="0"  placeholder="سعر التوصيل بالريال" value="{{ old('delivery_price') }}">


                            </div>
                        @endif
                        <div class="form-group">

                            <input type="text" class="form-control" name="mobile" placeholder="{{ trans('site.register_mobile') }}" value="{{ old('mobile') }}">

                        </div>
                        <div class="form-group">

                            <p>رفع صورة شخصية:</p>
                            <input type="file" class="form-control" name="photo">


                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label privcy" for="gridCheck">
                                    هل تبيع على موقع ويب آخر؟ (مع نعم / لا إجابات) إذا كان الاجابة  نعم يجب تقديم رابط المتجر على الانترنت
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label privcy" for="gridCheck">
                                    أنا أفهم وأوافق على شروط سانود <a href="#" class="download-policy">تحميل شروط الارتباط</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-5 col-md-offset-7"><button class="btn-submit btn btn-p ">تسجيل</button></div>

                    </form>
                @endif
            </div>
        </div>
    </div>



@stop
@section('footer_scripts')

    <script type="text/javascript">

        $(document).ready(function() {

            $('#deliver').on('change', function () {
                if($(this).val() == 'no'){
                    $('.show_price').hide();
                }else if($(this).val() == 'yes'){
                    $('.show_price').show();
                }
            });
            $("form#data_basic").submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                /*
                var _token = $("input[name='_token']").val();
                var level = $("input[name='level']").val();
                var sex = $("input[name='sex']:checked").val();
                var name = $("input[name='name']").val();
                var email = $("input[name='email']").val();
                var mobile = $("input[name='mobile']").val();
                var country = $("select[name='country'] :selected").val();
                var can_deliver = $("select[name='can_deliver'] :selected").val();
                var city = $("input[name='city']").val();
                var area = $("input[name='area']").val();
                var hous_number = $("input[name='hous_number']").val();
                var address = $("input[name='address']").val();
                var lat = $("input[name='lat']").val();
                var lng = $("input[name='lng']").val();
                var password = $("input[name='password']").val();
                var password_confirmation = $("input[name='password_confirmation']").val();
                var delivery_price = $("input[name='delivery_price']").val();
                var photo = $("input[name='photo']").val();
                alert(photo);*/

                $.ajax({
                    url: "{{ url('/register') }}",
                    type:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        if($.isEmptyObject(data.error)){
                            if(data.success){
                                alert(data.success);
                                window.location = "{{ url('/login') }}";
                            }else{

                                alert('خطأ غير معروف .. حاول مرة اخري لاحقا');
                            }

                        }else{
                            printErrorMsg(data.error);
                            $('html,body').animate({
                                    scrollTop: $("#print-error-msg").offset().top},
                                'slow');

                        }
                    }
                });

            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            var vals = $("select[name=countrie_id] :selected").val();

            if(vals != 0){
                $.post("{{url('cities/cities_list')}}", { countrie: vals }).done(function( data ) {
                    $('select[name=citie_id]').html(data);
                });
            }

            var city = $("select[name=citie_id] :selected").val();
            if(city != 0){

                $.post( "{{url('regions/regions_list')}}", { citie: city })
                    .done(function( data ) {
                        $('select[name=region_id]').html(data);

                    });
            }

            $("select[name=countrie_id]").change(function(){
                var vals = $(this).val();
                if(vals != 0){

                    $.post( "{{url('cities/cities_list')}}", { countrie: vals })
                        .done(function( data ) {
                            $('select[name=citie_id]').html(data);

                        });
                }
            });

            $("select[name=citie_id]").change(function(){
                var vals = $(this).val();
                if(vals != 0){

                    $.post( "{{url('regions/regions_list')}}", { citie: vals })
                        .done(function( data ) {
                            $('select[name=region_id]').html(data);

                        });
                }
            });



        });

    </script>
@stop