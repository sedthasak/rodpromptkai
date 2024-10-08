<!-- resources/views/backend/components/_customer_navigation.blade.php -->
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="relative before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
            <a href="{{ route('BN_customers_detail', ['id' => $Customer->id]) }}">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-car h-[28px] w-[28px] text-primary"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                    </div>
                    <div class="mt-6 text-3xl font-medium leading-8">โพสท์ขายรถ</div>
                </div>
            </a>
        </div>
    </div>
    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="relative before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
            <a href="{{ route('BN_customers_detail_deal', ['id' => $Customer->id]) }}">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket h-[28px] w-[28px] text-pending"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line></svg>
                    </div>
                    <div class="mt-6 text-3xl font-medium leading-8">ประวัติการสั่งซื้อดีล</div>
                </div>
            </a>
        </div>
    </div>
    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="relative before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
            <a href="{{ route('BN_customers_detail_package', ['id' => $Customer->id]) }}">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card h-[28px] w-[28px] text-pending"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line></svg>
                    </div>
                    <div class="mt-6 text-3xl font-medium leading-8">ประวัติการสั่งซื้อแพ็คเกจ</div>
                </div>
            </a>
        </div>
    </div>
</div>
