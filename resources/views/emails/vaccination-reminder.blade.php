@component('mail::message')
# Introduction

Hello {{ $registration['user']['name'] }},

This is a reminder that you have a vaccination appointment scheduled for {{ $registration['scheduled_date'] }}.

Please arrive at least 15 minutes before your scheduled appointment time.

Thank you for your cooperation,<br>
{{ config('app.name') }}
@endcomponent
