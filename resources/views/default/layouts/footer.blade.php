<!--
<div class="container-fluid bg-gray padding-bottom">
    <div class="row justify-content-md-center">
        <div class="col-lg-6">
            <h1 class="maillist">{{ __('site.newsleters_join') }}</h1>
            <p class="maillist-pg">{{ __('site.newsletetter_offer') }}</p>
                <form id="newlettersform" method="post" action="{{ url('/newsletters') }}">
                    {{ csrf_field() }}
                    <input type="email" name="email" required class="form-control" placeholder="{{ __('site.write_email') }}" aria-describedby="sizing-addon1">
                    <button type="submit" class="input-group-addon btn-mail" id="sizing-addon1"><i class="fas fa-envelope"></i></button>
                </form>
        </div>
    </div>
</div>-->



<footer class="mainfooter" role="contentinfo">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-9">
                    <!--Column1-->
                    <div class="footer-pad">
                       <!-- <h4 class="head">{{ __('site.important_links') }}</h4> -->
                        <ul class="list-unstyled footer-list">
                            @foreach($footer_pages as $page_footer )
                                <li><a href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $page_footer->name_ar) }}@else{{ str_replace(' ', '_', $page_footer->name_en) }} @endif/{{ $page_footer->id }}">@if(Lang::locale() == 'ar') {{ $page_footer->name_ar }} @else {{ $page_footer->name_en }} @endif</a></li>
                            @endforeach
                            
                            
                            @foreach($topbar_pages as $key=>$top )
                    @if($key == 4 ) @break @endif
                 <li> <a href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $top->name_ar) }}@else{{ str_replace(' ', '_', $top->name_en) }}@endif/{{ $top->id }}">@if(Lang::locale() == "ar") {{ $top->name_ar }} @else  {{ $top->name_en }} @endif</a></li>
                @endforeach
                
                        
                        
                        <li class="social">
                        
                        
                            @if(isset($settings['twitter_url']))   <a href="{{ $settings['twitter_url']  }}" target="_blank"> <i class="fab fa-twitter footer-social-icon"></i></a> @endif
                            @if(isset($settings['site_whatup']))   <a href="{{ $settings['site_whatup'] }}" target="_blank"><i class="fab fa-whatsapp footer-social-icon"></i></a> @endif
                            </li>
                            </ul>
                            
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                     <h1 class="maillist">{{ __('site.newsleters_join') }}</h1>
            <!-- <p class="maillist-pg">{{ __('site.newsletetter_offer') }}</p> -->
                <form id="newlettersform" method="post" action="{{ url('/newsletters') }}">
                    {{ csrf_field() }}
                    <input type="email" name="email" required class="form-control" placeholder="{{ __('site.write_email') }}" aria-describedby="sizing-addon1">
                    <button type="submit" class="input-group-addon btn-mail" id="sizing-addon1"><i class="fas fa-envelope"></i></button>
                </form>
                    </div>
              
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <!--Footer Bottom-->
                    <p class="footer-copyright">{{__('site.copyrights')}} &copy; 2018 </p>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="pull-left">
                        تصميم وبرمجة سطوع لتقنية المعلومات
					</div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<div class="m-overlay"></div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.timepicker.min.js')}}"></script>
