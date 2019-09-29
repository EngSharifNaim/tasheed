@extends('layouts.cp')
@section('page_title')
    {{ __('site.dashborad') }}
@stop
@section('content')
            <div class="col-lg-9 content-copouns">
                <h3 class="customer-meassage-name">{{ __('site.welcome') }} {{ Auth::user()->name }}</h3>
                @if(Lang::locale() == 'ar')
                @if(isset($settings['dashbaord_welcome_message_ar']))
                <p class="customer-message">
                    {!! $settings['dashbaord_welcome_message_ar'] !!}
                </p>
                @endif
                @else
                    @if(isset($settings['dashbaord_welcome_message_en']))
                        <p class="customer-message">
                            {!! $settings['dashbaord_welcome_message_en'] !!}
                        </p>
                    @endif
                @endif
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="header-customer">
                            <h4 class="head-log">{{ __('site.contact_information') }}</h4>
                            <i class="fas fa-pencil-alt edite-data" onclick="javascript:location.href='https://www.tsheed.com/edit-profile'"></i>
                        </div>
                        <div class="inner-data">
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->email }} <a href="{{url('/edit-profile')}}" >{{ __('site.update_contact_information') }}</a>   </p>
                        </div>
                    </div>
                   @if($news_letter_check == 1 )
                    <div class="col-lg-6">
                        <div class="header-customer">
                            <h4 class="head-log">{{ __('site.newsletter_news') }}</h4>
                        </div>
                        <div class="inner-data">
                            <p>
                             {{ __('site.newsletter_p') }}
                            </p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
@stop



