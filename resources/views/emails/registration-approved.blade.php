@component('mail::message')
# Registration Approved

Congratulations {{ $user->first_name }}, your Remote Sales Representative registration has been approved.

To finish setting up your account, please complete both steps below:

1. **Verify your email address**
2. **Set your password**

@component('mail::button', ['url' => $verificationUrl])
Verify Email Address
@endcomponent

@component('mail::button', ['url' => $passwordSetupUrl])
Set Your Password
@endcomponent

**Security notes:**
- The verification link expires in 24 hours.
- The password setup link expires in 48 hours and can only be used once.
- Never share these links with anyone.
- If you did not register with SiteDudes, please ignore this email.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