@if(Lang::locale() == 'ar')
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/slick.js')}}"></script>
@endif
@if(Lang::locale() == 'en')
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/slick.e.min.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/main-en.js')}}"></script>
@endif
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/main.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/script.js')}}"></script>
<!---ajax form --------->
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.form.js')}}"></script>
<script src="{{ URL::to('public') }}{{theme_url('vendors/js/jquery.bootstrap-growl.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@yield('page_scribt')
@yield('page_plugins')
@section('header_style')
@stop
<script type="text/javascript">
	 $(document.body).on('click', "a[name=addtofavouriteproduct]", function (event) { 
                @if( Auth::user() )
        var product_value =$(this).data("id") ;
        $.post("{{url('product-favourite')}}", {product:product_value})
            .done(function (data) {
                $.bootstrapGrowl(data.success,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                    //  position: absolute

                });
            });
        @else
      //  alert('{{ __('site.you_must_login_add_product_favourite') }} ') ;
        $.bootstrapGrowl('{{ __('site.you_must_login_add_product_favourite') }} ',{
            type: 'danger',
            delay: 2000,
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
            width: 'auto', // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 ,// spacing between consecutively stacked growls.
            //  position: absolute

        });
        @endif
    });
    $(document.body).on('click', ".cartitems", function(e){
        var product_id = $(this).attr("value");//alert(product_id) ;
        @if(Auth::user())
        @if( Auth::user()->level != 'dealer' && Auth::user()->level != 'admin' )
        $.ajax({
            type: "post",
            dataType: "html",
            url: "{{url('cart-guest')}}",
            data:'product='+product_id,
            success: function (response) {
                $.get("{{url('getcartcount')}}")
                    .done(function (data) {
                        if (data.length != 0) {
                            $('#cartcount').html(data);
                        }
                    });
                $.bootstrapGrowl(response,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                    //  position: absolute
                });
            }
        });
        @else
        //  alert( ' {{ __('site.no_add_vendor') }} ' )
        $.bootstrapGrowl('{{ __('site.no_add_vendor') }}',{
            type: 'danger',
            delay: 2000,
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
            width: 'auto', // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 ,// spacing between consecutively stacked growls.
            //  position: absolute

        });
        @endif
        @else
        $.ajax({
            type: "post",
            dataType: "html",
            url: "{{url('cart-guest')}}",
            data:'product='+product_id,
            success: function (response) {
                $.get("{{url('getcartcount')}}")
                    .done(function (data) {
                        if (data.length != 0) {
                            $('#cartcount').html(data);
                        }
                    });
                $.bootstrapGrowl(response,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                    //  position: absolute

                });
            }
        });
        @endif
    }) ;
    //for ajax product model input[name='case[]']:checked

    $(document.body).on('change', "form[name=filter_form]", function(e){
        //
        var sorting_type = $('select[name="list_order"] option:selected').val();
       //var rate_deller = $('div[class=progress-bar]').data('ratevalue'); alert(rate_deller) ;
        var section =  $("input[name='category[]']").val();
        if(section == null ){
            section = 0 ;
        }
      //alert(section) ;
        $.ajax({
            type: "get",
            dataType: "html",
            url: "{{url('search-filter')}}",
            data:'sorting_by='+sorting_type+'&section='+section ,
            beforeSend:function(){
                $('#loading').show('fast');
            },
            success: function (response) {
                // document.getElementById("filter_result").innerHTML = response;
                $(".filter_result").html(response);
                $('#loading').hide('fast');
            }
        });
    }) ;
    //
    $(document.body).on('click', "button[name=cartitems]", function(e){
        var product_id = $(this).attr("id");
       $.ajax({
            type: "post",
            dataType: "html",
            url: "{{url('cart-guest')}}",
            data:'product='+product_id,
            success: function (response) {
                document.getElementById("contentt").InnerHtml = response;
                //$('#contentt').html(response);
                $.bootstrapGrowl(response,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,// spacing between consecutively stacked growls.
                    //  position: absolute

                });
                $.get("{{url('getcartcount')}}")
                    .done(function (data) {
                        if (data.length != 0) {
                            $('#cartcount').html(data);
                        }
                    });
            }
        });
    }) ;
    $(document.body).on('click', ".product_model_link", function(e){
        var product_value = $(this).val();
        $.get("{{url('get-product-in-ajax')}}",{ product : product_value })
            .done(function (data) {
                if (data.length != 0) {
                    $('#fast_preview_content').html(data);
                    //  jQuery.noConflict();
                    $('#show_product_model').modal('show');
                    $('#show_product_model').modal('toggle') ;
                }
            });
    }) ;
    //end
    $(document).ready(function () {
        $(".cart_popup_items").hover(function(){
            $.ajax({
                type: "get",
                dataType: "html",
                url: "{{url('cart-popup-items')}}",
                success: function (response) {
                  $('.cart_data_injection').html(response);

                }
            });
        });
        //cart  cart_notf

        //load product model data

        $("#newlettersform").ajaxForm({
            success: function (response) {
                alert(response);
              /*  $.bootstrapGrowl(response,{
                    type: 'success',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,
                }); 
				*/
            },
            error: function (error) {
               alert('حدث خطا ') ;
            /*    $.bootstrapGrowl(error,{
                    type: 'danger',
                    delay: 2000,
                    offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                    align: '@if(Lang::locale() == 'ar') right @else left @endif', // ('left', 'right', or 'center')
                    width: 'auto', // (integer, or 'auto')
                    delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 ,
                });
				*/
            }
        });

    });
</script>

<script>
	$(document).ready(function () {
        /*open menu*/
        $('div#menu').click(function(){
		$('body').addClass('menu-toggle');
	});
        $(".m-overlay").click(function(){
            $("body").removeClass('menu-toggle');
            $(".hamburger").removeClass('active');
        });
	});
</script>


<script>
 
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[0];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[1];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[2];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[3];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[4];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[5];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[6];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[7];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[8];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[9];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("slider-nav")[10];
var btns = header.getElementsByClassName("category");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
     
    this.className += " activemenu";
  });
}
</script>


</body>
</html>