@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
                <table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                    <tr>
                        <td align="{{ $align }}">

                                               <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
            <td align="{{ $align }}">
        <a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener" style="display: inline-block; background-color: #818cf8; border-radius: 8px; color: #ffffff !important; font-size: 14px; font-weight: 600; padding: 12px 32px; text-decoration: none; font-family: 'Poppins', sans-serif;">{!! $slot !!}</a>
    </td>
</tr>
</table>
</td>
</tr>
</table>
