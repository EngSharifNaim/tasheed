@extends('layouts.cp')
@section('page_title')
  {{ __('site.messages') }}
@stop
@section('content')
            <div class="col-lg-9 user-content">
                <div class="row">
                    @if (!empty($messages[0]))
                        <ul>
                    @foreach ($messages as $message)
                            <li>
                                <a class="user-img-list" href="{{ url('/account/conversation') }}/{{ $message->id }}">
                                    @if($message->user_with->photo)
                                        <img style="border-radius: 50%; width: 40px; height: 40px;"   src="{{ URL::to('public') }}{{ $message->user_with->photo }}" alt="">
                                    @else
                                        <img style="border-radius: 50%; width: 40px; height: 40px;"  src="{{ URL::to('public') }}{{theme_url('images/user_1523545943_19772.png')}}" alt="">
                                    @endif
                                </a>
                                <div class="mas-content-list">
                                    <h5><span> @if($message->message->last()){{ $message->message->last()->created_at }}@endif </span> {{ $message->user_with->name }} </h5>
                                    <p>
                                        @if($message->message->last())
                                            {{ $message->message->last()->details }}
                                        @else
                                            {{ trans('site.no_messages') }}
                                        @endif
                                    </p>
                                </div>
                            </li>
                    @endforeach
                        </ul>
                        <div class="paginationarea">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="row" style="padding-right:150px;">
                          {{ __('site.no_converstion') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop



