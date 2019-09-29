@if( count($brands) != 0 )
	<option value="0">  {{ __('admin.brands_choose') }}</option>
	@foreach ($brands as $s)
			<option value="{{ $s->id }}" @if($brand_id  == $s->id) selected="true" @endif >@if(Lang::locale() == 'ar') {{ $s->name_ar }} @else {{ $s->name_en }} @endif</option>

	@endforeach
@endif


