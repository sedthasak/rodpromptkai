@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }}</h2>
    </div>



    <div class="intro-y box p-5">
        <form method="post" action="{{ route('BN_discounts_edit_action') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $coupon->id }}">

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 xl:col-span-6">
                    <label for="name" class="form-label">ชื่อคูปอง</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $coupon->name) }}" required>
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <label for="code" class="form-label">รหัสคูปอง</label>
                    <input type="text" id="code" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="rate" class="form-label">เปอเซ็นต์ส่วนลด</label>
                    <input type="text" id="rate" name="rate" class="form-control" value="{{ old('rate', $coupon->rate) }}" required>
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="limit_rate" class="form-label">ส่วนลดสูงสุด</label>
                    <input type="text" id="limit_rate" name="limit_rate" class="form-control" value="{{ old('limit_rate', $coupon->limit_rate) }}">
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="limit" class="form-label">จำกัดจำนวนการใช้</label>
                    <input type="text" id="limit" name="limit" class="form-control" value="{{ old('limit', $coupon->limit) }}">
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="expire" class="form-label">วันหมดอายุ</label>
                    <input type="text" id="expire" name="expire" class="form-control" value="{{ old('expire', $coupon->expire) }}">
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="level_member" class="form-label">ผูกกับเลเวลเมมเบอร์</label>
                    <select id="level_member" name="level_member" class="form-control">
                        <option value="">ไม่ผูก</option>
                        <option value="silver" {{ old('level_member', $coupon->level_member) == 'silver' ? 'selected' : '' }}>silver</option>
                        <!-- Add other options as needed -->
                    </select>
                </div>
                <div class="col-span-12 xl:col-span-4">
                    <label for="status" class="form-label">สถานะ</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expire" {{ old('status', $coupon->status) == 'expire' ? 'selected' : '' }}>Expired</option>
                        <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-span-12">
                    <label for="description" class="form-label">รายละเอียด</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $coupon->description) }}</textarea>
                </div>
            </div>

           
        </form>
    </div>
@endsection
