<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadExteriorInput = document.getElementById('upload-exterior-input');
        const uploadExteriorButton = document.getElementById('exterior-upload-button');
        const exteriorPreviewContainer = document.getElementById('exterior-preview');
        const exteriorUploadingSpan = document.getElementById('exterior_uploading');

        const uploadInteriorInput = document.getElementById('upload-interior-input');
        const uploadInteriorButton = document.getElementById('interior-upload-button');
        const interiorPreviewContainer = document.getElementById('interior-preview');
        const interiorUploadingSpan = document.getElementById('interior_uploading');

        const uploadRegistrationInput = document.getElementById('upload-registration-input');
        const registrationPreviewContainer = document.getElementById('registration-preview');
        const registrationUploadButton = document.getElementById('registration-upload-button');
        const registrationUploadingSpan = document.getElementById('registration_uploading');

        const loadingBox = document.getElementById('wait');
        const submitButton = document.querySelector('.btn-nextstep');

        function animateUploadingText(spanElement) {
            let dots = '';
            spanElement.style.display = 'inline'; // Show the span element
            spanElement.innerHTML = 'กำลังอัปโหลด'; // Initial text

            const interval = setInterval(() => {
                dots = dots.length >= 3 ? '' : dots + '.';
                spanElement.innerHTML = 'กำลังอัปโหลด' + dots;
            }, 500); // Change text every 500ms

            return interval; // Return interval ID
        }

        // Function to handle image upload logic
        function handleImageUpload(input, button, previewContainer, spanElement, type, isSingleUpload = false) {
            if (!input || !button || !previewContainer || !spanElement) {
                console.error('Required element not found:', { input, button, previewContainer, spanElement });
                return;
            }
            button.addEventListener('click', function () {
                input.click();
            });

            input.addEventListener('change', function (event) {
                const files = Array.from(event.target.files);
                if (files.length > 0) {
                    const uploadInterval = animateUploadingText(spanElement); // Start text animation

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
                        .then(() => {
                            clearInterval(uploadInterval); // Stop text animation
                            spanElement.style.display = 'none'; // Hide span element
                        })
                        .catch(() => {
                            clearInterval(uploadInterval); // Stop text animation
                            spanElement.style.display = 'none'; // Hide span element
                        });
                }
            });
        }

        handleImageUpload(uploadExteriorInput, uploadExteriorButton, exteriorPreviewContainer, exteriorUploadingSpan, 'exterior');
        handleImageUpload(uploadInteriorInput, uploadInteriorButton, interiorPreviewContainer, interiorUploadingSpan, 'interior');
        handleImageUpload(uploadRegistrationInput, registrationUploadButton, registrationPreviewContainer, registrationUploadingSpan, 'registration', true);

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

        // Initialize remove functionality for existing registration image
        initializeRemoveButtons(registrationPreviewContainer);

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
            const carpostForm = document.getElementById('carpostForm');
            if (carpostForm) {
                setTimeout(() => {
                    carpostForm.submit();
                }, 500); // Adjust timeout as needed
            } else {
                console.error('Form element with ID "carpostForm" not found.');
            }
        });

    });




</script>