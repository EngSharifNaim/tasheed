@if(Cart::count() > 0)
    <?php $i = 0 ; ?>
@foreach(Cart::content() as $key=>$row)
    <?php $i++ ; ?>
    @if($i === 5 ) @break @endif
<div class="cart-item clearfix">
    <div  aria-labelledby="dropdownMenuButton">
        <div class="pic-item">
            <img src="{{ URL::to('public') }}{{$row->model->image}}" class="img-fluid">
        </div>
        <div class="text-item">
            <h3>@if(Lang::locale() == 'ar') {{ $row->model->name_ar }} @else {{ $row->model->name_ar }} @endif</h3>
            <P>@if($row->model->min_price > 0 ) {{ $row->model->min_price }} @else {{$row->model->price}} @endif </P>
         {{--   <a href="{{ url('/cart') }}" class="btn-info btn-sm"> {{ __('site.go_to_cart') }} </a>
       --}} </div>
    </div>
</div>
@endforeach
<footer><a href="{{ url('/cart') }}"> {{ __('site.go_to_cart') }}</a></footer>
@else
<footer><a class="active">{{ __('site.no_product') }}</a></footer>
@endif
<script type="text/javascript" >
    $(document).ready(function () {
        $(".cart_notf").text('{{ Cart::count()   }}') ;
    })
</script>
