@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <!-- Optional: Add any additional buttons or links here -->
        </div>
    </div>

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <div class="hidden md:block mx-auto text-slate-500"></div>
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">วันที่</th>
                    <th class="whitespace-nowrap">ชื่อ - นามสกุล</th>
                    <th class="whitespace-nowrap">เบอร์</th>
                    <th class="whitespace-nowrap">ไลน์</th>
                    <th class="whitespace-nowrap">ชื่อธุรกิจ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Contacts as $key => $contact)
                    @php
                        $isToday = \Carbon\Carbon::parse($contact->created_at)->isToday();
                    @endphp
                    <tr class="intro-x">
                        <!-- Row Number -->
                        <td class="text-center">
                            {{ ($Contacts->currentPage() - 1) * $Contacts->perPage() + $key + 1 }}
                        </td>
                        
                        <!-- Date with Star Icon for New Records -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                @if($isToday)
                                    <i data-lucide="star" class="w-4 h-4 mr-1" style="color: orange;" title="New Record"></i>
                                @endif
                                {{ date('d/m/Y H:i:s', strtotime($contact->created_at)) }}
                            </div>
                        </td>
                        
                        <!-- Contact Details -->
                        <td>
                            <div class="font-medium whitespace-nowrap">{{ $contact->name }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-nowrap">{{ $contact->phone }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-nowrap">{{ $contact->line }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-nowrap">{{ $contact->business_name }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No VIP contacts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {!! $Contacts->links('pagination::bootstrap-4') !!}
    </div>
@endsection

@section('script')
<script>
    // Include any additional JavaScript or jQuery if necessary
</script>
@endsection
