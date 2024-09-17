@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
</div>

@if(session('error'))
    <div class="alert alert-danger mb-8">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-danger border-danger text-white dark:border-danger mb-2 flex items-center">
        <i data-tw-merge data-lucide="alert-octagon" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6"></i>
        <ul class="pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button data-tw-merge data-tw-dismiss="alert" type="button" aria-label="Close" class="text-slate-800 py-2 px-3 absolute right-0 my-auto mr-2 text-white">
            <i data-tw-merge data-lucide="x" class="stroke-1.5 w-5 h-5 h-4 w-4"></i>
        </button>
    </div>
@endif

<!-- Old Slides Form -->
<form action="{{ route('BN_slideupdate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3 class="text-lg font-medium mt-5">Old Slides</h3>
    <div id="slides" class="mt-5 grid grid-cols-12 gap-6">
        @if(isset($slides) && is_array($slides))
            @foreach($slides as $index => $slide)
                <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 slide-item" data-id="{{ $index }}">
                    <div class="box">
                        <div class="p-5">
                            <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                                <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                                    <label>Image</label>
                                    @if(isset($slide['image']) && $slide['image'])
                                        <img data-action="zoom" src="{{ asset($slide['image']) }}" alt="Slide Image" style="max-width: 100%; height: auto;">
                                        <input type="hidden" name="slides[{{ $index }}][existing_image]" value="{{ $slide['image'] }}" />
                                    @endif
                                    <input type="file" name="slides[{{ $index }}][image]" class="image-upload" @if(isset($slide['image']) && $slide['image']) style="display:none;" @endif />
                                </div>
                                <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                                    <label>Link</label>
                                    <input type="url" name="slides[{{ $index }}][link]" value="{{ $slide['link'] ?? '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                            <button type="button" onclick="removeSlide({{ $index }}, 'slides')">Remove Slide</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap mt-8">
        <button type="button" onclick="addSlide('slides')" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-pending border-pending text-white dark:border-pending mb-2 mr-1 w-24">Add Slide</button>
    </div>

    <!-- New Slide (slide_search) -->
    <h3 class="text-lg font-medium mt-8">New Slide (slide_search)</h3>
    <div id="new-slides" class="mt-5 grid grid-cols-12 gap-6">
        @if(isset($slide_search) && is_array($slide_search))
            @foreach($slide_search as $index => $slide)
                <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 slide-item" data-id="{{ $index }}">
                    <div class="box">
                        <div class="p-5">
                            <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                                <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                                    <label>Image</label>
                                    @if(isset($slide['image']) && $slide['image'])
                                        <img data-action="zoom" src="{{ asset($slide['image']) }}" alt="Slide Image" style="max-width: 100%; height: auto;">
                                        <input type="hidden" name="slide_search[{{ $index }}][existing_image]" value="{{ $slide['image'] }}" />
                                    @endif
                                    <input type="file" name="slide_search[{{ $index }}][image]" class="image-upload" @if(isset($slide['image']) && $slide['image']) style="display:none;" @endif />
                                </div>
                                <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                                    <label>Link</label>
                                    <input type="url" name="slide_search[{{ $index }}][link]" value="{{ $slide['link'] ?? '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                            <button type="button" onclick="removeSlide({{ $index }}, 'new-slides')">Remove Slide</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap mt-8">
        <button type="button" onclick="addSlide('new-slides')" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-pending border-pending text-white dark:border-pending mb-2 mr-1 w-24">Add New Slide</button>
    </div>

    <!-- New Banner (banner_search) -->
    <h3 class="text-lg font-medium mt-8">New Banner (banner_search)</h3>
    <div id="banner" class="mt-5 grid grid-cols-12 gap-6">
        <div class="col-span-12">
            @if(isset($banner_search['image']) && $banner_search['image'])
                <img src="{{ asset($banner_search['image']) }}" alt="New Banner Image" style="max-width: 100%; height: auto;">
                <input type="hidden" name="banner_search[existing_image]" value="{{ $banner_search['image'] }}" />
            @endif
            <div class="col-span-6 lg:col-span-6 2xl:col-span-6 mt-4">
                <label>Banner Image</label>
                <input type="file" name="banner_search[image]" />
            </div>
            <div class="col-span-6 lg:col-span-6 2xl:col-span-6 mt-4">
                <label>Link</label>
                <input type="url" name="banner_search[link]" value="{{ $banner_search['link'] ?? '' }}" />
            </div>
        </div>
    </div>

    <div class="intro-y col-span-12 mt-5">
        <button type="submit" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer">Update Slides</button>
    </div>
</form>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    // Initialize sortable for slide reordering
    new Sortable(document.getElementById('slides'), {
        animation: 150,
        ghostClass: 'sortable-ghost'
    });
    new Sortable(document.getElementById('new-slides'), {
        animation: 150,
        ghostClass: 'sortable-ghost'
    });

    function addSlide(containerId) {
        const slidesContainer = document.getElementById(containerId);
        
        if (!slidesContainer) {
            console.error(`Container with ID "${containerId}" not found.`);
            return;
        }

        const uniqueId = Date.now(); // Use a unique ID (timestamp) for the slide
        const slideItem = document.createElement('div'); // Create a new slide item
        slideItem.classList.add('intro-y', 'col-span-12', 'md:col-span-12', 'lg:col-span-12', 'xl:col-span-12', 'slide-item');
        slideItem.dataset.id = uniqueId; // Use data-id instead of data-index
        slideItem.innerHTML = `
            <div class="box">
                <div class="p-5">
                    <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                        <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                            <label>Image</label>
                            <input type="file" name="${containerId === 'slides' ? 'slides' : 'slide_search'}[${uniqueId}][image]" class="image-upload" />
                        </div>
                        <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                            <label>Link</label>
                            <input type="url" name="${containerId === 'slides' ? 'slides' : 'slide_search'}[${uniqueId}][link]" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                    <button type="button" onclick="removeSlide(${uniqueId}, '${containerId}')">Remove Slide</button>
                </div>
            </div>
        `;
        slidesContainer.appendChild(slideItem);
    }

    function removeSlide(id, containerId) {
        const slidesContainer = document.getElementById(containerId);
        const slideItem = slidesContainer.querySelector(`.slide-item[data-id='${id}']`);
        
        if (slideItem) {
            slideItem.remove();
        } else {
            console.error(`Slide item with ID "${id}" not found in container "${containerId}".`);
        }
    }
</script>
@endsection
