<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>
    function formatNumber(input) {
        // Remove all non-digit characters
        const value = input.value.replace(/\D/g, '');
        // Add comma as thousand separators
        input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    $(document).ready(function() {
        $(".select2s").select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        // Handle buttons that append text to the textarea
        var buttons = document.querySelectorAll('.clckads');
        var carDetailTextarea = document.querySelector('#car_detail');
        if (buttons && carDetailTextarea) {
            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    var buttonText = button.getAttribute('data-text');
                    carDetailTextarea.value += buttonText; // Append text to the textarea
                });
            });
        }

        $("#generations").on("change", function() {
            var generations_id = $(this).val();
            if (generations_id) {
                $('#wait').show();
                $.ajax({
                    url: "{{route('carpostSelectGenerations')}}",
                    type: "post",
                    data: {
                        generations_id: generations_id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        $('#wait').hide();
                        $('#sub_models').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#wait').hide();
                        console.log(textStatus, errorThrown);
                    }
                });
                $.ajax({
                    url: "{{route('carpostSelectGenerationsYear')}}",
                    type: "post",
                    data: {
                        generations_id: generations_id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        $('#wait').hide();
                        $('#years').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#wait').hide();
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $("#models").on("change", function() {
            var models_id = $(this).val();
            if (models_id) {
                $('#wait').show();
                $.ajax({
                    url: "{{route('carpostSelectModel')}}",
                    type: "post",
                    data: {
                        models_id: models_id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        $('#wait').hide();
                        $('#generations').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#wait').hide();
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $("#brands").on("change", function() {
            var brands_id = $(this).val();
            if (brands_id) {
                $('#wait').show();
                $.ajax({
                    url: "{{route('carpostSelectBrand')}}",
                    type: "post",
                    data: {
                        brands_id: brands_id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        $('#wait').hide();
                        $('#models').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#wait').hide();
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        // Color selection with other color input
        const colorSelect = document.getElementById('color_select');
        const otherColorInput = document.getElementById('other_color_input');

        if (colorSelect && otherColorInput) {
            colorSelect.addEventListener('change', function() {
                if (colorSelect.value === '99999999') {
                    otherColorInput.setAttribute('required', 'required');
                } else {
                    otherColorInput.removeAttribute('required');
                }
            });
        }

        // Steps navigation and validation
        const steps = document.querySelectorAll('.step');
        let currentStep = 0;

        function showStep(step) {
            steps.forEach((el, index) => {
                el.classList.toggle('active', index === step);
            });
        }

        function validateStep(step) {
            const inputs = steps[step].querySelectorAll('input[required], textarea[required], select[required]');
            const emptyFields = [];

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    emptyFields.push(input.previousElementSibling.textContent);
                }
            });

            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'แจ้งเตือน',
                    html: `กรุณากรอกข้อมูลให้ครบถ้วน: <br> ${emptyFields.join('<br>')}`,
                });
                return false;
            }
            return true;
        }

        document.querySelectorAll('.btn-nextstep').forEach(btn => {
            btn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                        window.scrollTo(0, 0); // Scroll to top of the page
                    }
                }
            });
        });

        document.querySelectorAll('.btn-backstep').forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                    window.scrollTo(0, 0); // Scroll to top of the page
                }
            });
        });

        showStep(currentStep);
    });

    // Image upload and sorting functionality
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

        const formType = '{{ $formtype }}';

        const loadingBox = document.getElementById('wait');
        const submitButton = document.getElementById('submitBtn');

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
        if (formType === 'home') {
            handleImageUpload(uploadRegistrationInput, registrationUploadButton, registrationPreviewContainer, registrationUploadingSpan, 'registration', true);
        }

        function initializeRemoveButtons(previewContainer) {
            if (!previewContainer) return; // Ensure previewContainer exists
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

        if (exteriorPreviewContainer) initializeRemoveButtons(exteriorPreviewContainer);
        if (interiorPreviewContainer) initializeRemoveButtons(interiorPreviewContainer);
        if (registrationPreviewContainer) initializeRemoveButtons(registrationPreviewContainer);

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

        submitButton.addEventListener('click', function (event) {
            event.preventDefault();

            const exteriorImageCount = exteriorPreviewContainer.children.length;
            const interiorImageCount = interiorPreviewContainer.children.length;
            const isExteriorValid = exteriorImageCount >= 3 && exteriorImageCount <= 15;
            const isInteriorValid = interiorImageCount >= 3 && interiorImageCount <= 15;
            const isRegistrationEmpty = formType === 'home' && registrationPreviewContainer.children.length === 0;

            const registrationInput = document.getElementById('upload-registration-input');
            const isRegistrationRequired = registrationInput && registrationInput.hasAttribute('required');

            let errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ 3-15 รูป, รูปห้องโดยสาร 3-15 รูป, เล่มทะเบียนรถ)';

            if (isRegistrationRequired) {
                if (!isExteriorValid || !isInteriorValid || isRegistrationEmpty) {
                    errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ 3-15 รูป, รูปห้องโดยสาร 3-15 รูป, เล่มทะเบียนรถ)';
                } else {
                    errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ 3-15 รูป, รูปห้องโดยสาร 3-15 รูป)';
                }
            } else {
                if (!isExteriorValid || !isInteriorValid) {
                    errorMessage = 'โปรดอัพโหลดรูปภาพทั้งหมดที่จำเป็น (รูปภายนอกรถ 3-15 รูป, รูปห้องโดยสาร 3-15 รูป)';
                }
            }

            const acceptanceCheckbox = document.getElementById('acceptance-checkbox');
            if (!acceptanceCheckbox || !acceptanceCheckbox.checked) {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณาอ่านและยอมรับเงื่อนไขการใช้งานก่อนลงทะเบียนขาย',
                });
                return;
            }

            if (!isExteriorValid || !isInteriorValid || (isRegistrationRequired && isRegistrationEmpty)) {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณาเพิ่มรูปภาพ',
                    text: errorMessage,
                    confirmButtonText: 'ตกลง'
                });
                return;
            }

            loadingBox.style.display = 'flex';

            const carpostForm = document.getElementById('carpostForm');
            if (carpostForm) {
                setTimeout(() => {
                    carpostForm.submit();
                }, 500);
            } else {
                console.error('Form element with ID "carpostForm" not found.');
            }
        });
    });
</script>
