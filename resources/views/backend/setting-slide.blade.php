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

<form action="{{ route('BN_slideupdate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="slides" class="mt-5 grid grid-cols-12 gap-6">
        @if(isset($slides) && is_array($slides))
            @foreach($slides as $index => $slide)
                <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 slide-item" data-index="{{ $index }}">
                    <div class="box">
                        <div class="p-5">
                            <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                                <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                                    <label>Image</label>
                                    @if(isset($slide['image']) && $slide['image'])
                                        <img  data-action="zoom" src="{{ asset('uploads/banner/' . $slide['image']) }}" alt="Slide Image" style="max-width: 100%; height: auto;">
                                        <input type="hidden" name="slides[{{ $index }}][existing_image]" value="{{ $slide['image'] }}" />
                                        <!-- <button type="button" onclick="removeExistingImage({{ $index }})">Remove</button> -->
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
                            <button type="button" onclick="removeSlide({{ $index }})">Remove Slide</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap mt-8">
        <button type="button" onclick="addSlide()" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-pending border-pending text-white dark:border-pending mb-2 mr-1 w-24 mb-2 mr-1 w-24">Add Slide</button>
        <div class="mx-auto hidden text-slate-500 md:block">
        </div>
        <button type="submit" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">Update Slides</button>
    </div>
</form>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    new Sortable(document.getElementById('slides'), {
        animation: 150,
        ghostClass: 'sortable-ghost'
    });

    function addSlide() {
        const slidesContainer = document.getElementById('slides');
        const index = slidesContainer.children.length; // Get the current number of slides
        const slideItem = document.createElement('div'); // Create a new slide item
        slideItem.classList.add('intro-y', 'col-span-12', 'md:col-span-12', 'lg:col-span-12', 'xl:col-span-12', 'slide-item');
        slideItem.dataset.index = index;
        slideItem.innerHTML = `
            <div class="box">
                <div class="p-5">
                    <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                        <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                            <label>Image</label>
                            <input type="file" name="slides[${index}][image]" class="image-upload" />
                        </div>
                        <div class="col-span-6 lg:col-span-6 2xl:col-span-6">
                            <label>Link</label>
                            <input type="url" name="slides[${index}][link]" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                    <button type="button" onclick="removeSlide(${index})">Remove Slide</button>
                </div>
            </div>
        `;
        slidesContainer.appendChild(slideItem);
    }

    function removeSlide(index) {
        const slideItem = document.querySelector(`.slide-item[data-index='${index}']`);
        slideItem.remove();
    }

    function removeExistingImage(index) {
        const slideItem = document.querySelector(`.slide-item[data-index='${index}']`);
        const existingImage = slideItem.querySelector('input[name="slides[' + index + '][existing_image]"]');
        const fileInput = slideItem.querySelector('.image-upload');
        const imgElement = slideItem.querySelector('img');
        const removeButton = slideItem.querySelector('button[onclick^="removeExistingImage"]');

        if (existingImage) {
            existingImage.remove();
        }

        if (fileInput) {
            fileInput.style.display = 'block';
        }

        if (imgElement) {
            imgElement.remove();
        }

        if (removeButton) {
            removeButton.remove();
        }
    }
</script>
@endsection
