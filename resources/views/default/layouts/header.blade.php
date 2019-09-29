<style>
.ads-top {
    position: relative;
}

.ads-top.ads-top a img {
    display: block;
    margin: auto;
    max-width: 100%;
    width: 100%;
}
	.ads-top #exit {
    position: absolute;
    top: 20px;
    right: 40px;
}
</style>
@if(Lang::locale() == 'ar')
<style> 
</style>
@endif
@if(Lang::locale() == 'en') 
<style>

</style>
@endif
<div id="mySidenav" class="sidenav"> 		
                <img src="{{ URL::to('public') }}{{theme_url('images/logo.png')}}" class="img-fluide logo" alt="{{ $settings['site_title'] }}">
	<div class="user">
		@if(Auth::user())<span id="wellcome"> <a href="{{ URL::to('/dashborad') }}"> <i class="far fa-user"></i>  {{ __('site.welcome') }} {{ nl2br(str_limit(trim(Auth::user()->name), $limit = 10, $end = '  '))  }}   </a></span> @endif 
	</div> 	
	<ul class="list-unstyled" style="margin-top: 10px;">
			<li><a href="{{ url('/') }}">{{ __('site.home_page') }}</a></li>
            @foreach($all_sections  as $section )
                <li @if(count($section->has_sub) > 0 ) class="sub-menu" @endif ><a href="{{ url('/main-section') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($section->name_ar)) }}@else{{ str_replace(' ', '_', trim($section->name_en))}}@endif/{{$section->id}}" style="font-size: 15px  ;">@if(Lang::locale() == "ar") {{ $section->name_ar }} @else {{ $section->name_en }} @endif @if(count($section->has_sub) > 0 )<i class="fa fa-angle-down"></i> @endif </a>
                    @if(count($section->has_sub) > 0)
                        <ul class="list-unstyled" >
                            @foreach($section->has_sub as $sub_section )
                                <li @if(count($sub_section->subsections) > 0 ) class="sub-menu"  @endif ><a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($section->name_ar)) }}/{{ str_replace(' ', '_', trim($sub_section->name_ar)) }}@else{{ str_replace(' ', '_', trim($section->name_en)) }}/{{ str_replace('', '_', trim($sub_section->name_en)) }}@endif/{{ $sub_section->id }}" style="font-size: 15px; important " >@if(Lang::locale() == 'ar') {{ $sub_section->name_ar }} @else {{ $sub_section->name_en }} @endif @if(count($sub_section->subsections) > 0 ) <i class="fa fa-angle-down"></i> @endif </a>
                                @if(count($sub_section->subsections) > 0 )
                                    <ul class="list-unstyled" >
                                @foreach($sub_section->subsections as $sub_sub_section )
                                            <li><a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($sub_sub_section->name_ar)) }}/{{ str_replace(' ', '_', trim($sub_sub_section->name_ar)) }}/{{ str_replace(' ', '_', trim($sub_sub_section->name_ar)) }}@else{{ str_replace(' ', '_', trim($sub_sub_section->name_en)) }}/{{ str_replace(' ', '_', trim($sub_section->name_en)) }}/{{ str_replace(' ', '_', trim($sub_sub_section->name_en)) }}@endif/{{$sub_sub_section->id}}">@if(Lang::locale() == 'ar' ) {{ $sub_sub_section->name_ar }} @else {{ $sub_sub_section->name_en }} @endif</a></li>
                                @endforeach
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
		
		<li  class="sub-menu">
                        <a class="" href="#">مهندسون و مقاولون<i class="fa fa-angle-down"></i> </a>
                        
                        
                        
                          
                        <ul class="list-unstyled" >
                        
                         @foreach($userlevels as $userlevel )
		@if($userlevel->slug  == 'admin' || $userlevel->slug  == 'dealer' || $userlevel->slug  =='user')
                                  
							@else
							
							<li><a style="font-weight:600;" href="{{ url('/') }}/additionalacount/userlevel/{{$userlevel->id}}">@if(Lang::locale() == 'ar') {{ $userlevel->name_ar }} @else {{ $userlevel->name_en }} @endif  </a></li>
							
       
		@endif
        @endforeach
        
                        
                      
                   </ul>
                    </li>
            @foreach($all_pages as $page )
                    <li><a href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $page->name_ar) }}@else{{ str_replace(' ', '_', $page->name_en) }}@endif/{{ $page->id }}">@if(Lang::locale() == 'ar') {{ $page->name_ar }} @else {{ $page->name_en }} @endif</a></li>
            @endforeach
			<li><a href="{{url('/contact')}}">{{ __('site.contact_title') }}</a></li>
		</ul>
	@if(Auth::user())
	<a class="sign-out" href="{{ URL::to('/logout') }}"> <i class="fas fa-sign-out-alt"></i> {{ __('site.logout') }}</a>
