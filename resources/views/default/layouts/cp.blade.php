<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.meta_data')
    <style>
        #error-container {
            margin-top:100px;
            position: fixed;
        }

    </style>
</head>
<!-- Modal -->
<body>

<!---product popup model --------->
<div id="show_product_model" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="fast_preview_content">

        </div>
    </div>
</div>
<!---end product popup model -------->
@include('layouts.header')
<section class="bread2">
    <div class="container">
        <div class="row bread-crumb">
            <div class="col-lg-12">
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('site.home_page') }}<i class="fas fa-angle-left"></i> </a></li>
                    <li><a href="{{ URL::to('/') }}">{{ __('site.dashborad') }} <i class="fas fa-angle-left"></i> </a></li>
                    <li><a class="active">@yield('page_title')</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container copouns">
    <h1>@yield('page_title')</h1>
    <div class="row ">
        <div class="col-lg-3 side-navegation">
            <ul>
                 @if(Auth::user()->level != 'admin'  )  <li><a  href="{{ url('/dashborad') }}"> <i class="fas fa-angle-double-left"></i>{{ __('site.dashborad') }}</a></li> @endif
                @if(Auth::user()->level != 'admin'  ) <li><a class="active" href="{{ url('/edit-profile') }}"> <i class="fas fa-angle-double-left"></i>تعديل بياناتى</a></li> @endif
                     @if(Auth::user()->level != 'admin'  ) <li><a class="active" href="{{ url('/paid-acount') }}"> <i class="fas fa-angle-double-left"></i>ترقية حسابي</a></li> @endif
                @if(Auth::user()->level == 'user' )  <li><a  href="{{ url('/my-addresses') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.addresse_details') }}</a></li> @endif
                @if(Auth::user()->level == 'user' )  <li><a  href="{{ url('/my-orders') }}"> <i class="fas fa-angle-double-left"></i> مشترياتى </a></li> @endif
                @if(Auth::user()->level == 'dealer')  <li><a  href="{{ url('/acount/cupons') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.cupons') }}</a></li> @endif
                @if(Auth::user()->level == 'user')   <li><a  href="{{ url('/my-favourite-products') }}"> <i class="fas fa-angle-double-left"></i> المنتجات المفضله</a></li> @endif
               @if(Auth::user()->level != 'admin'  )   <li><a  href="{{ url('/conservation') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.conservation') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/my-products') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.my_products') }} </a></li> @endif
                     @if(Auth::user()->level == 'dealer')  <li><a href="{{ url('/add-product') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.add_product') }} </a></li> @endif

                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/shiping-details') }}"> <i class="fas fa-angle-double-left"></i> {{ __('admin.shiping_add') }} </a></li> @endif
                @if(Auth::user()->level != 'user' && Auth::user()->level != 'admin') <li><a  href="{{ url('/edit-company') }}"> <i class="fas fa-angle-double-left"></i> {{ __('site.edit_compay') }} </a></li> @endif
                @if(Auth::user()->level == 'dealer') <li><a  href="{{ url('/acount/orders') }}"> <i class="fas fa-angle-double-left"></i> مبيعاتى </a></li> @endif
           </ul>
        </div>
        <div class="modal fade" id="paidno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">غير مشترك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{$paidMsg}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
 @yield('content')
@include('layouts.footer')