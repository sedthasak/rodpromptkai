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
                    <label for="old_price" class="form-label">ราคาฆ่าทิ้ง</label>
                    <input id="old_price" type="number" name="old_price" class="form-control" value="{{ $package->old_price }}" placeholder="">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="label_save" class="form-label">โชว์เปอร์เซ็นพิเศษ</label>
                    <input id="label_save" type="number" name="label_save" class="form-control" value="{{ $package->label_save }}" placeholder="ประหยัด %">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="label_bottom" class="form-label">ข้อความพิเศษ</label>
                    <input id="label_bottom" type="text" name="label_bottom" class="form-control" value="{{ $package->label_bottom }}" placeholder="">
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <label for="limit" class="form-label">ลิมิต</label>
                    <input id="limit" type="number" name="limit" class="form-control" value="{{ $package->limit }}" required>
                </div>

                <!-- New fields for text1 to text6 -->
                <div class="col-span-12 sm:col-span-6">
                    <label for="text1" class="form-label">ข้อความเพิ่มเติม 1</label>
                    <input id="text1" type="text" name="text1" class="form-control" value="{{ $package->text1 }}" placeholder="ข้อความเพิ่มเติม 1">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="text2" class="form-label">ข้อความเพิ่มเติม 2</label>
                    <input id="text2" type="text" name="text2" class="form-control" value="{{ $package->text2 }}" placeholder="ข้อความเพิ่มเติม 2">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="text3" class="form-label">ข้อความเพิ่มเติม 3</label>
                    <input id="text3" type="text" name="text3" class="form-control" value="{{ $package->text3 }}" placeholder="ข้อความเพิ่มเติม 3">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="text4" class="form-label">ข้อความเพิ่มเติม 4</label>
                    <input id="text4" type="text" name="text4" class="form-control" value="{{ $package->text4 }}" placeholder="ข้อความเพิ่มเติม 4">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="text5" class="form-label">ข้อความเพิ่มเติม 5</label>
                    <input id="text5" type="text" name="text5" class="form-control" value="{{ $package->text5 }}" placeholder="ข้อความเพิ่มเติม 5">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="text6" class="form-label">ข้อความเพิ่มเติม 6</label>
                    <input id="text6" type="text" name="text6" class="form-control" value="{{ $package->text6 }}" placeholder="ข้อความเพิ่มเติม 6">
                </div>
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
