@component('mail::message')

{{__('emailcontent.resetPassHello')}}

{!!__('emailcontent.resetPassIntro')!!}


{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }

?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ __('emailcontent.resetPassClickHere') }}
@endcomponent
@endisset

{!!__('emailcontent.resetPassOutro')!!}

{{-- Salutation --}}

{{__('emailcontent.resetPassRegard')}}

{{-- Subcopy --}}
{!!__('emailcontent.resetPassSubcopy')!!} <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>


@endcomponent
