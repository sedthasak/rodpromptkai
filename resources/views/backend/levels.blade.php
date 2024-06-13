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
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">

        </div>
    </div>

    <!-- <div id="fetchCustomerss"></div> -->



        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">ระดับ</th>
                        <th class="whitespace-nowrap">จำนวนยอด</th>
                        <th class="text-center whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($query as $keyres => $res)

                        <tr class="intro-x">
                            <td class="text-center">{{(($query->currentPage()-1)*24)+$keyres+1}}</td>

                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->name}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->accumulate}}</div>
                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center text-success mr-3" href="{{route('BN_levels_detail', ['id' => $res->id])}}" >
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูข้อมูล
                                    </a>
                                    <a class="flex items-center" href="{{route('BN_levels_edit', ['id' => $res->id])}}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <div class="d-flex">
        {!! $query->appends(request()->input())->links() !!}
        </div>





      



@endsection

@section('script')



@endsection