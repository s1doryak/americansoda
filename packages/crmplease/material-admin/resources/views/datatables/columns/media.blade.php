<div class="media">
    @if($image)
        <div class="pull-left lightbox">
            <div data-src="{{ $image }}">
                <img src="{{ $thumbnail ?? $image }}" alt="{{ $title }}" class="lgi-img">
            </div>
        </div>
    @endif
    <div class="media-body">
        <div class="lgi-heading">
            {!! $title !!}
        </div>
        <div class="lgi-text">
            {!! $subtitle !!}
        </div>
    </div>
</div>
