@extends('layouts.app')

@section('content')

@if(Auth::user()->confirmed==1)
@include('reserved_notification');

@else 
<style>
body {
    background: linear-gradient(to bottom right, #243244, #3B2F26);
    color: #ffffff;
    font-family: 'Cairo', sans-serif;
    direction: rtl;
}

.card {
    background-color: rgba(0,0,0,0.7);
    padding: 2rem;
    border-radius: 15px;
    margin-top: 50px;
}

.card h3 {
    color: #ffc107;
    text-align: center;
    margin-bottom: 1.5rem;
}

label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    display: block;
    color: white;
}

select, .form-control {
    background-color: rgba(255,255,255,0.1);
    border: 1px solid #ffffff;
    color: #ffffff;
    padding: 8px;
    border-radius: 8px;
}

option {
    color: black;
}

/* ✅ Room status color tags */
.status-available {
    color: #28a745;
    font-weight: bold;
}

.status-pending {
    color: #ffc107;
    font-weight: bold;
}

.status-confirmed {
    color: #dc3545;
    font-weight: bold;
}

.btn-custom {
    background-color: #ffc107;
    color: #243244;
    font-weight: bold;
    padding: 10px;
    border-radius: 10px;
}

.btn-custom:hover {
    background-color: #e6b800;
    color: #121212;
}

.room-info {
    font-size: 0.9rem;
    color: #ccc;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <h3>🏠 حجز غرفة - جامعة بورسعيد</h3>
                <form method="POST" action="{{ url('rooms/select') }}">
                    @csrf

                    <!-- ✅ الأولوية الأولى -->
                    <div class="mb-3">
                        <label for="priority1">الأولوية الأولى</label>
                        <select name="priority_one" id="priority1" class="form-select" required>
                            <option value="">-- اختر غرفة --</option>
                            @foreach($rooms as $room)
                                @php
                                    $statusClass = match($room->status) {
                                        'confirmed' => 'status-confirmed',
                                        'pending' => 'status-pending',
                                        default => 'status-available'
                                    };
                                    $statusText = match($room->status) {
                                        'confirmed' => 'مؤكدة',
                                        'pending' => 'انتظار',
                                        default => 'متاحة'
                                    };
                                @endphp
                             <option value="{{ $room->id }}"
                                    data-confirmed="{{ $room->confirmed_count ?? 0 }}"
                                    data-pending="{{ $room->pending_count ?? 0 }}"
                                    data-capacity="{{ $room->capacity }}">
                                    🏠 {{ $room->room_id }} -
                                    <span class="{{ $statusClass }}">الحالة: {{ $statusText }}</span> |
                                    ✅ مؤكد: {{ $room->confirmed_count ?? 0 }} |
                                    ⏳ انتظار: {{ $room->pending_count ?? 0 }} |
                                    👥 السعة: {{ $room->capacity }}
                                </option>

                            @endforeach
                        </select>
                        <small style="color:#bbb;">لو اخترت غرفة (متاحة)، مش هتحتاج تختار أولوية ثانية.</small>
                    </div>

                    <!-- ✅ الأولوية الثانية -->
                    <div class="mb-3" id="priority2-container" style="display:none;">
                        <label for="priority2">الأولوية الثانية</label>
                        <select name="priority_two" id="priority2" class="form-select">
                            <option value="">-- اختر غرفة --</option>
                            @foreach($erooms as $room)
                                @php
                                    $statusClass = match($room->status) {
                                        'confirmed' => 'status-confirmed',
                                        'pending' => 'status-pending',
                                        default => 'status-available'
                                    };
                                    $statusText = match($room->status) {
                                        'confirmed' => 'مؤكدة',
                                        'pending' => 'انتظار',
                                        default => 'متاحة'
                                    };
                                @endphp
                                <option value="{{ $room->id }}">
                                    🏠 {{ $room->room_id }} -
                                    <span class="{{ $statusClass }}">الحالة: {{ $statusText }}</span> |
                                    ✅ مؤكد: {{ $room->confirmed_count ?? 0 }} |
                                    ⏳ انتظار: {{ $room->pending_count ?? 0 }} |
                                    👥 السعة: {{ $room->capacity }}
                                </option>
                            @endforeach
                        </select>
                        <small style="color:#bbb;">الأولوية الثانية إلزامية فقط لو اخترت (انتظار) في الأولوية الأولى.</small>
                    </div>

                    <!-- ✅ طريقة الدفع -->
                    <div class="mb-3">
                        <label for="payment">طريقة الدفع</label>
                        <select name="payment_type" id="payment" class="form-select" required>
                            <option value="">-- اختر طريقة الدفع --</option>
                            <option value="visa">فيزا</option>
                            <option value="cash">كاش</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">تأكيد الحجز</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const priority1 = document.getElementById('priority1');
    const priority2Container = document.getElementById('priority2-container');
    const priority2 = document.getElementById('priority2');

    priority1.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const selectedRoomId = selectedOption.value;

        const confirmed = parseInt(selectedOption.getAttribute('data-confirmed')) || 0;
        const pending = parseInt(selectedOption.getAttribute('data-pending')) || 0;
        const capacity = parseInt(selectedOption.getAttribute('data-capacity')) || 0;

        // ✅ Logic for showing Priority 2
        if ((confirmed + pending >= capacity) && (confirmed < capacity)) {
            priority2Container.style.display = 'block';
            priority2.setAttribute('required', 'required');
        } else {
            priority2Container.style.display = 'none';
            priority2.removeAttribute('required');
            priority2.value = ''; // reset selection
        }

        // ✅ Hide the same room in Priority 2 list
        Array.from(priority2.options).forEach(opt => {
            opt.disabled = (opt.value === selectedRoomId);
            opt.style.display = opt.disabled ? 'none' : 'block';
        });
    });
});
</script>




@endif
@endsection
