@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - Orders List</title>
@endsection

@section('subcontent')
<div class="lg:flex intro-y mt-5 mb-5">

    <!-- Search Input -->
    <div class="relative">
        <input type="text" name="keyword" id="keyword" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="เบอร์ / ชื่อ /นามสกุล ลูกค้า..." value="{{ request()->input('keyword') }}" onkeypress="handleEnter(event)">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-lucide="search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>

    <!-- Status Select Filter -->
    <select id="status" name="status" onchange="applyFilters()" class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
        <option value="">ทุกสถานะ&emsp;&emsp;</option>
        @foreach ($statuses as $option)
            <option value="{{ $option->status }}" @if(request()->input('status') == $option->status) selected @endif>{{ ucfirst($option->status) }}&emsp;&emsp;</option>
        @endforeach
    </select>

    <!-- Type Select Filter -->
    <select id="type" name="type" onchange="applyFilters()" class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-4">
        <option value="">ทุกประเภท&emsp;&emsp;</option>
        @foreach ($types as $option)
            <option value="{{ $option->type }}" @if(request()->input('type') == $option->type) selected @endif>{{ ucfirst($option->type) }}&emsp;&emsp;</option>
        @endforeach
    </select>
</div>

<!-- Order Table -->
<div class="intro-y box mt-5">
    <div class="p-5">
        <table class="table table-report mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Order Number</th>
                    <th class="text-center whitespace-nowrap">Customer Name</th>
                    <th class="text-center whitespace-nowrap">Type</th>
                    <th class="text-center whitespace-nowrap">Status</th>
                    <th class="text-center whitespace-nowrap">Total Price</th>
                    <th class="text-center whitespace-nowrap">Order Date</th>
                    <th class="text-center whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    {{-- Determine class and name for status badge --}}
                    @php
                        $classset = '';
                        $nameset = '';
                        switch($order->status) {
                            case 'created':
                                $classset = 'bg-pending';
                                $nameset = 'รออนุมัติ';
                                break;
                            case 'approved':
                                $classset = 'bg-success';
                                $nameset = 'ออนไลน์';
                                break;
                            case 'rejected':
                                $classset = 'bg-primary';
                                $nameset = 'รอแก้ไข';
                                break;
                            case 'expired':
                                $classset = 'bg-danger';
                                $nameset = 'หมดอายุ';
                                break;
                            case 'deleted':
                                $classset = 'bg-danger';
                                $nameset = 'ถูกลบ';
                                break;
                            case 'success':
                                $classset = 'bg-success';
                                $nameset = 'สำเร็จ';
                                break;
                            case 'pending':
                                $classset = 'bg-warning';
                                $nameset = 'รอดำเนินการ';
                                break;
                            default:
                                $classset = 'bg-gray-400';
                                $nameset = 'ไม่ทราบสถานะ';
                                break;
                        }
                    @endphp

                    <tr class="intro-x">
                        <td>{{ $order->order_number }}</td>
                        <td class="text-center">{{ $order->individual_name ?? 'N/A' }}</td>
                        <td class="text-center">{{ ucfirst($order->type) }}</td>
                        <td class="text-center">
                            <span class="cursor-pointer rounded-full px-2 py-1 text-xs font-medium text-white {{ $classset }}"> {{ $nameset }} </span>
                        </td>
                        <td class="text-center">{{ number_format($order->total, 2, '.', ',') }} ฿</td>
                        <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                        <td class="text-center">
                            <a href="{{ route('BN_order_detail', $order->id) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="intro-y box mt-5">
    <div class="p-5">
        {{ $orders->links() }}
    </div>
</div>

<!-- JavaScript for Handling Filters and Search -->
<script>
    function applyFilters() {
        let keyword = document.getElementById('keyword').value;
        let status = document.getElementById('status').value;
        let type = document.getElementById('type').value;

        let url = new URL(window.location.href);
        url.searchParams.set('keyword', keyword);
        url.searchParams.set('status', status);
        url.searchParams.set('type', type);

        window.location.href = url.href;
    }

    function handleEnter(event) {
        if (event.key === 'Enter') {
            applyFilters();
        }
    }
</script>

@endsection