@endif
</div>
<div id="main">
    @empty(!$top_main_advertise)
        <div class="ads-top">
            <a href="" id="exit"><svg
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="13px" height="13px">
        <path fill-rule="evenodd"  fill="rgb(225, 225, 225)"
         d="M0.247,12.684 C0.596,13.033 1.164,13.033 1.512,12.684 L6.466,7.731 L11.419,12.684 C11.768,13.033 12.334,13.033 12.684,12.684 C13.033,12.334 13.033,11.768 12.684,11.419 L7.731,6.466 L12.684,1.512 C13.033,1.164 13.033,0.596 12.684,0.247 C12.334,-0.102 11.768,-0.102 11.419,0.247 L6.466,5.201 L1.512,0.247 C1.164,-0.102 0.596,-0.102 0.247,0.247 C-0.102,0.596 -0.102,1.164 0.247,1.512 L5.201,6.466 L0.247,11.419 C-0.102,11.768 -0.102,12.334 0.247,12.684 Z"/>
        </svg></a>
            <div class="conn-ads">
                @if($top_main_advertise->link)
                    <a href="{{ $top_main_advertise->link }}">   <img src="{{ URL::to('/public') }}{{$top_main_advertise->image}}"  ></a>
                @else
                    <img src="{{ URL::to('/public') }}{{$top_main_advertise->image}}"  style="width:100%">
                @endif
            </div>
        </div>
    @endempty
