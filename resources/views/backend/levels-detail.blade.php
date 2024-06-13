@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }}</h2>
    </div>

    {{-- Display validation errors if any --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="intro-y box p-5">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 xl:col-span-6">
                <label class="form-label">ID</label>
                <p>{{ $level->id }}</p>
            </div>
            <div class="col-span-12 xl:col-span-6">
                <label class="form-label">ชื่อระดับ</label>
                <p>{{ $level->name }}</p>
            </div>
            <div class="col-span-12 xl:col-span-6">
                <label class="form-label">ค่าสะสม</label>
                <p>{{ $level->accumulate }}</p>
            </div>
            <!-- Add more fields as needed -->

            {{-- Example: Display created_at and updated_at --}}
            <div class="col-span-12 xl:col-span-6">
                <label class="form-label">วันที่สร้าง</label>
                <p>{{ $level->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="col-span-12 xl:col-span-6">
                <label class="form-label">วันที่แก้ไขล่าสุด</label>
                <p>{{ $level->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
@endsection
