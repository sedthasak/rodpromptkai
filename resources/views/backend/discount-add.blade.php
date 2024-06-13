@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
// echo "<pre>";
// print_r($page_name);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <!-- <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_categories')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div> -->
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('BN_discounts_add_action') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">ชื่อคูปอง</label>
                                    <input type="text" class="form-control w-full" name="name" value="{{ old('name') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="code" class="form-label">รหัสคูปอง</label>
                                    <input type="text" class="form-control w-full" name="code" value="{{ old('code') }}" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3">
                                    <label for="rate" class="form-label">เปอร์เซ็นต์ส่วนลด</label>
                                    <input type="text" class="form-control w-full" name="rate" value="{{ old('rate') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3">
                                    <label for="limit_rate" class="form-label">ส่วนลดสูงสุด</label>
                                    <input type="text" class="form-control w-full" name="limit_rate" value="{{ old('limit_rate') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3">
                                    <label for="limit" class="form-label">จำกัดจำนวนการใช้</label>
                                    <input type="text" class="form-control w-full" name="limit" value="{{ old('limit') }}" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3">
                                    <label for="expire" class="form-label">วันหมดอายุ</label>
                                    <input type="date" class="form-control w-full" name="expire" value="{{ old('expire') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3">
                                    <label for="level_member" class="form-label">ผูกกับเลเวลเมมเบอร์</label>
                                    <select name="level_member" id="level_member" class="form-control w-full">
                                        <option value="">ไม่ผูก</option>
                                        <option value="1" {{ old('level_member') == '1' ? 'selected' : '' }}>silver</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <div class="mt-3">
                                    <label for="description" class="form-label">รายละเอียด</label>
                                    <textarea class="form-control w-full" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </form>




@endsection

@section('script')
<script>

</script>


@endsection