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
    color: #a3a728ff;
    margin-bottom: 1rem;
}

.card p {
       color: #efefedff;
    font-size: 1.1rem;
}
</style>

<div class="card">
    <h3>✅! تم اختيار الغرفة بنجاح</h3>
    <p>
        الغرفة الخاصة بك الآن في حالة <strong>انتظار التأكيد</strong><br>
        .يرجى إتمام الدفع نقدًا لتأكيد الحجز واستلام بطاقة السكن
    </p>
    <a href="{{route('selection.success')}}" class="btn btn-custom mt-3" style="background-color:#ffc107;color:#243244;">العودة لصفحة الغرف</a>
</div>
@endsection
