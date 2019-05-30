@foreach($product->productTags as $productTag)
    <div class="media m-t-5">
        <div class="media-body">
            <div class="lgi-text">
                @if(starts_with($productTag->color, 'c-'))
                    <i class="zmdi zmdi-hc-fw zmdi-hc-lg zmdi-{{ str_replace_first('zmdi-', '', $productTag->icon) }} {{ $productTag->color }}"></i>
                @else
                    <i class="zmdi zmdi-hc-fw zmdi-hc-lg zmdi-{{ str_replace_first('zmdi-', '', $productTag->icon) }}" style="color: {{ $productTag->color }}"></i>
                @endif
                {{ $productTag->name }}
            </div>
        </div>
    </div>
@endforeach
