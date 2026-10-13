@component('mail::message')
# Registration Approved! 🎉

Congratulations {{ $user->first_name }}!

Your Remote Sales Representative registration has been approved by our team. You're almost ready to start!

**Next Steps:**

1. **Verify Your Email:** Click the button below to verify your email address
2. **Set Your Password:** After email verification, you'll receive a secure link to set your password
3. **Access the Dashboard:** Once verified, you can log in and start managing your sales

@component('mail::button', ['url' => $verificationUrl])
Verify Email Address
@endcomponent

**Verify Email Link (expires in 24 hours):**
{{ $verificationUrl }}

**Important Security Notes:**
- This verification link expires in 24 hours
- Do not share this link with anyone
- Email verification is required before you can access the CRM
- Your password setup link will be sent after verification

If you did not register, please contact support immediately.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
