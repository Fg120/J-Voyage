<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
</head>
<body style="box-sizing: border-box; font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #818cf8; color: #4a5568; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">

<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #818cf8; margin: 0; padding: 0; width: 100%;">
<tr>
<td align="center">
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0; padding: 0; width: 100%;">

{!! $header ?? '' !!}

<tr>
<td width="100%" cellpadding="0" cellspacing="0" style="background-color: #818cf8; margin: 0; padding: 0; width: 100%; border: hidden !important;">
<table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin: 0 auto; padding: 0; width: 570px;">
<tr>
<td style="max-width: 100vw; padding: 32px;">
{!! $slot !!}

{!! $subcopy ?? '' !!}
</td>
</tr>
</table>
</td>
</tr>

{!! $footer ?? '' !!}
</table>
</td>
</tr>
</table>
</body>
</html>