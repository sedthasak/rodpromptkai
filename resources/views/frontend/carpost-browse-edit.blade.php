@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - Edit Car Post</title>
@endsection

@section('content')
<style>
    .box-waiting {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5); /* Black background with 50% opacity */
        z-index: 999; /* Set z-index to 999 */
    }

    .waiting-wrapper-image {
        width: 100%;
        max-width: 400px;
        height: 0;
        padding-bottom: 11.1111%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .waiting-wrapper-image img {
        width: 120px; /* Set the width to 120px */
        height: auto; /* Automatically adjust the height to maintain aspect ratio */
        max-width: 100%; /* Ensure the image doesn't exceed its container */
    }
</style>

<div id="wait" class="box-waiting" style="display:none;">
    <div class="waiting-wrapper-image">
        <img src="{{ asset('uploads/wait.gif') }}" />
    </div>
</div>

<form action="{{ route('carpostbrowseeditsubmit', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="step3">
        <section class="row">
            <div class="col-12 wrap-page-step wow fadeInDown">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wrap-boxstep">
                                <div class="box-frm-step">
                                    <div class="row">
                                        <div class="col-12 frm-step">
                                            <!-- Exterior Images Section -->
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload1.svg') }}" alt=""> รูปภายนอกรถ
                                                </div>
                                                <div>
                                                    <label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถ<span>*</span></label>
                                                </div>
                                                <div id="exterior-preview" class="row row-photoupload">
                                                    @foreach ($restImages['exterior'] as $imagePath)
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload">
                                                                <button type="button" class="remove-image-button" data-path="{{ asset('storage/' . $imagePath) }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="image_paths[]" value="{{ $imagePath }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="btn-uploadimg" id="exterior-upload-button">
                                                    <i class="bi bi-plus-circle-fill"></i> เพิ่มรูปภายนอกรถ
                                                </div>
                                                <input type="file" id="upload-exterior-input" accept="image/*" multiple style="display: none;">
                                            </div>

                                            <!-- Interior Images Section -->
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload2.svg') }}" alt=""> รูปห้องโดยสาร
                                                </div>
                                                <div>
                                                    <label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label>
                                                </div>
                                                <div id="interior-preview" class="row row-photoupload">
                                                    @foreach ($restImages['interior'] as $imagePath)
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload">
                                                                <button type="button" class="remove-image-button" data-path="{{ asset('storage/' . $imagePath) }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="interior_paths[]" value="{{ $imagePath }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="btn-uploadimg" id="interior-upload-button">
                                                    <i class="bi bi-plus-circle-fill"></i> เพิ่มรูปห้องโดยสาร
                                                </div>
                                                <input type="file" id="upload-interior-input" accept="image/*" multiple style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="frm-step-button text-center">
        <button type="submit" class="btn btn-step btn-nextstep" id="">บันทึก</button>
    </div>
</form>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadExteriorInput = document.getElementById('upload-exterior-input');
        const uploadExteriorButton = document.getElementById('exterior-upload-button');
        const exteriorPreviewContainer = document.getElementById('exterior-preview');

        const uploadInteriorInput = document.getElementById('upload-interior-input');
        const uploadInteriorButton = document.getElementById('interior-upload-button');
        const interiorPreviewContainer = document.getElementById('interior-preview');

        const loadingBox = document.getElementById('wait');
        const submitButton = document.querySelector('.btn-nextstep');

        // Function to handle image upload logic
        function handleImageUpload(input, button, previewContainer, type) {
            button.addEventListener('click', function () {
                input.click();
            });

            input.addEventListener('change', function (event) {
                const files = Array.from(event.target.files);
                if (files.length > 0) {
                    loadingBox.style.display = 'flex'; // Show loading box

                    const uploadPromises = files.map(file => {
                        const formData = new FormData();
                        formData.append('image', file);
                        formData.append('type', type);

                        return fetch('{{ route('carpostuploadimage') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.path) {
                                const imgWrapper = document.createElement('div');
                                imgWrapper.classList.add('col-4', 'col-md-3', 'col-lg-2', 'col-photoupload');
                                const imagePath = '{{ asset('storage') }}/' + data.path; // Update path if needed
                                imgWrapper.innerHTML = `
                                    <div class="item-photoupload">
                                        <button type="button" class="remove-image-button" data-path="${imagePath}"><i class="bi bi-trash3-fill"></i></button>
                                        <img src="${imagePath}" alt="Image" class="uploaded-image">
                                        <input type="hidden" name="${previewContainer.id === 'exterior-preview' ? 'image_paths' : 'interior_paths'}[]" value="${data.path}">
                                    </div>
                                `;
                                previewContainer.appendChild(imgWrapper);

                                imgWrapper.querySelector('button').addEventListener('click', function () {
                                    const path = this.nextElementSibling.nextElementSibling.value;
                                    fetch('{{ route('carpostdeleteimage') }}', {
                                        method: 'POST',
                                        body: JSON.stringify({ path: path }),
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            imgWrapper.remove();
                                        }
                                    });
                                });
                            }
                        });
                    });

                    Promise.all(uploadPromises)
                        .then(() => loadingBox.style.display = 'none') // Hide loading box when all uploads are done
                        .catch(() => loadingBox.style.display = 'none'); // Hide loading box on error
                }
            });
        }

        handleImageUpload(uploadExteriorInput, uploadExteriorButton, exteriorPreviewContainer, 'exterior');
        handleImageUpload(uploadInteriorInput, uploadInteriorButton, interiorPreviewContainer, 'interior');

        // Function to initialize remove functionality for existing images
        function initializeRemoveButtons(previewContainer) {
            const removeButtons = previewContainer.querySelectorAll('.remove-image-button');
            removeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const path = this.nextElementSibling.nextElementSibling.value;
                    fetch('{{ route('carpostdeleteimage') }}', {
                        method: 'POST',
                        body: JSON.stringify({ path: path }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            button.closest('.col-photoupload').remove();
                        }
                    });
                });
            });
        }

        // Initialize remove functionality for existing exterior images
        initializeRemoveButtons(exteriorPreviewContainer);

        // Initialize remove functionality for existing interior images
        initializeRemoveButtons(interiorPreviewContainer);

        // Initialize SortableJS for exterior images
        new Sortable(exteriorPreviewContainer, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (evt) {
                const imageWrappers = exteriorPreviewContainer.querySelectorAll('.col-photoupload');
                imageWrappers.forEach((wrapper, index) => {
                    const input = wrapper.querySelector('input[type="hidden"]');
                    if (input) {
                        input.name = 'image_paths[]';
                    }
                });
            }
        });

        // Initialize SortableJS for interior images
        new Sortable(interiorPreviewContainer, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (evt) {
                const imageWrappers = interiorPreviewContainer.querySelectorAll('.col-photoupload');
                imageWrappers.forEach((wrapper, index) => {
                    const input = wrapper.querySelector('input[type="hidden"]');
                    if (input) {
                        input.name = 'interior_paths[]';
                    }
                });
            }
        });
    });


</script>
@endsection
