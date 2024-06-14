@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }} {{ $packageType }}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <!-- Add any additional buttons or links here -->
        </div>
    </div>

    <div class="intro-y col-span-12 mt-5">
        <form action="{{ route('BN_packages_edit_action') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="{{ strtolower($packageType) }}">
            <input type="hidden" name="id" value="{{ $package->id }}">
            
            <!-- Example fields, adjust as per your package schema -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6">
                    <label for="name" class="form-label">ชื่อแพ็คเกจ</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ $package->name }}" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="price" class="form-label">ราคาจริง</label>
                    <input id="price" type="number" name="price" class="form-control" value="{{ $package->price }}" required>
                </div>


                <div class="col-span-12 sm:col-span-6">
                    <label for="price" class="form-label">ราคาฆ่าทิ้ง</label>
                    <input id="price" type="number" name="old_price" class="form-control" value="{{ $package->old_price }}" placeholder="" >
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="price" class="form-label">โชว์เปอร์เซ็นพิเศษ</label>
                    <input id="price" type="number" name="label_save" class="form-control" value="{{ $package->label_save }}" placeholder="ประหยัด %" >
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="price" class="form-label">ข้อความพิเศษ</label>
                    <input id="text" type="text" name="label_bottom" class="form-control" value="{{ $package->label_bottom }}" placeholder="" >
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <label for="limit" class="form-label">ลิมิต</label>
                    <input id="limit" type="number" name="limit" class="form-control" value="{{ $package->limit }}" required>
                </div>
                <!-- Add more fields as per your package schema -->
            </div>

            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <!-- Additional scripts can be added here if necessary -->
@endsection
