<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'SSO ITK')
<img src="img/SSOITK.png" class="logo" alt="SSO ITK">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
