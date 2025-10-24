@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #121212; /* خلفية سوداء */
        color: #f1f1f1;
        font-family: 'Cairo', sans-serif;
        position: relative;
        /* overflow: hidden; */
    }

    /* نجوم أكثر */
body::before {
    content: "";
    position: fixed; /* أفضل للصفحة الطويلة */
    top: 0; 
    left: 0;
    width: 100%; 
    height: 100%;
    background-image: url('{{ asset("storage/port.jpg") }}');
    background-size: cover; /* تجعل الصورة تغطي كامل الصفحة */
    background-repeat: no-repeat; /* تمنع التكرار */
    background-position: center center; /* تمركز الصورة */
    opacity: 0.4; /* شفافية أكثر */
    z-index: -1;
}


.card {
    /* تدرج بين الأزرق الداكن والبني الغامق */
    background: linear-gradient(to bottom right, #243244, #3B2F26);
    color: #ffffff; /* النصوص بيضاء */
    border: 1px solid #333;
    direction: rtl; /* محاذاة عربية */
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    border-radius: 15px;
}

.card-header {
    background-color: rgba(255, 255, 255, 0.1); /* شفاف أبيض خفيف */
    color: #ffffff;
    font-weight: bold;
    text-align: center;
}

.form-label {
    color: #ffffff; /* عناوين الحقول باللون الأبيض */
    font-weight: bold;
    text-align: right;
    display: block;
}

small {
    color: #cccccc; /* النصوص الصغيرة لون فاتح */
    font-size: 0.85rem;
    display: block;
    text-align: right;
}

.form-control {
    background-color: rgba(255,255,255,0.1); /* خلفية فاتحة شفاف للحقل */
    border: 1px solid #ffffff;
    color: #ffffff; /* نصوص الحقول باللون الأبيض */
}

.form-control::placeholder {
    color: #dddddd; /* placeholder باللون الفاتح */
}

.btn-custom {
    background-color: #ffffff;
    color: #243244; /* نص الزر أزرق داكن */
    font-weight: bold;
}

.btn-custom:hover {
    background-color: #f0f0f0;
    color: #243244;
}

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg rounded-4">
                <div class="card-header">
                    <h4>📝 تسجيل طالب - جامعة بورسعيد</h4>
                </div>
                <div class="card-body">
                    <form action="/register" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- الاسم -->
                        <div class="mb-3">
                            <label class="form-label">الاسم رباعي</label>
                            <input type="text" name="name" class="form-control" required>
                            <small>يجب إدخال الاسم كاملًا مكون من 4 مقاطع.</small>
                        </div>

                        <!-- الهاتف -->
                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                            <small>سيتم التواصل معك من خلال هذا البريد لإرسال التحديثات والإشعارات.</small>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                            <small>يجب أن تكون كلمة المرور قوية (تتضمن حروف كبيرة وصغيرة وأرقام ورموز).</small>
                        </div>

                        <!-- صورة البطاقة -->
                        <div class="mb-3">
                            <label class="form-label">صورة بطاقة الطالب</label>
                            <input type="file" name="id_image" class="form-control" required>
                        </div>

                        <!-- تقرير إثبات -->
                        <div class="mb-3">
                            <label class="form-label"> إفادة التحاق ب جامعة بورسعيد</label>
                            <input type="file" name="verification_report" class="form-control" required>
                        </div>

                        <!-- المدينة -->
                        <div class="mb-3">
                            <label class="form-label">المدينة / محل الإقامة</label>
                            <input type="text" name="home_city" class="form-control" required>
                        </div>

                        <!-- سنة الدراسة -->
                        <div class="mb-3">
                            <label class="form-label">عدد سنوات الدراسة</label>
                            <select name="school_year" class="form-select" required>
                                <option value="">-- اختر عدد السنوات --</option>
                                 <option value="1">سنة</option>
                                <option value="2">سنتان</option>
                                <option value="3">ثلاث سنوات</option>
                                <option value="4">أربع سنوات</option>
                                <option value="5">خمس سنوات</option>
                            </select>
                        </div>

                        <!-- زر -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-custom">تسجيل</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">
                        لديك حساب بالفعل؟ <a href="/show/login" class="text-warning">سجّل الدخول هنا</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
