@component('mail::message')
# Hello, {{ $mailInfo->f_name }}

<p><strong> Username: </strong>{{ $mailInfo->username }}</p>
<p><strong> Password: </strong>{{ $mailInfo->password }}

Thanks<br>

@endcomponent
