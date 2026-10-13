@component('mail::message')
# New Remote Sales Registration

A new applicant has submitted their registration for review.

**Applicant Details:**
- **Name:** {{ $user->first_name }} {{ $user->last_name }}
- **Email:** {{ $user->email }}
- **Phone:** {{ $user->phone }}
- **Submitted:** {{ $user->created_at->format('F j, Y \a\t g:i A') }}

**Status:** Pending Review

@component('mail::button', ['url' => $approvalUrl])
Review Applications
@endcomponent

Please review this application and provide approval or rejection feedback.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
