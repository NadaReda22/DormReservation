@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #121212;
        color: #f1f1f1;
        font-family: 'Cairo', sans-serif;
        position: relative;
    }

    /* خلفية صورة + نجوم */
    body::before {
        content: "";
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%; 
        height: 100%;
        background-image: url('{{ asset("storage/port.jpg") }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        opacity: 0.4;
        z-index: -1;
    }

    /* تصميم الفورم */
    .card {
        background: linear-gradient(to bottom right, #243244, #3B2F26);
        color: #ffffff;
        border: 1px solid #333;
        direction: rtl;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        border-radius: 15px;
    }

    .card-header {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-weight: bold;
        text-align: center;
    }

    .form-label {
        color: #ffffff;
        font-weight: bold;
        text-align: right;
        display: block;
    }

    .form-control {
        background-color: rgba(255,255,255,0.1);
        border: 1px solid #ffffff;
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #dddddd;
    }

    .btn-custom {
        background-color: #ffffff;
        color: #243244;
        font-weight: bold;
    }

    .btn-custom:hover {
        background-color: #f0f0f0;
        color: #243244;
    }

    small {
        color: #cccccc;
        font-size: 0.85rem;
        display: block;
        text-align: right;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header">
                    <h4>🔑 تسجيل الدخول - جامعة بورسعيد</h4>
                </div>
                <div class="card-body">
                    <form action="/login" method="POST">
                        @csrf

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- كود الطالب -->
                        <div class="mb-3">
                            <label class="form-label">كود الطالب</label>
                            <input type="text" name="student_id" class="form-control" required>
                            <small>يمكنك العثور على الكود في البريد الإلكتروني الذي تم إرساله بعد التسجيل.</small>
                        </div>

                        <!-- زر تسجيل الدخول -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-custom">دخول</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        ليس لديك حساب؟ <a href="/show/register" class="text-warning">سجّل هنا</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
