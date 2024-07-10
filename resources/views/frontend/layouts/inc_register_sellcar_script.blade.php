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
                                const imagePath = '{{ asset('storage') }}/' + data.path;
                                imgWrapper.innerHTML = `
                                    <div class="item-photoupload">
                                        <button type="button"><i class="bi bi-trash3-fill"></i></button>
                                        <img src="${imagePath}" alt="Image" class="uploaded-image">
                                        <input type="hidden" name="${previewContainer.id === 'exterior-preview' ? 'image_paths' : previewContainer.id === 'interior-preview' ? 'interior_paths' : 'registration_paths'}[]" value="${data.path}">
                                    </div>
                                `;
                                if (isSingleUpload) {
                                    previewContainer.innerHTML = ''; // Clear previous uploads for single upload
                                }
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

        // Initialize SortableJS for interior images
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
            setTimeout(() => {
                document.getElementById('carpostForm').submit();
            }, 500); // Adjust timeout as needed
        });

        // Ensure elements exist in the DOM
        const step1Form = document.getElementById('step1Form');
        const step2Form = document.getElementById('step2Form');
        const step3Form = document.getElementById('step3Form');
        const nextStep1Button = document.getElementById('nextStep1');
        const nextStep2Button = document.getElementById('nextStep2');
        const prevStep2Button = document.getElementById('prevStep2');
        const nextStep3Button = document.getElementById('nextStep3');
        const prevStep3Button = document.getElementById('prevStep3');

        // Check each element and log if not found
        if (!step1Form) console.error('step1Form not found');
        if (!step2Form) console.error('step2Form not found');
        if (!step3Form) console.error('step3Form not found');
        if (!nextStep1Button) console.error('nextStep1Button not found');
        if (!nextStep2Button) console.error('nextStep2Button not found');
        if (!prevStep2Button) console.error('prevStep2Button not found');
        if (!nextStep3Button) console.error('nextStep3Button not found');
        if (!prevStep3Button) console.error('prevStep3Button not found');
        if (!submitButton) console.error('submitButton not found');

        // Stop execution if any required element is missing
        if (!step1Form || !step2Form || !step3Form || !nextStep1Button || !nextStep2Button || !prevStep2Button || !nextStep3Button || !prevStep3Button || !submitButton) {
            console.error('One or more required elements not found.');
            return;
        }

        // Function to show the current step based on localStorage
        function showCurrentStep() {
            const currentStep = localStorage.getItem('currentStep') || 'step1';

            switch (currentStep) {
                case 'step1':
                    step1Form.style.display = 'block';
                    step2Form.style.display = 'none';
                    step3Form.style.display = 'none';
                    break;
                case 'step2':
                    step1Form.style.display = 'none';
                    step2Form.style.display = 'block';
                    step3Form.style.display = 'none';
                    break;
                case 'step3':
                    step1Form.style.display = 'none';
                    step2Form.style.display = 'none';
                    step3Form.style.display = 'block';
                    break;
                default:
                    step1Form.style.display = 'block';
                    step2Form.style.display = 'none';
                    step3Form.style.display = 'none';
            }
        }

        // Show the current step on page load
        showCurrentStep();

        // Step 1 to Step 2 navigation
        nextStep1Button.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('currentStep', 'step2'); // Update current step in localStorage
            showCurrentStep();
        });

        // Step 2 to Step 1 navigation
        prevStep2Button.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('currentStep', 'step1'); // Update current step in localStorage
            showCurrentStep();
        });

        // Step 2 to Step 3 navigation
        nextStep2Button.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('currentStep', 'step3'); // Update current step in localStorage
            showCurrentStep();
        });

        // Step 3 to Step 2 navigation
        prevStep3Button.addEventListener('click', function (event) {
            event.preventDefault();
            localStorage.setItem('currentStep', 'step2'); // Update current step in localStorage
            showCurrentStep();
        });

        // Form submission handling
        submitButton.addEventListener('click', function (event) {
            event.preventDefault();

            // Add form submission logic here
            const loadingBox = document.getElementById('wait');
            loadingBox.style.display = 'flex'; // Display loading box

            setTimeout(() => {
                // Simulate form submission after some delay (500ms in this case)
                step3Form.submit();
            }, 500);
        });
    });
</script>
