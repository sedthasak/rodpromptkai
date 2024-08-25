@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
    </div>
    <form id="vip-form" method="post" action="{{route('BN_customers_register_vip_action')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$customer->id}}" />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">ชื่อลูกค้า</label>
                                    <input type="text" class="form-control" name="name" value="{{$customer->firstname.' '.$customer->lastname}}" readonly />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">โทรติดต่อ</label>
                                    <input type="text" class="form-control" name="phone" value="{{$customer->phone}}" readonly />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">อีเมล</label>
                                    <input type="text" class="form-control" name="email" value="{{$customer->email}}" readonly />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-8" class="form-label">เลือกแพ็คเกจวีไอพี</label>
                                    <select id="vip-select" class="form-select" name="vip">
                                        <option value="">เลือกแพ็คเกจ</option>
                                        @foreach($vips as $keyvips => $vip)
                                            <option value="{{$vip->id}}">{{$vip->name.' - '.$vip->price}}฿</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                            <div class="col-span-12 mt-8 grid grid-cols-12 gap-6">
                                @foreach($vips as $keyvipsdetail => $vipdetail)
                                <div class="intro-y col-span-12 sm:col-span-6 2xl:col-span-12 vip-detail-box" id="vip-detail-{{$vipdetail->id}}" style="display: none;">
                                    <div class="box p-5">
                                        <div class="flex items-center">
                                            <div class="w-2/4 flex-none">
                                                <div class="truncate text-lg font-medium">{{$vipdetail->name}}</div>
                                                <div class="mt-1 text-slate-500">
                                                    ราคา {{$vipdetail->price}} ฿ || 
                                                    จำกัดจำนวนลงขายรถ {{$vipdetail->limit}} คัน
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                                <div class="mt-3">
                                    <div class="mt-2">
                                        <div data-tw-merge class="flex items-center">

                                            <input data-tw-merge type="checkbox" id="accept_payment" name="accept_payment" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50 w-[38px] h-[24px] p-px rounded-full relative before:w-[20px] before:h-[20px] before:shadow-[1px_1px_3px_rgba(0,0,0,0.25)] before:transition-[margin-left] before:duration-200 before:ease-in-out before:absolute before:inset-y-0 before:my-auto before:rounded-full before:dark:bg-darkmode-600 checked:bg-primary checked:border-primary checked:bg-none before:checked:ml-[14px] before:checked:bg-white w-[38px] h-[24px] p-px rounded-full relative before:w-[20px] before:h-[20px] before:shadow-[1px_1px_3px_rgba(0,0,0,0.25)] before:transition-[margin-left] before:duration-200 before:ease-in-out before:absolute before:inset-y-0 before:my-auto before:rounded-full before:dark:bg-darkmode-600 checked:bg-primary checked:border-primary checked:bg-none before:checked:ml-[14px] before:checked:bg-white" />
                                            <label data-tw-merge for="accept_payment" class="cursor-pointer ml-2">ยืนยันการชำระเงินเต็มจำนวนทันที</label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary ml-auto">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vipSelect = document.getElementById('vip-select');
        const vipDetailBoxes = document.querySelectorAll('.vip-detail-box');
        const form = document.getElementById('vip-form');
        const acceptPaymentCheckbox = document.getElementById('accept_payment');

        vipSelect.addEventListener('change', function () {
            const selectedValue = this.value;

            // Hide all detail boxes
            vipDetailBoxes.forEach(box => box.style.display = 'none');

            // Show the selected detail box
            if (selectedValue) {
                const selectedBox = document.getElementById('vip-detail-' + selectedValue);
                if (selectedBox) {
                    selectedBox.style.display = 'block';
                }
            }
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const selectedVip = vipSelect.value;

            if (!selectedVip) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเลือกแพ็คเกจวีไอพี',
                    text: 'คุณต้องเลือกแพ็คเกจวีไอพีก่อนดำเนินการต่อ!',
                });
            } else if (!acceptPaymentCheckbox.checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณายืนยันการชำระเงิน',
                    text: 'คุณต้องทำการยืนยันการชำระเงินก่อนดำเนินการต่อ!',
                });
            } else {
                Swal.fire({
                    title: 'ยืนยันการส่งข้อมูล?',
                    text: 'โปรดตรวจสอบข้อมูลให้ถูกต้องก่อนดำเนินการ!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ส่งข้อมูล!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // If confirmed, submit the form
                    }
                });
            }
        });
    });
</script>
@endsection
