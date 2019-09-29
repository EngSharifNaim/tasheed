<option value="0">{{ __('admin.city_choose') }}</option>
@foreach ($cities as $citie)
    @if($current == $citie->id)
        <option value="{{ $citie->id }}" selected>@if(Lang::locale() == 'ar') {{ $citie->name_ar }} @else {{ $citie->name_ar }} @endif</option>
    @else
        <option value="{{ $citie->id }}" >@if(Lang::locale() == 'ar'){{ $citie->name_ar }} @else {{ $citie->name_ar }} @endif</option>
    @endif
@endforeach
@if($current_region)
@section('page_scribt')
    <script type="text/javascript">
        $(document).ready(function(){
            var city = $("select[name=citie_id] :selected").val(); alert(city) ;
            var current_region = parseInt("{{ $current_region }}");
            if(city != 0){
                $.post( "{{url('/regions_list')}}", { citie: city,current: current_region })
                    .done(function( data ) {
                        $('select[name=region_id]').html(data);
                    });
            }
        });
    </script>
    @stop
@endif