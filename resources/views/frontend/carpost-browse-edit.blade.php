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
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload1.svg') }}" alt=""> รูปภายนอกรถ
                                                </div>
                                                <div>
                                                    <label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถยนต์<span>*</span></label>
                                                </div>
                                                <div id="exterior-preview" class="row row-photoupload">
                                                    @foreach ($restImages as $imagePath)
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload">
                                                                <button type="button" class="remove-image-button" data-path="{{ $imagePath }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="image_paths[]" value="{{ $imagePath }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="btn-uploadimg">
                                                    <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                </div>
                                                <input type="file" id="upload-image-input" accept="image/*" multiple style="display: none;">
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
        const uploadInput = document.getElementById('upload-image-input');
        const uploadButton = document.querySelector('.btn-uploadimg');
        const previewContainer = document.getElementById('exterior-preview');
        const loadingBox = document.getElementById('wait');

        // Function to add remove button event listener
        function addRemoveButtonListener(button) {
            button.addEventListener('click', function () {
                const parentDiv = button.closest('.col-photoupload');
                const path = button.getAttribute('data-path');

                // Remove from DOM
                parentDiv.remove();

                // Make AJAX call to delete image from 'rest' folder
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
                    if (data.status !== 'success') {
                        // Handle error if deletion fails
                        console.error('Failed to delete image');
                    }
                });
            });
        }

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-image-button').forEach(button => {
            addRemoveButtonListener(button);
        });

        uploadButton.addEventListener('click', function () {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', function (event) {
            const files = Array.from(event.target.files);
            if (files.length > 0) {
                loadingBox.style.display = 'flex'; // Show loading box

                const uploadPromises = files.map(file => {
                    const formData = new FormData();
                    formData.append('image', file);

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
                            const imagePath = '{{ asset('storage') }}/' + data.path;
                            imgWrapper.innerHTML = `
                                <div class="item-photoupload">
                                    <button type="button" class="remove-image-button" data-path="${data.path}"><i class="bi bi-trash3-fill"></i></button>
                                    <img src="${imagePath}" alt="Image" class="uploaded-image">
                                    <input type="hidden" name="image_paths[]" value="${data.path}">
                                </div>
                            `;
                            previewContainer.appendChild(imgWrapper);

                            // Add event listener to new remove button
                            addRemoveButtonListener(imgWrapper.querySelector('.remove-image-button'));
                        }
                    });
                });

                Promise.all(uploadPromises)
                    .then(() => loadingBox.style.display = 'none') // Hide loading box when all uploads are done
                    .catch(() => loadingBox.style.display = 'none'); // Hide loading box in case of error
            }
        });

        new Sortable(previewContainer, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (evt) {
                const imageWrappers = previewContainer.querySelectorAll('.col-photoupload');
                imageWrappers.forEach((wrapper, index) => {
                    const input = wrapper.querySelector('input[type="hidden"]');
                    input.name = `image_paths[${index}]`;
                });
            }
        });
        // Show loading box when form is submitted
        submitButton.addEventListener('click', function () {
            loadingBox.style.display = 'flex';
        });
    });
</script>
@endsection
