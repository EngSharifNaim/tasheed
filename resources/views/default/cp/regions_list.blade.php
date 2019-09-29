@foreach ($regions as $region)
    @if($current == $region->id)
        <option value="{{ $region->id }}" selected>@if(Lang::locale() == 'ar') {{ $region->name_ar }} @else {{ $region->name_en }} @endif</option>
    @else
        <option value="{{ $region->id }}" >@if(Lang::locale() == 'ar') {{ $region->name_ar }}@else  {{ $region->name_en }} @endif</option>
    @endif
@endforeach