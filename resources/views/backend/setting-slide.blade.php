@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
</div>

<form action="{{ route('BN_slideupdate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="slides">
        @if(isset($slides) && is_array($slides))
            @foreach($slides as $index => $slide)
                <div class="slide-item" data-index="{{ $index }}">
                    <div>
                        <label>Image</label>
                        @if(isset($slide['image']) && $slide['image'])
                            <img src="{{ asset('uploads/banner/' . $slide['image']) }}" alt="Slide Image" style="width:100px;height:auto;">
                            <input type="hidden" name="slides[{{ $index }}][existing_image]" value="{{ $slide['image'] }}" />
                        @endif
                        <input type="file" name="slides[{{ $index }}][image]" />
                    </div>
                    <div>
                        <label>Link</label>
                        <input type="url" name="slides[{{ $index }}][link]" value="{{ $slide['link'] ?? '' }}" />
                    </div>
                    <button type="button" onclick="removeSlide({{ $index }})">Remove</button>
                </div>
            @endforeach
        @endif
    </div>
    <button type="button" onclick="addSlide()">Add Slide</button>
    <button type="submit">Update Slides</button>
</form>

<form action="{{ route('BN_slidedelete') }}" method="POST">
    @csrf
    <input type="hidden" name="slide_id" id="delete-slide-id" />
    <button type="submit">Delete Slide</button>
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
        const index = slidesContainer.children.length;
        const slideItem = document.createElement('div');
        slideItem.classList.add('slide-item');
        slideItem.dataset.index = index;
        slideItem.innerHTML = `
            <div>
                <label>Image</label>
                <input type="file" name="slides[${index}][image]" />
            </div>
            <div>
                <label>Link</label>
                <input type="url" name="slides[${index}][link]" />
            </div>
            <button type="button" onclick="removeSlide(${index})">Remove</button>
        `;
        slidesContainer.appendChild(slideItem);
    }

    function removeSlide(index) {
        const slideItem = document.querySelector(`.slide-item[data-index='${index}']`);
        slideItem.remove();
    }
</script>
@endsection
