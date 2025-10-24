@component('mail::message')
# Registration Successful 🎉

Dear Student,

Your registration has been successfully completed.

@component('mail::panel')
**Student Code:** {{ $student_id }}
@endcomponent

You can now log in to your account and:
- Select one **available room** in Priority 1, or  
- One **pending** room in Priority 1 and **available** in Priority 2.

After confirming, you **cannot change your selections**.

@component('mail::button', ['url' => url('/show/login')])
Sign In Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
