@extends('layouts.app')

@section('content')
<style>
body {
    background: linear-gradient(to bottom right, #243244, #3B2F26);
    color: #ffffff;
    font-family: 'Cairo', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background-color: rgba(0,0,0,0.7);
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
}

.card h3 {
    color: #ffc107;
    margin-bottom: 1rem;
}

.card p {
    font-size: 1.1rem;
     color: #e7e7e7ff;
}
</style>

<div class="card">
    <h3>✅ ! تم تسجيلك بنجاح</h3>
    <p>
        سيتم إرسال <strong>كود الطالب</strong> إلى بريدك الإلكتروني قريبًا.<br>
        بعد موافقة الإدارة على إثباتك، ستتمكن من اختيار الغرفة المتاحة.
    </p>
    <a href="/show/login" class="btn btn-custom mt-3" style="background-color:#ffc107;color:#243244;">تسجيل الدخول</a>
</div>
@endsection
