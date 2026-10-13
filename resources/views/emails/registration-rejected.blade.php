@component('mail::message')
# Application Status Update

Hello {{ $user->first_name }},

Thank you for applying to be a Remote Sales Representative with SiteDudes. After careful review of your application, we regret to inform you that we are unable to move forward at this time.

@if($reason)
**Reason for Rejection:**
{{ $reason }}
@endif

**What Happens Next:**
- Your application status has been updated to rejected
- You will not be able to access the CRM dashboard
- If you believe this is an error, please contact our support team

**Contact Support:**
If you have any questions or would like to reapply, please reach out to our support team at support@sitedudes.com

We appreciate your interest in joining our team and wish you the best of luck with your future endeavors.

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
