<x-mail::message>
# Event Registration Confirmation
 
Thank you for registering to <strong>{{$attendee->calendarEvent->title}}</strong> event. <br>
Start Date: <strong>{{$attendee->calendarEvent->start_date->format('d/m/Y H:i')}}</strong>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>