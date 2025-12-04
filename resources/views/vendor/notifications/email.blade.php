{{--
Custom Email Template for J-Voyage
This template does NOT use x-mail::button to avoid markdown escaping issues
--}}

@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
<h1 style="color: #1f2937; font-size: 22px; font-weight: bold; margin: 0 0 16px 0; text-align: left;">
    @if (!empty($greeting))
        {{ $greeting }}
    @else
        @if ($level === 'error')
            Maaf!
        @else
            Halo!
        @endif
    @endif
</h1>

@foreach ($introLines as $line)
    <p style="color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 16px 0; text-align: left;">{{ $line }}</p>
@endforeach

{{-- Action Button --}}
@isset($actionText)
    @php
        $buttonColor = match ($level) {
            'success' => '#10b981',
            'error' => '#ef4444',
            default => '#818cf8',
        };
    @endphp
    <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="margin: 30px auto; padding: 0; text-align: center; width: 100%;">
        <tr>
            <td align="center">
                <a href="{{ $actionUrl }}" target="_blank" rel="noopener"
                    style="display: inline-block; background-color: {{ $buttonColor }}; border-radius: 8px; color: #ffffff; font-size: 14px; font-weight: 600; padding: 12px 32px; text-decoration: none; font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;">{{ $actionText }}</a>
            </td>
        </tr>
    </table>
@endisset

@foreach ($outroLines as $line)
    <p style="color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 16px 0; text-align: left;">{{ $line }}</p>
@endforeach

{{-- Salutation --}}
<p style="color: #4b5563; font-size: 15px; line-height: 1.6; margin: 24px 0 0 0; text-align: left;">
    @if (!empty($salutation))
        {{ $salutation }}
    @else
        Salam hangat,<br>
        Tim {{ config('app.name') }}
    @endif
</p>

{{-- Subcopy --}}
@isset($actionText)
    @slot('subcopy')
    <p style="font-size: 12px; color: #9ca3af; line-height: 1.5; margin: 0; text-align: left;">
        Jika Anda mengalami kesulitan mengklik tombol "{{ $actionText }}", salin dan tempel URL berikut ke browser Anda: <a
            href="{{ $actionUrl }}" style="color: #818cf8; word-break: break-all;">{{ $displayableActionUrl }}</a>
    </p>
    @endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} J-Voyage. E-Ticket Wisata Jember.
@endcomponent
@endslot
@endcomponent