@component('mail::message')
# 🏠 Room Selection Confirmed

Dear {{ $student->name ?? 'Student' }},

Congratulations! 🎉  
You have successfully **confirmed your room selection**.

@component('mail::panel')
**Room Details:**  
Room Number: **{{ $room->room_id ?? 'N/A' }}**  
Building: **{{ $room->building ?? 'Main Dormitory' }}**  
Priority: **{{ $room->priority ?? '1' }}**
@endcomponent

Please note:
- Once you confirm a room, you **cannot change your selection**.
- If your room was pending in Priority 1 but available in Priority 2, it’s now officially **reserved** for you.
- Make sure to check in on the assigned date to keep your reservation active.

@component('mail::button', ['url' => url('/login')])
Login to Your Account
@endcomponent

If you have any issues or questions, please contact the Dorm Administration.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
