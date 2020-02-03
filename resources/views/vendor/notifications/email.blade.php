@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {!! $greeting !!}
@else
@if ($level === 'error')
# @lang('email.whoops')
@else
# @lang('email.hello')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{!! $line !!}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
		case 'success':
			$color = 'green';
			break;
		case 'error':
			$color = 'red';
			break;
		default:
			$color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{!! $actionText !!}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{!! $line !!}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{!! $salutation !!}
@else
@lang('email.regards'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    'email.subcopy',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
