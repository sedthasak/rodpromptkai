<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadExteriorInput = document.getElementById('upload-exterior-input');
        const uploadExteriorButton = document.getElementById('exterior-upload-button');
        const exteriorPreviewContainer = document.getElementById('exterior-preview');

        const uploadInteriorInput = document.getElementById('upload-interior-input');
        const uploadInteriorButton = document.getElementById('interior-upload-button');
        const interiorPreviewContainer = document.getElementById('interior-preview');

        const uploadRegistrationInput = document.getElementById('upload-registration-input');
        const registrationPreviewContainer = document.getElementById('registration-preview');
        const registrationUploadButton = document.getElementById('registration-upload-button');

        const loadingBox = document.getElementById('wait');
        const submitButton = document.getElementById('submitBtn');

        // Function to handle image upload logic
        function handleImageUpload(input, button, previewContainer, type, isSingleUpload = false) {
            if (!input || !button || !previewContainer) {
                console.error('Required element not found:', { input, button, previewContainer });
                return;
            }

            button.addEventListener('click', function () {
                input.click();
            });

            input.addEventListener('change', function (event) {
                const files = Array.from(event.target.files);
                if (files.length > 0) {
                    //loadingBox.style.display = 'flex'; // Show loading box

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
                                const imagePath = '{{ asset('storage') }}/' + data.path;
                                imgWrapper.innerHTML = `
                                    <div class="item-photoupload loading">
                                        <button type="button"><i class="bi bi-trash3-fill"></i></button>
                                        <img src="${imagePath}" alt="Image" class="uploaded-image" loading="lazy">
                                        <input type="hidden" name="${previewContainer.id === 'exterior-preview' ? 'image_paths' : previewContainer.id === 'interior-preview' ? 'interior_paths' : 'registration_paths'}[]" value="${data.path}">
                                    </div>
                                    <div class="wrapper-spinner">
                                        <div class="spinner"></div>
                                    </div>
                                    
                                `;
                                if (isSingleUpload) {
                                    previewContainer.innerHTML = ''; // Clear previous uploads for single upload
                                }
                                previewContainer.appendChild(imgWrapper);

                                const uploadedImage = imgWrapper.querySelector('.uploaded-image');
                                const spinner = imgWrapper.querySelector('.spinner');

                                // Hide loader and show image when loaded
                                uploadedImage.addEventListener('load', function () {
                                    imgWrapper.classList.remove('loading');
                                    uploadedImage.style.opacity = 1; // Show image
                                    spinner.style.display = 'none'; // Hide spinner
                                });

                                // Handle image deletion
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
                        .catch(() => loadingBox.style.display = 'none'); // Hide loading box in case of error
                }
            });
        }

        // Call handleImageUpload for exterior images
        handleImageUpload(uploadExteriorInput, uploadExteriorButton, exteriorPreviewContainer, 'exterior');

        // Call handleImageUpload for interior images
        handleImageUpload(uploadInteriorInput, uploadInteriorButton, interiorPreviewContainer, 'interior');

        // Call handleImageUpload for registration image (single upload)
        handleImageUpload(uploadRegistrationInput, registrationUploadButton, registrationPreviewContainer, 'registration', true);

        // Initialize SortableJS for exterior images
        if (exteriorPreviewContainer) {
            new Sortable(exteriorPreviewContainer, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    const imageWrappers = exteriorPreviewContainer.querySelectorAll('.col-photoupload');
                    imageWrappers.forEach((wrapper, index) => {
                        const input = wrapper.querySelector('input[type="hidden"]');
                        input.name = `image_paths[${index}]`;
                    });
                }
            });
        }

        // Initialize SortableJS for interior images
        if (interiorPreviewContainer) {
            new Sortable(interiorPreviewContainer, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    const imageWrappers = interiorPreviewContainer.querySelectorAll('.col-photoupload');
                    imageWrappers.forEach((wrapper, index) => {
                        const input = wrapper.querySelector('input[type="hidden"]');
                        input.name = `interior_paths[${index}]`;
                    });
                }
            });
        }

        // Form submission handler
        if (submitButton) {
            submitButton.addEventListener('click', function (event) {
                event.preventDefault();

                // Check if any of the preview containers are empty
                const isExteriorEmpty = exteriorPreviewContainer.children.length === 0;
                const isInteriorEmpty = interiorPreviewContainer.children.length === 0;
                const isRegistrationEmpty = registrationPreviewContainer.children.length === 0;

                // Check if the registration input is required
                const registrationInput = document.getElementById('upload-registration-input');
                const isRegistrationRequired = registrationInput.hasAttribute('required');

                let errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ, รูปห้องโดยสาร, เล่มทะเบียนรถ)';

                // Adjust error message based on registration requirement
                if (isRegistrationRequired) {
                    if (isExteriorEmpty || isInteriorEmpty || isRegistrationEmpty) {
                        errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ, รูปห้องโดยสาร, เล่มทะเบียนรถ)';
                    } else {
                        errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ, รูปห้องโดยสาร)';
                    }
                } else {
                    if (isExteriorEmpty || isInteriorEmpty) {
                        errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ, รูปห้องโดยสาร)';
                    }
                }

                if (isExteriorEmpty || isInteriorEmpty || (isRegistrationRequired && isRegistrationEmpty)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'กรุณาเพิ่มรูปภาพ',
                        text: errorMessage,
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                // Show loading box before submitting the form
                loadingBox.style.display = 'flex';

                // If not empty and validated, submit the form
                setTimeout(() => {
                    document.getElementById('carpostForm').submit();
                }, 500); // Adjust timeout as needed
            });
        }
    });

</script>
