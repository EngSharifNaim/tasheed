@extends('layouts.cp')
@section('page_title')
{{ __('site.personal_data') }}
@stop
@section('content')
            <div class="col-lg-9 content-copouns">
                <div class="">
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
                    <form method="post" action="{{ url('/save-user-data') }}/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row margin-edite">
                            <div class="col">
                                <label class="editeprofile-lable">{{ __('site.first_name') }}<span style="color: red;">*</span>  </label>
                                <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" placeholder="{{ __('site.first_name') }}">
                            </div>
                            <div class="col">
                                <label class="editeprofile-lable">{{ __('site.last_name') }} <span style="color: red;">*</span>  </label>
                                <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" placeholder="{{ __('site.last_name') }}">
                            </div>
                        </div>
                        <div class="row margin-edite">
                            <div class="col">
                                <label class="editeprofile-lable" for="full_name">{{ __('site.full_name') }}</label>
                                <input type="text" name="full_name"  id="full_name"  class="form-control " value="{{ Auth::user()->name }}" placeholder="{{ __('site.full_name') }}">
                            </div>
						</div>
                        <div class="row margin-edite">
                            <fieldset disabled>
                                <div class="col">
                                    <label class="editeprofile-lable" for="disabledTextInput">{{ __('site.current_email') }} </label>
                                    <input type="text" id="disabledTextInput" class="form-control disable-form" placeholder="{{ Auth::user()->email }}">
                                </div>
                            </fieldset>
                          {{--  <div class="col custom-field">
                                <label class="editeprofile-lable">{{ __('site.new_email') }}<span style="color: red;">*</span>  </label>
                                <input type="email" name="email" class="form-control" placeholder="{{ __('site.new_email') }}">
                            </div>--}}
                        </div>
						@if(Auth::user()->level != 'user' )
						<div class="margin-edite">
                            @if (Auth::user()->photo)
                                <img src="{{ URL::to('public') }}{{ Auth::user()->photo }}" width="150" height="150">
                            @endif
                            <fieldset >
                                <div class="">
                                    <label class="editeprofile-lable" for="photo">{{ __('site.register_photo') }}</label>
                                    <input type="file" name="photo"  id="photo"  class="form-control " placeholder="{{ __('site.register_photo') }}">
                                </div>
                            </fieldset>
						</div>
						@endif
                            <div class="row margin-edite">
                                <div class="col">
                                    <label class="editeprofile-lable" for="phone">{{ __('site.contact_mobile') }}</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" id="phone"  class="form-control " placeholder="{{ __('site.contact_mobile') }}">
                                </div>
							</div> 
							@if(Auth::user()->level != 'user' )
							<div class="row margin-edite">
                                <div class="col">
                                    <label class="editeprofile-lable" for="describtion">الوصف</label>
                                  
                          
                                <textarea style="min-height:120px;" name="describtion" type="text" class="form-control " placeholder="الوصف "> {{ Auth::user()->describtion }} </textarea>
                          
                      </div>
							</div>
							@endif
						
					<input type="hidden" name="sitepercetage" value="0" >
						<div class="margin-edite">
						<fieldset >
                                <div class="">
                                    <label class="editeprofile-lable" for="password">{{ __('site.change_password') }}</label>
                                    <input type="password" name="password"  id="password"  class="form-control " placeholder="{{ __('site.change_password') }}">
                                </div>
                            </fieldset>
						</div>
                            <button class="btn svae-form btn-primary " type="submit">{{ __('site.save') }}</button>
                    </form>
                </div>
            </div>
</div></div>
@stop



