<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'SSO ITK')
<img src="http://sso.itk.ac.id/img/SSOITK.png" class="logo" alt="SSO ITK">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
