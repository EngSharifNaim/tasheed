@foreach($section->has_sub as $sub )
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="category[]" value="{{ $sub->id }} ">@if(Lang::locale() == 'ar' ) {{ $sub->name_ar }} @else {{ $sub->name_en }} @endif
        </label>
    </div>
    @foreach($sub->subsections as $sub_sub )
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="subcategory[]" value="{{ $sub_sub->id }} ">@if(Lang::locale() == 'ar' ) {{ $sub_sub->name_ar }} @else {{ $sub_sub->name_en }} @endif
            </label>
        </div>
    @endforeach
@endforeach