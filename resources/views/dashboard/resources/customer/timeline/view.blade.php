<div class="t-view {{ $revisionType }}">
    <div class="tv-header media">
        <div class="media-body p-t-5">
            <strong class="d-block">{{ $editorName }}</strong>
            <small class="c-gray">
                @lang($revisionType . ' on') {{ $createdDate }}
            </small>
        </div>
    </div>
    <div class="tv-body">
        @if ($isPolicy)
            @include('dashboard::resources.customers.timeline.policies', compact('revisions'))
        @else
            @include('dashboard::resources.customers.timeline.customer', compact('revision'))
        @endif
    </div>
</div>