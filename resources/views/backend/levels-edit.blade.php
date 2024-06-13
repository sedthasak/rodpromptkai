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
        <form method="post" action="{{ route('BN_levels_edit_action') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $level->id }}">
            
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 xl:col-span-6">
                    <label for="name" class="form-label">ชื่อระดับ</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $level->name) }}" required>
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <label for="accumulate" class="form-label">ค่าสะสม</label>
                    <input type="text" id="accumulate" name="accumulate" class="form-control" value="{{ old('accumulate', $level->accumulate) }}" required>
                </div>
            </div>

            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
@endsection
