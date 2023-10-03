@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_news_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่มข่าวใหม่</a>    
        </div>
    </div>
    <div id="fetchNews"></div>

    <h2>Laravel DataTables Tutorial Example</h2>
    <table class="table table-bordered" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Phone</th>
                {{-- <th>Email</th> --}}
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@section('script')
<script>
    // jQuery(function() {
    //     fetchNews();
    //     function fetchNews(){
    //         jQuery.ajax({
    //             url: '{{route('BN_newsFetch')}}',
    //             method: 'get',
    //             success: function(response){
    //                 jQuery('#fetchNews').html(response);
    //             }
    //         });
    //     }
    // });
    jQuery(document).ready(function() {
        // jQuery.ajax({
        //     url: "{{ route('BN_newsuser') }}",
        //     type: 'GET',
        //     success: function(data, textStatus, jqXHR)
        //     {
        //         console.log(data); //*** returns correct json data
        //     }
        // });
        jQuery(function () {
            jQuery('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('BN_newsuser') }}",
                    "type": "GET",
                    "dataSrc":"",
                    "complete": function(xhr, responseText){
                        console.log(xhr);
                        console.log(responseText); //*** responseJSON: Array[0]
                    }
                },
                columns: [
                        { data: 'id', name: 'id' },
                        { data: 'phone', name: 'phone' }
                        ]
            });
        });
        
    });
</script>
@endsection