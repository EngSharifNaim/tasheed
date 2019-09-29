<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start active open">
                            <a href="{{ URL::to('/') }}" target="_blank" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">{{ __('admin.menu_home_title') }}</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(ADMIN.'/') }}" class="nav-link nav-toggle">
                                <i class="icon-graph"></i>
                                <span class="title">{{ __('admin.menu_cp_title') }}</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(ADMIN.'/settings') }}" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">{{ __('admin.menu_settings_title') }}</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">{{ __('admin.menu_moderators_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/moderators') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_moderators_show') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/moderators/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_moderators_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-trophy"></i>
                                <span class="title">{{ __('admin.menu_grups_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/roles') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_grups_show') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/roles/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_grups_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">{{ __('admin.menu_users_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/users/dealers') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_users_dealers') }}</span>
                                    </a>
                                </li> 
								<li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/users/another') }}" class="nav-link ">
                                        <span class="title">مشاهده العضويات الاضافيه</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/users/') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_users_clients') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/users/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_users_add') }}</span>
                                    </a>
                                </li> 
								<li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/userlevels/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.userlevels') }}</span>
                                    </a>
                                </li>
								<li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/userlevels/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.userlevels_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-directions"></i>
                                <span class="title">{{ __('admin.menu_product_section_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/sections') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_product_section_show') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/sections/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_product_section_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
						<!---
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-apple"></i>
                                <span class="title">{{ __('admin.brands_managment') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ URL::to(ADMIN.'/brands') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.brands') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(ADMIN.'/brands/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.brands_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li> ---->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-envelope"></i>
                                <span class="title">{{ __('admin.menu_pmessages_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url::to(ADMIN.'/chat') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_pmessages_conv') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-layers"></i>
                                <span class="title">{{ __('admin.menu_pages_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/pages') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_pages_show') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/pages/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_pages_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-sliders"></i>
                                <span class="title">{{ __('admin.sliders-managment') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/sliders') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.sliders') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/sliders/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_slider_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-archive"></i>
                                <span class="title">{{ __('admin.menu_contact_title') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/contact_messages') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_contact_show') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/contact_messages/archived') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_contact_archive') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!---menu added by zezo ---->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-location-arrow"></i>
                                <span class="title">{{ __('admin.menu_country_city_regions_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/countries') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.country') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/countries/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.country_add') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/cities') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.city') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/cities/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.city_add') }}</span>
                                    </a>
                                </li>

                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/regions') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.region') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/regions/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.region_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--- colors--->
                       
                       
                       
                        <!--- products--->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-folder-open"></i>
                                <span class="title">{{ __('admin.products_mangment') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/products') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.products') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/products/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.products_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--- orders--->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="title">{{ __('admin.orders_mangment') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/orders') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.orders') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--- reports--->
                        <!--- questionsandanswers--->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-question"></i>
                                <span class="title">{{ __('admin.questionsandanswers_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/questionsandanswers') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.questionsandanswers') }}</span>
                                    </a>

                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/questionsandanswers/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.questionsandanswers_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!---currencies--->
                       
                        <!---reviews----->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-star-half-o"></i>
                                <span class="title">{{ __('admin.reviews_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/reviews') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.reviews') }}</span>
                                    </a>

                                </li>
                            </ul>
                        </li>
                        <!---advertsments---->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.advertisments_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/advertisments') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.advertisments') }}</span>
                                    </a>

                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/advertisments/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.advertisments_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!---measurements_units---->
                       
                        <!-----cupons--------------->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.cupons_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/cupons') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.show_cupons') }}</span>
                                    </a>

                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/cupons/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.cupons_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-----shiping_manage--------------->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.shiping_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/shipings') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.shiping_manage') }}</span>
                                    </a>

                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/shipings/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.shiping_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-----subscribers_manage--------------->
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.subscribers_manage') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/newsletters') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.subscribers_show_all') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>        
						<li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.mobilymessages_menu') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/mobilymessages') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.mobilymessages') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">{{ __('admin.siteprofits') }}</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/siteprofits') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.siteprofits_show_all') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tv"></i>
                                <span class="title">الاشتراكات المدفوعة</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/paidacounts') }}" class="nav-link ">
                                        <span class="title">عرض الاشتراكات المدفوعة</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-directions"></i>
                                <span class="title">إدارة خطط الاشتراك</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/paidacounttypes') }}" class="nav-link ">
                                        <span class="title">عرض الخطط</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to(ADMIN.'/paidacounttypes/create') }}" class="nav-link ">
                                        <span class="title">{{ __('admin.menu_product_section_add') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!---end zezo menu---------->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->