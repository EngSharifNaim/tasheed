@if( count($sections) != 0 )
	<option value="0">{{ __('admin.sections_choose_type') }}</option>
	@foreach ($sections as $s)
		@if($current == $s->id)
			<option value="{{ $s->id }}" selected>@if(Lang::locale() == 'ar') {{ $s->name_ar }} @else {{ $s->name_en }} @endif</option>
		@else
			<option value="{{ $s->id }}" >@if(Lang::locale() == 'ar') {{ $s->name_ar }} @else {{ $s->name_en }} @endif</option>
		@endif
	@endforeach
@endif