<div class="site-body">
<!--<div class="se-pre-con"></div>-->
{{--    <!-- Start Topbar --> --}}
{{--    <nav class="navbar navbar-expand-lg navbar-dark navbar navbar-expand-lg navbar-dark bg-dark ">--}}
{{--        <div class="container">--}}
{{--			<div class="dsix">--}}
{{--            <div class="test">--}}
{{--                @foreach($topbar_pages as $key=>$top )--}}
{{--                    @if($key == 4 ) @break @endif--}}
{{--                <a class="top-info" href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $top->name_ar) }}@else{{ str_replace(' ', '_', $top->name_en) }}@endif/{{ $top->id }}">@if(Lang::locale() == "ar") {{ $top->name_ar }} @else  {{ $top->name_en }} @endif</a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="navbar-collapse" id="navbarsExample07">--}}
{{--                <ul class="navbar-nav mr-auto">--}}
{{--                  --}}
{{--                      <li class="nav-item whit">--}}
{{--                        <div class="menu-well">--}}
{{--							<span id="">{{ __('site.help') }} |</span>--}}
{{--                    	<ul>--}}
{{--                            @foreach($help_pages as $help_page )--}}
{{--							<li><a style="color:#636363 !important;" href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $help_page->name_ar) }}@else{{ str_replace(' ', '_', $help_page->name_en) }}@endif/{{ $help_page->id }}">@if(Lang::locale() == 'ar') {{ $help_page->name_ar }} @else {{ $help_page->name_en }} @endif</a>  </li>--}}
{{--                            @endforeach--}}
{{--						</ul>--}}
{{--						</div>--}}
{{--					</li>--}}
{{--					--}}
{{--					--}}
{{--                    <li class="nav-item whit">--}}
{{--                        @if(Lang::locale() == "ar")--}}
{{--                            <a class="nav-link" href="{{ url('language/en') }}">EN</a>--}}
{{--                        @else--}}
{{--                        <a class="nav-link" href="{{ url('language/ar') }}">عربى</a>--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                    --}}
{{--                    --}}
{{--                      @if(count($help_pages) > 0 )--}}
{{--                  --}}
{{--                    @endif--}}
{{--                    --}}
{{--                    --}}
{{--                </ul>--}}
{{--            </div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--    </nav> --}}
    <!-- End Topbar -->
	
    <nav class="navbar navbar-expand-md middile-nav">
        <div class="container">
			<div class="dislx">
				<div id="menu">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<a class="navbar-brand" href="{{ URL::to('/') }}">
                <img src="{{ URL::to('public') }}{{theme_url('images/logo.png')}}" class="img-fluide logo" alt="{{ $settings['site_title'] }}">
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarsDefault">
                <form class="hidden-xs" method="get" action="{{url('/search')}}" >
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" required class="search-header form-control" placeholder="{{ __('site.search') }}">
                        <i class="search-btn fa fa-search"></i>
                    </div>
                </form> 
                <ul class="list-inline">
              
					<li class="nav-item">
						<div class="menu-well">
						    @if(!Auth::user())
							<span id="wellcome"> {{ __('site.welcome') }}    <i class="fas fa-sort-down"></i></span>
							<ul>
								<li><a href="{{ URL::to('/login') }}"> <i class="far fa-user"></i> {{ __('site.do_login') }}</a></li>
								<li><a href="{{ URL::to('/register-dealer') }}"> <i class="far fa-edit"></i>  تسجيل تاجر</a></li>
								<li><a href="{{ URL::to('/register-client') }}"> <i class="fas fa-sign-out-alt"></i>  تسجيل مشتري</a></li>
								<li><a href="{{ URL::to('/register-another') }}"> <i class="fas fa-sign-out-alt"></i>   تسجيل مهندسون ومقاولون  </a></li>
                             @endif
							</ul>
						</div>
					</li>
                  <!--  <a class="second-barex  cart-icon" href="{{ url('cart') }}">
                      <img src="{{ URL::to('public') }}{{theme_url('images/card-icon.png')}}" alt="icon">
                    </a>-->
					@if(Auth::user()) <div class="nouser hidden-lg"> @endif
                    <li class="nav-item">
                      <div class="dropdown-cart">
                          <span id="cartcount">
						  @php 
						  $i = 0 ;
						foreach (Cart::content() as $row) {
							 $i++ ;  
							}
							@endphp
						  {{$i  }}</span>
                          <a class="second-barex cart-icon second-menu nav-link cart_popup_items"  id="cart"  href="{{ url('cart') }}"> 
                          <i class="fas fa-shopping-cart clrb"></i>
                              العربة
                              </a>
                         <div class="item-cart cart_data_injection">
                         </div>
                      </div>
                    </li>
					@if(Auth::user()) </div> @endif
                </ul>
            </div>
				<div class="hidden-xs">
                
                <ul class="navbar-nav m-auto">
              
					<li class="nav-item">
						<div class="menu-well">
						    
							<span id="wellcome"> @if(Auth::user()) {{ __('site.welcome') }} {{ nl2br(str_limit(trim(Auth::user()->name), $limit = 10, $end = '  '))  }}@else {{ __('site.welcome') }} @endif    <i class="fas fa-sort-down"></i></span>
							<ul>
								@if(Auth::user())
                                    @if(Auth::user()->level != 'admin' ) <li><a href="{{ URL::to('/dashborad') }}"> <i class="far fa-user"></i> {{ __('site.dashboard_user') }}</a></li> @endif
                                    @if(Auth::user()->level == 'user' )<li><a href="{{ URL::to('/my-favourite-products') }}"> <i class="far fa-edit"></i> {{ __('site.my_favourite_products') }}</a></li> @endif
								<li><a href="{{ URL::to('/logout') }}"> <i class="fas fa-sign-out-alt"></i> {{ __('site.logout') }}</a></li>
                            @else
								<li><a href="{{ URL::to('/login') }}"> <i class="far fa-user"></i> {{ __('site.do_login') }}</a></li>
								<li><a href="{{ URL::to('/register-dealer') }}"> <i class="far fa-edit"></i>  تسجيل تاجر</a></li>
								<li><a href="{{ URL::to('/register-client') }}"> <i class="fas fa-sign-out-alt"></i>  تسجيل مشتري</a></li>
								<li><a href="{{ URL::to('/register-another') }}"> <i class="fas fa-sign-out-alt"></i>     تسجيل مهندسون ومقاولون</a></li>
                             @endif
							</ul>
						</div>
					</li>
                  <!--  <a class="second-barex  cart-icon" href="{{ url('cart') }}">
                      <img src="{{ URL::to('public') }}{{theme_url('images/card-icon.png')}}" alt="icon">
                    </a>-->
                    <li class="nav-item">
                      <div class="dropdown-cart">
                          <span id="cartcount">
						  @php 
						  $i = 0 ;
						foreach (Cart::content() as $row) {
							 $i++ ;  
							}
							@endphp
						  {{$i  }}</span>
                          <a class="second-barex cart-icon second-menu nav-link cart_popup_items"  id="cart"  href="{{ url('cart') }}"> 
                          <i class="fas fa-shopping-cart clrb"></i>
                              العربة
                              </a>
                         <div class="item-cart cart_data_injection">
                         </div>
                      </div>
                    </li>
                </ul>
            </div>
			</div>
			<form class="hidden-lg" method="get" action="{{url('/search')}}" >
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" required class="search-header form-control" placeholder="{{ __('site.search') }}">
                        <i class="search-btn fa fa-search"></i>
                    </div>
                </form> 
           
        </div>
    </nav>
   
       
    <style>
 

