<tr>
<td class="header">
<a href="{{ config('app.url') }}" style="display: inline-block; text-decoration: none;">
@if (trim($slot) === 'Laravel' || trim($slot) === config('app.name'))
LEBAR
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
