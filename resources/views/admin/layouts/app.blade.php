@include(ad.'.header')

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">

           @include(ad.'.navbar')

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            
            @include(ad.'.menu')
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
               
                 <!-- BEGIN PAGE HEADER-->
                   
                    {{-- <h1 class="page-title"> Admin Dashboard 2
                        <small>statistics, charts, recent events and reports</small>
                    </h1> --}}
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ url(ADMIN) }}">{{ __('admin.home_title') }}</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>@yield('head_title')</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADER-->
                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
           
        </div>
        <!-- END CONTAINER -->

@include(ad.'.footer')