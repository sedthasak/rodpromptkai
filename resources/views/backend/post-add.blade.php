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
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_brands')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    
        
        
        
    



    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form method="post" action="{{route('BN_brands_add_action')}}" enctype="multipart/form-data" >
            @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">Product Name</label>
                        <input id="crud-form-1" type="text" class="form-control w-full" placeholder="Input text">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">Category</label>
                        <select data-placeholder="Select your favorite actors" class="tom-select w-full" id="crud-form-2" multiple>
                            <option value="1" selected>Sport & Outdoor</option>
                            <option value="2">PC & Laptop</option>
                            <option value="3" selected>Smartphone & Tablet</option>
                            <option value="4">Photography</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-3" class="form-label">Quantity</label>
                        <div class="input-group">
                            <input id="crud-form-3" type="text" class="form-control" placeholder="Quantity" aria-describedby="input-group-1">
                            <div id="input-group-1" class="input-group-text">pcs</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-4" class="form-label">Weight</label>
                        <div class="input-group">
                            <input id="crud-form-4" type="text" class="form-control" placeholder="Weight" aria-describedby="input-group-2">
                            <div id="input-group-2" class="input-group-text">grams</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Price</label>
                        <div class="sm:grid grid-cols-3 gap-2">
                            <div class="input-group">
                                <div id="input-group-3" class="input-group-text">Unit</div>
                                <input type="text" class="form-control" placeholder="Unit" aria-describedby="input-group-3">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div id="input-group-4" class="input-group-text">Wholesale</div>
                                <input type="text" class="form-control" placeholder="Wholesale" aria-describedby="input-group-4">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div id="input-group-5" class="input-group-text">Bulk</div>
                                <input type="text" class="form-control" placeholder="Bulk" aria-describedby="input-group-5">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="form-switch mt-2">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="button" class="btn btn-primary w-24">Save</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>




@endsection

@section('script')

@endsection