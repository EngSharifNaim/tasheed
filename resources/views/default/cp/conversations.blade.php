@extends('layouts.cp')
@section('page_title')
  محادثاتى
@stop
@section('content')
    <div class="col-lg-9 user-content">
        <div class="row">
            <div class="col-md-4">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ابحث">
                        <i class="chat-search fa fa-search" aria-hidden="true"></i>
                    </div>
                </form>
                <div class="col-inside-lg decor-default chat" style="overflow: hidden; outline: none;" tabindex="5000">
                    <div class="chat-users">
                        @foreach ($messages_contacts as $conversation)
                            @if ($conversation->user_with->id == Auth::user()->id)
                                <div class="user">
                                    <a href="{{ url('/account/conversation') }}/{{ $conversation->id }}">
                                        <div class="avatar">
                                           
                                                <img style="border-radius: 50%; width: 40px; height: 40px;" src="{{ URL::to('public') }}/storage/TDqXf9Gvw8lwGRtZs1LKyz3YikCXVWNzVR6TWmoP.jpeg" alt="User Image">
                                           
                                            <div class="status off"></div>
                                        </div>
                                        <div class="name" style="color: #212529;"> <span class="date-chat pull-left">@if($conversation->message->last()) {{ $conversation->message->last()->created_at->diffForHumans() }} @else {{ $conversation->created_at->diffForHumans() }} @endif</span>
                                            {{ $conversation->user_by->name }}
                                        </div>
                                    </a>
                                    <div class="mood">@if($conversation->message->last()) {{ $conversation->message->last()->details }} @else {{ trans('site.no_messages') }}@endif</div>
                                </div>
                            @else
                                <div class="user">
                                    <a href="{{ url('/account/conversation') }}/{{ $conversation->id }}">
                                        <div class="avatar">
                                             <img style="border-radius: 50%; width: 40px; height: 40px;" src="{{ URL::to('public') }}/storage/TDqXf9Gvw8lwGRtZs1LKyz3YikCXVWNzVR6TWmoP.jpeg" alt="User Image">
                                           

                                            <div class="status off"></div>
                                        </div>
                                        <div class="name" style="color: #212529;"> <span class="date-chat pull-left">@if($conversation->message->last()) {{ $conversation->message->last()->created_at->diffForHumans() }} @else {{ $conversation->created_at->diffForHumans() }} @endif</span>
                                            {{ $conversation->user_with->name }}
                                        </div>
                                    </a>
                                    <div class="mood">@if($conversation->message->last()) {{ $conversation->message->last()->details }} @else {{ trans('site.no_messages') }}@endif</div>
                                </div>
                            @endif
                        @endforeach

                   
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12 body-chat">
			   
                <div class="chat-info">
                        <h6 class="chat-sett">@if(Auth::user()->id == $messages->user_by->id) {{ $messages->user_with->name }} @elseif(Auth::user()->id == $messages->user_with->id) {{ $messages->user_by->name }} @endif
                        <span class="count pull-left"> {{ __('site.message_count') }} : {{ count($messages->message) }} </span></h6>
                </div>
				
                <div id="chat-scroll-container">
                    <div class="chat" style="overflow: hidden; outline: none;" tabindex="5001">
                        <div class="col-inside-lg decor-default">

                            <div class="chat-body" id="messages_list">
                                @if($messages->message->last())
									@if(!empty($messages->message))
                                    @foreach ($messages->message as $message)
								@if(!empty($message))
								@if(!empty($message->user_from))
                                        <div class="answer @if($message->user_from->id == Auth::user()->id) right @else left @endif">
                                            <div class="avatar">
                                                 <img style="border-radius: 50%; width: 40px; height: 40px;" src="{{ URL::to('public') }}/storage/TDqXf9Gvw8lwGRtZs1LKyz3YikCXVWNzVR6TWmoP.jpeg" alt="User Image">
                                           
                                                <div class="status offline"></div>
                                            </div>
                                            <div class="name">{{ $message->user_from->name }}</div>
                                            <div class="text">
                                                {{ $message->details  }}
                                            </div>
                                            <div class="time">{{ $message->created_at->diffForHumans()  }}</div>
                                        </div>
										@endif
										@endif
                                    @endforeach
									@endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-send">
                    <form>
                        <div class="form-group">
                            <input type="hidden" name="conversation_id" value="{{ $messages->id }}">
                            <input type="hidden" name="with" value="@if(Auth::user()->id == $messages->by) {{ $messages->with }} @elseif(Auth::user()->id == $messages->with) {{ $messages->by }} @endif">
                            <textarea class="form-control" name="message_text" placeholder="اكتب ردا ....." id="chatarea messageTxt" rows="3" spellcheck="true" required=""></textarea>
                            <label><input type="checkbox" value="1" name="press_enter" checked> {{ trans('site.press_to_send') }}</label>
                            <div class="controler-chat">
                               {{-- <label class="custom-file" id="customFile">
                                    <span class="custom-file-control form-control-file"><i class="fa fa-camera" aria-hidden="true"></i></span>
                                    <input type="file" class="custom-file" id="InputFile" aria-describedby="fileHelp">

                                </label>--}}
                                <input type="button" class="cart-button send-btn" value="إرسال" name="send_chat">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@stop
@section ('page_scribt')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".chat").animate({scrollTop: 5000}, 2500);
            //$("#messages_list").animate({ scrollTop: $('#messages_list').prop("scrollHeight")}, 1000);
            function get_messages (id){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url_path = APP_URL+'/account/get_chat_messages';
                var conversation_id = $('input[name=conversation_id]').val();
                $.ajax({
                    url: url_path,
                    type: 'POST',
                    data: {_token: CSRF_TOKEN,conversation_id: conversation_id},
                    dataType: 'JSON',
                    success: function (data) {
                        $("#messages_list").html(data.messages);
                        $(".chat").animate({scrollTop: 5000}, 2000);
                        //$("#messages_list").animate({ scrollTop: $('#messages_list').prop("scrollHeight")}, 1000);
                        $("#conv_"+conversation_id).html(data.last_message);
                        $("span.count").text('عدد الرسائل : '+data.total);
                    }
                });
            }
            setInterval(function(){
                get_messages();
            }, 2000);
        });

        function send_messages (){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var url_path = APP_URL+'/account/send_chat_messages';
            var conversation_id = $('input[name=conversation_id]').val();
            var conversation_with = $('input[name=with]').val();
            var message = $('textarea[name=message_text]').val();
            if(message != ''){
                $.ajax({
                    url: url_path,
                    type: 'POST',
                    data: {_token: CSRF_TOKEN,conversation_id: conversation_id,conversation_with: conversation_with,message: message},
                    dataType: 'JSON',
                    success: function (data) {
                        if(data != 1){
                            $('textarea[name=message_text]').attr('disabled',true);
                        }
                        $('textarea[name=message_text]').val('');
                        $("#messages_list").animate({scrollTop: 0});
                        //$("#messages_list").animate({ scrollTop: $('#messages_list').prop("scrollHeight")}, 1000);
                    }
                });
            }
        }

        $("input[name=send_chat]").click(function(){
            send_messages();
        });

        $('textarea[name=message_text]').keypress(function (e) {
            var press_enter = $('input[name=press_enter]:checked').val();
            if(press_enter == 1){
                if (e.which == 13) {
                    send_messages();
                    return false;
                }
            }else{
                if (e.which == 13) {
                    return false;
                }
            }
        });
    </script>
@stop



