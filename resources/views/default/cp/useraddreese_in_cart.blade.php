@if(count(Auth::user()->users_addresse) > 0 )
@foreach(Auth::user()->users_addresse as $key=>$addresse )
    <div class="col-lg-4" style="padding-top:5px;">
        <div class="header-customer">
            <h4 class="head-log">{{ __('site.contact_address') }}  {{ $key +1  }}</h4>
            @if(count(Auth::user()->users_addresse) > 1 && $addresse->active != 'yes' )  <a href="javascript:void(0)" class="delete_addresse" data-delete_addresse_id="{{ $addresse->id }}"><i class="fas fa-trash-alt edite-data"> </i></a>@endif
            <i data-toggle="modal" data-target="#Modal" data-whatever="@mdo" class="fas fa-pencil-alt edite-data"></i>
        </div>
        <div class="inner-data">
            <p class="user-data"> <i class="fas fa-id-card"></i> {{ Auth::user()->name }}</p>
            <p class="user-data">
                <i class="fas fa-map-marker"></i>@if(Lang::locale() =='ar') {{ $addresse->addresse_ar }} @else {{ $addresse->addresse_en }} @endif <br>
                @if($addresse->region_id > 0 )@if(Lang::locale() =='ar')  {{ $addresse->region->name_ar }} @else {{ $addresse->region->name_en }} @endif  @endif
                <br>  - @if(Lang::locale() =='ar') {{ $addresse->citie->name_ar }} @else {{ $addresse->citie->name_en }} @endif<br> @if(Lang::locale() =='ar'){{  $addresse->countrie->name_ar }}@else {{  $addresse->countrie->name_ar }} @endif
            </p>  <hr>
            <p class="user-data"> <i class="fas fa-phone"></i> {{ Auth::user()->phone }}</p>
            <button type="button" name="use_this_addresse" data-active_addresse_id="{{ $addresse->id }}" class="btn btn-warning @if($addresse->active == 'yes') address-btn @else address-btn-second @endif">@if($addresse->active == 'yes') {{ __('site.active_addresse') }}@else {{ __('site.use_this_addresse') }}@endif</button>
        </div>
    </div>
@endforeach
@else
    {{ __('site.no_addresse_yet') }}
@endif