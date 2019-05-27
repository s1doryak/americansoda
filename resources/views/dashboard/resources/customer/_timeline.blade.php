<div class="timeline-container">
    <h3>Timeline</h3>
    <div class="timeline">
        @foreach ($revisions as $created_at => $items)
            @if (isset($items['policies']) && count($items['policies']))
                @php($first = reset($items['policies']))
                @include('dashboard::resources.customers.timeline.view', [
                    'isPolicy' => true,
                    'policies' => $items['policies'],
                    'revisionType' => $first->revision_type,
                    'editorName' => $first->editor ? $first->editor->name : '(Anonymous)',
                    'createdDate' => format_date($first->created_at),
                ])
            @endif
        
            @if (isset($items['customers']))
                @foreach ($items['customers'] as $customer)
                    @if(count($customer->getChangedAttributes()))
                        @include('dashboard::resources.customers.timeline.view', [
                            'isPolicy' => false,
                            'revisionType' => $customer->revision_type,
                            'customer' => $customer,
                            'editorName' => $customer->editor ? $customer->editor->name : '(Anonymous)',
                            'createdDate' => format_date($customer->created_at),
                        ])
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
</div>