nav ul li {
  display: block;
}
 
nav ul li:hover > ul {
  display: block  !important;
 
}
 
 

.nav > li.dropdown .dropdown-menu {
 border-radius: 0px !important;
padding: 8px 15px;
 
  text-align: right  !important;
  left: auto !important;
  right: 0 !important;
   
}
.mainmenuclass {
    padding:5px;
}
.dropdown-menu > li {
  display: block !important;
  border-bottom: 1px solid #e5e5e5;
  line-height: 30px !important;
  vertical-align: middle !important;
}
.p-r-0{
    padding-right:0;
}
@media screen and (max-width: 767px) {
  .dropdown-menu > li {
    display: block;
  }
}.headerdropm {

    top: 89% !important;

}
.dropdown-menu {

    min-width: 13rem !important;
    
}
.mainmenuclass a:hover{
    color:#ec6f1f;
}
    </style>

    <main class="">
        <nav class="navbar navbar-dark bg-orange second-menu">
            <div class="container">
                <ul class="nav no-right-padding">
                    <li class="nav-item no-right-padding active">
                        <a class="nav-link" href="{{ url('/') }}">{{ __('site.home_page') }}</a>
                    </li>
                    
                   @foreach($sections as $sec)
					 <li @if(count($sec->has_sub) > 0 ) class="dropdown" @endif >
          <a href="{{ url('/main-section') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($sec->name_ar)) }}@else{{ str_replace(' ', '_', trim($sec->name_en))}}@endif/{{$sec->id}}" class="nav-link dropdown-toggle" > @if(Lang::locale() == 'ar')  {{ $sec->name_ar }} @else {{ $sec->name_en }} @endif <span class="caret"></span></a>
          
