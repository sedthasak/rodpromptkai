@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }} Detail</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }} Detail</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <!-- Add any additional buttons or links here -->
        </div>
    </div>

    @if ($packageType === 'dealer')
        <!-- Display Dealer Package Details -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
            <div class="intro-y box p-5">
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Package Name</label>
                        <div>{{ $package->name }}</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Price</label>
                        <div>{{ $package->price }}</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Limit</label>
                        <div>{{ $package->limit }}</div>
                    </div>
                    <!-- Add other fields as necessary -->
                </div>
            </div>
        </div>
        <!-- END: Dealer Package Details -->
    @elseif ($packageType === 'vip')
        <!-- Display VIP Package Details -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
            <div class="intro-y box p-5">
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Package Name</label>
                        <div>{{ $package->name }}</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Price</label>
                        <div>{{ $package->price }}</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label class="font-medium">Limit</label>
                        <div>{{ $package->limit }}</div>
                    </div>
                    <!-- Add other fields as necessary -->
                </div>
            </div>
        </div>
        <!-- END: VIP Package Details -->
    @else
        <div class="intro-y col-span-12">
            <div class="alert alert-danger">Invalid package type.</div>
        </div>
    @endif
@endsection

@section('script')
    <!-- Additional scripts can be added here if necessary -->
@endsection
