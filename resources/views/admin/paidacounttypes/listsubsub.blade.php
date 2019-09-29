<option value="0">{{ __('admin.sections_choose_type') }}</option>
@foreach ($subsubsections as $subsub)
	@if($sub_sub_current == $subsub->id)
		<option value="{{ $subsub->id }}" selected>@if(Lang::locale() == 'ar') {{ $subsub->name_ar }} @else {{ $subsub->name_en }} @endif</option>
	@else
		<option value="{{ $subsub->id }}" >@if(Lang::locale() == 'ar') {{ $subsub->name_ar }} @else {{ $subsub->name_en }} @endif</option>
	@endif
@endforeach