@if(count($sec->has_sub) > 0 ) 
<ul class="dropdown-menu headerdropm" role="menu"> 	
 @foreach($sec->has_sub as $sub_section )	
		 	   
            
            <li class="mainmenuclass" >
              <a style="font-weight:600;"  href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $sec->name_ar) }}/{{ str_replace(' ', '_', $sub_section->name_ar) }}@else {{ str_replace(' ', '_', $sec->name_en) }}/{{ str_replace(' ', '_', $sub_section->name_en) }}@endif/{{$sub_section->id}}" style="font-size: 15px important ;" >@if(Lang::locale() == 'ar') {{ $sub_section->name_ar }} @else {{ $sub_section->name_en }} @endif </a>
               
                <div>
			     <ul class="p-r-0">
                     @foreach($sub_section->subsections as $sub_sub_section )
                    <li style="dispaly:block;"><a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $sec->name_ar) }}/{{ str_replace(' ', '_', $sub_section->name_ar) }}/{{ str_replace(' ', '_', $sub_sub_section->name_ar) }}@else{{ str_replace(' ', '_', $sec->name_en) }}/{{ str_replace(' ', '_', $sub_section->name_en) }}/ {{ str_replace(' ', '_', $sub_sub_section->name_en) }}@endif/{{$sub_sub_section->id}}">@if(Lang::locale() == 'ar' ) {{ $sub_sub_section->name_ar }} @else {{ $sub_sub_section->name_en }} @endif</a></li>
                    @endforeach
                 </ul>
                </div>
               
            </li>
           

               
				@endforeach
				 </ul>
				 @endif
				</li>
				 @endforeach
            @foreach($menu_pages as $key=>$menu )
                        @if($key==6) @break @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $menu->name_ar) }}@else{{ str_replace(' ', '_', $menu->name_en) }} @endif/{{ $menu->id }}"> @if(Lang::locale() == "ar") {{ $menu->name_ar }} @else  {{ $menu->name_en }} @endif </a>
                    </li>
                    @endforeach
                    
                       <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ url('/') }}">مهندسون و مقاولون   <span class="caret"></span> </a>
                        
                        <ul class="dropdown-menu headerdropm" role="menu"> 	
                        
                         @foreach($userlevels as $userlevel )
		@if($userlevel->slug  == 'admin' || $userlevel->slug  == 'dealer' || $userlevel->slug  =='user')
                                  
							@else
							
							<li class="mainmenuclass" ><a style="font-weight:600;" href="{{ url('/') }}/additionalacount/userlevel/{{$userlevel->id}}">@if(Lang::locale() == 'ar') {{ $userlevel->name_ar }} @else {{ $userlevel->name_en }} @endif  </a></li>
							
       
		@endif
        @endforeach
        
                        
                      
                    </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contact')}}">{{ __('site.contact_title') }}</a>
                    </li>
            
                </div>
        </nav>

    </main>

      <!-- cd-main-content -->
    <nav id="cd-lateral-nav">
        
        <ul class="cd-navigation">
            <ul class="cd-navigation cd-single-item-wrapper">
                <li><a class="current" href="{{ url('/') }}">{{ __('site.home_page') }}</a></li>
                @foreach($menu_pages as $menu )
                    <li >
                        <a href="{{ URL::to('/page') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', $menu->name_ar) }}@else{{ str_replace(' ', '_', $menu->name_en) }} @endif/{{ $menu->id }}"> @if(Lang::locale() == "ar") {{ $menu->name_ar }} @else  {{ $menu->name_en }} @endif </a>
                    </li>
                @endforeach
               
            
            <!-- cd-single-item-wrapper -->
            @foreach($sections as $sec)
            
            <li class="item-has-children">
                <a href="{{ url('/main-section') }}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($sec->name_ar)) }}@else{{ str_replace(' ', '_', trim($sec->name_en))}}@endif/{{$sec->id}}"><i class="fas fa-chevron-left"></i> @if(Lang::locale() == 'ar')  {{ $sec->name_ar }} @else {{ $sec->name_en }} @endif</a>
               @if(count($sec->has_sub) > 0 )
                <ul class="sub-menu">
                    @foreach($sec->has_sub as $subsection )
                    <li><a href="{{url('/section')}}/@if(Lang::locale() == "ar"){{ str_replace(' ', '_', trim($sec->name_ar)) }}/{{ str_replace(' ', '_', trim($subsection->name_ar)) }}@else{{ str_replace(' ', '_', trim($sec->name_en)) }}/{{ str_replace('', '_', trim($subsection->name_en)) }}@endif/{{ $subsection->id }}">@if(Lang::locale() == 'ar')  {{ $subsection->name_ar }} @else {{ $subsection->name_en }} @endif</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
            
            
              <li class="item-has-children">
                        <a href="{{ url('/') }}"><i class="fas fa-chevron-left"></i> عضويات اضافيه <span class="caret"></span> </a>
                        
                         <ul class="sub-menu">
                        
                         @foreach($userlevels as $userlevel )
		@if($userlevel->slug  == 'admin' || $userlevel->slug  == 'dealer' || $userlevel->slug  =='user')
                                  
							@else
							
							<li  ><a style="font-weight:600;" href="{{ url('/') }}/additionalacount/userlevel/{{$userlevel->id}}">@if(Lang::locale() == 'ar') {{ $userlevel->name_ar }} @else {{ $userlevel->name_en }} @endif  </a></li>
							
       
		@endif
        @endforeach
        
                        
                      
                    </ul>
                    </li>
            
          
             
             
             
             	<li class="item-has-children">
					<a href="#"><i class="fas fa-chevron-left"></i> @if(Auth::user()) {{ __('site.welcome') }} {{ nl2br(str_limit(trim(Auth::user()->name), $limit = 10, $end = '  '))  }}@else {{ __('site.welcome') }} @endif     </a>
							<ul class="sub-menu">
								@if(Auth::user())
                                    @if(Auth::user()->level == 'user' || Auth::user()->level == 'dealer' ) <li><a href="{{ URL::to('/dashborad') }}"> <i class="far fa-user"></i> {{ __('site.dashboard_user') }}</a></li> @endif
                                    @if(Auth::user()->level == 'user' )<li><a href="{{ URL::to('/my-favourite-products') }}"> <i class="far fa-edit"></i> {{ __('site.my_favourite_products') }}</a></li> @endif
								<li><a href="{{ URL::to('/logout') }}"> <i class="fas fa-sign-out-alt"></i> {{ __('site.logout') }}</a></li>
                            @else
								<li><a href="{{ URL::to('/login') }}"> <i class="far fa-user"></i> {{ __('site.do_login') }}</a></li>
								<li><a href="{{ URL::to('/register-dealer') }}"> <i class="far fa-edit"></i> {{ __('site.register_as_dealer') }}</a></li>
								<li><a href="{{ URL::to('/register-client') }}"> <i class="fas fa-sign-out-alt"></i> {{ __('site.register_as_client') }}</a></li>
								<li><a href="{{ URL::to('/register-another') }}"> <i class="fas fa-sign-out-alt"></i> {{ __('site.register_as_another') }}</a></li>
                            @endif
							</ul>
							
								</li>
					   <li><a href="{{url('/contact')}}">{{ __('site.contact_title') }}</a></li>
					   
					   <li> <form method="get" action="{{url('/search')}}" >
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" required class="search-header form-control" placeholder="{{ __('site.search') }}">
                        <i class="search-btn fa fa-search"></i>
                    </div>
                </form> 
                </li>
						</div>
			
            <!-- item-has-children -->
        </ul>
       
      
    </nav>

