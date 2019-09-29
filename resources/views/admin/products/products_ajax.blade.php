@if($products)
    @foreach($products as $product)
        <tr class="odd gradeX">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" name="checkboxes[]" value="{{  $product->id }}" />
                    <span></span>
                </label>
            </td>
            <td>
                @if(Lang::locale() == 'ar')
                    <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">{{ $product->name_ar }} </a>
                @else
                    <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">{{ $product->name_en }} </a>
                @endif
            </td>

            <td>
                @if ($product->image)
                    <img src="{{ URL::to('public') }}{{ $product->image }}" width="100" height="100">
                @endif
            </td>
            <td>{{ $product->price }}</td>
            <td>
                {{ $product->user->name }}
            </td><td>
                {{ $product->mainsection['name_ar'] }}
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> {{ __('admin.the_options_title') }}
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" page="menu">
                        <li>
                            <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}">
                                <i class="icon-folder"></i> {{ __('admin.show_title') }} </a>
                        </li>
                        <li>
                            <a href="{{ URL::to(ADMIN.'/products') }}/{{ $product->id }}/edit">
                                <i class="icon-note"></i> {{ __('admin.editing_title') }} </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@endif