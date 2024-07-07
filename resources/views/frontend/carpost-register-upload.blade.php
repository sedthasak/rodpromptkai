@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-upload-image</title>
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
    <div id="wait" class="box-waiting " style="display:none;"><div class="waiting-wrapper-image"><img src="{{asset('uploads/wait.gif')}}" /></div></div>

    <form action="{{ route('carpostregistertestuploadsubmitPage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="step3">
            <section class="row">
                <div class="col-12 wrap-page-step wow fadeInDown">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="wrap-boxstep">
                                    <div class="topic-step"><span>3</span> อัพโหลดรูปภาพ</div>
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 frm-step">
                                                <div class="topic-notephoto">อัพโหลดรูปรถ</div>
                                                <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto">
                                                        <img src="{{ asset('frontend/images/icon-upload1.svg') }}" alt=""> รูปภายนอกรถ
                                                    </div>
                                                    <div>
                                                        <label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถยนต์<span>*</span></label>
                                                    </div>
                                                    <input type="file" id="exteriorInput" name="exterior[]" multiple style="display: none;">
                                                    <div id="exteriorPreview" class="row row-photoupload d-flex flex-wrap">
                                                        @if (isset($exteriorImages) && count($exteriorImages) > 0)
                                                            @foreach ($exteriorImages as $index => $image)
                                                                <div class="col-4 col-md-3 col-lg-2 col-photoupload m-2" data-file-name="{{ basename($image['path']) }}">
                                                                    <div class="item-photoupload" style="position: relative;">
                                                                        <img src="{{ asset($image['url']) }}" class="img-thumbnail" style="width: 150px;">
                                                                        <input type="hidden" name="old_exterior_images[]" value="{{ $image['id'] }}">
                                                                        <button type="button" class="remove-image-btn" style="position: absolute; top: 5px; right: 5px; background: rgba(255, 255, 255, 0.8); color: #ff0000; width: 25px; height: 25px; border-radius: 50%; border: 0; display: flex; align-items: center; justify-content: center; z-index: 1; font-size: 0.7rem; transition: 0.5s;">
                                                                            <i class="bi bi-trash3-fill" style="font-size: 16px;"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="exteriorOrder" id="exteriorOrder">
                                                    <div class="btn-uploadimg" style="margin-top: 10px; cursor: pointer;">
                                                        <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ (ภายนอกรถ)
                                                    </div>
                                                </div>
                                                <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto">
                                                        <img src="{{ asset('frontend/images/icon-upload2.svg') }}" alt=""> รูปห้องโดยสาร
                                                    </div>
                                                    <div>
                                                        <label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label>
                                                    </div>
                                                    <input type="file" id="interiorInput" name="interior[]" multiple style="display: none;">
                                                    <div id="interiorPreview" class="row row-photoupload d-flex flex-wrap">
                                                        @if (isset($interiorImages) && count($interiorImages) > 0)
                                                            @foreach ($interiorImages as $index => $image)
                                                                <div class="col-4 col-md-3 col-lg-2 col-photoupload m-2" data-file-name="{{ basename($image['path']) }}">
                                                                    <div class="item-photoupload" style="position: relative;">
                                                                        <img src="{{ asset($image['url']) }}" class="img-thumbnail" style="width: 150px;">
                                                                        <input type="hidden" name="old_interior_images[]" value="{{ $image['id'] }}">
                                                                        <button type="button" class="remove-image-btn" style="position: absolute; top: 5px; right: 5px; background: rgba(255, 255, 255, 0.8); color: #ff0000; width: 25px; height: 25px; border-radius: 50%; border: 0; display: flex; align-items: center; justify-content: center; z-index: 1; font-size: 0.7rem; transition: 0.5s;">
                                                                            <i class="bi bi-trash3-fill" style="font-size: 16px;"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="interiorOrder" id="interiorOrder">
                                                    <div class="btn-uploadimg" style="margin-top: 10px; cursor: pointer;">
                                                        <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ (ภายในรถ)
                                                    </div>
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
            <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
            <button type="submit" class="btn btn-step btn-nextstep" id="submit-btn">สร้าง</button>
        </div>
    </form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var exteriorInput = $('#exteriorInput');
        var interiorInput = $('#interiorInput');
        var exteriorPreview = $('#exteriorPreview');
        var interiorPreview = $('#interiorPreview');
        var exteriorOrder = $('#exteriorOrder');
        var interiorOrder = $('#interiorOrder');
        var exteriorFileData = [];
        var interiorFileData = [];

        // Custom upload button click event for exterior images
        $('.box-uploadphoto').eq(0).find('.btn-uploadimg').on('click', function() {
            exteriorInput.click();
        });

        // Custom upload button click event for interior images
        $('.box-uploadphoto').eq(1).find('.btn-uploadimg').on('click', function() {
            interiorInput.click();
        });

        // Function to update the image preview for exterior images
        function updateExteriorPreview(files) {
            for (var i = 0; i < files.length; i++) {
                (function(index) {
                    var file = files[index];
                    exteriorFileData.push(file); // Store file data
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css({
                            'width': '150px',
                            'position': 'relative'
                        });
                        var removeButton = $('<button>').attr('type', 'button').addClass('remove-image-btn')
                            .css({
                                'position': 'absolute',
                                'top': '5px',
                                'right': '5px',
                                'background': 'rgba(255, 255, 255, 0.8)',
                                'color': '#ff0000',
                                'width': '25px',
                                'height': '25px',
                                'border-radius': '50%',
                                'border': '0',
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'center',
                                'z-index': '1',
                                'font-size': '0.7rem',
                                'transition': '0.5s'
                            }).append($('<i>').addClass('bi bi-trash3-fill').css({
                                'font-size': '16px'
                            }));
                        var div = $('<div>').addClass('col-4 col-md-3 col-lg-2 col-photoupload').css('position', 'relative').append(
                            $('<div>').addClass('item-photoupload').css('position', 'relative').append(img).append(removeButton)
                        ).attr('data-file-name', file.name);
                        exteriorPreview.append(div);
                    }
                    reader.readAsDataURL(file);
                })(i);
            }
        }

        // Function to update the image preview for interior images
        function updateInteriorPreview(files) {
            for (var i = 0; i < files.length; i++) {
                (function(index) {
                    var file = files[index];
                    interiorFileData.push(file); // Store file data
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css({
                            'width': '150px',
                            'position': 'relative'
                        });
                        var removeButton = $('<button>').attr('type', 'button').addClass('remove-image-btn')
                            .css({
                                'position': 'absolute',
                                'top': '5px',
                                'right': '5px',
                                'background': 'rgba(255, 255, 255, 0.8)',
                                'color': '#ff0000',
                                'width': '25px',
                                'height': '25px',
                                'border-radius': '50%',
                                'border': '0',
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'center',
                                'z-index': '1',
                                'font-size': '0.7rem',
                                'transition': '0.5s'
                            }).append($('<i>').addClass('bi bi-trash3-fill').css({
                                'font-size': '16px'
                            }));
                        var div = $('<div>').addClass('col-4 col-md-3 col-lg-2 col-photoupload').css('position', 'relative').append(
                            $('<div>').addClass('item-photoupload').css('position', 'relative').append(img).append(removeButton)
                        ).attr('data-file-name', file.name);
                        interiorPreview.append(div);
                    }
                    reader.readAsDataURL(file);
                })(i);
            }
        }

        // Event listener for exterior file input change
        exteriorInput.on('change', function() {
            var files = $(this)[0].files;
            updateExteriorPreview(files);
        });

        // Event listener for interior file input change
        interiorInput.on('change', function() {
            var files = $(this)[0].files;
            updateInteriorPreview(files);
        });

        // Example for reordering images (using SortableJS)
        // Initialize Sortable for exterior preview
        var exteriorSortable = new Sortable(exteriorPreview[0], {
            animation: 150,
            onSort: function(evt) {
                var items = evt.to.children;
                var order = [];
                for (var i = 0; i < items.length; i++) {
                    order.push($(items[i]).data('file-name'));
                }
                exteriorOrder.val(order.join(','));
            }
        });

        // Initialize Sortable for interior preview
        var interiorSortable = new Sortable(interiorPreview[0], {
            animation: 150,
            onSort: function(evt) {
                var items = evt.to.children;
                var order = [];
                for (var i = 0; i < items.length; i++) {
                    order.push($(items[i]).data('file-name'));
                }
                interiorOrder.val(order.join(','));
            }
        });

        // Handle form submission
        $('form').submit(function(e) {
            e.preventDefault();
            $('#wait').show();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '{{ route('carpostregistertestuploadsubmitPage') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#wait').hide();
                    Swal.fire({
                        title: 'Success!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Optional: Reload the page or redirect
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    $('#wait').hide();
                    var errorMessage = xhr.responseText; // Get the error message from server
                    console.error(errorMessage); // Log the error to console for debugging
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


        // Remove image functionality for exterior images
        $(document).on('click', '.box-uploadphoto:eq(0) .remove-image-btn', function() {
            var fileName = $(this).closest('.col-photoupload').attr('data-file-name');
            var fileIndex = exteriorFileData.findIndex(file => file.name === fileName);
            if (fileIndex > -1) {
                exteriorFileData.splice(fileIndex, 1); // Remove the file from exteriorFileData
            }
            $(this).closest('.col-photoupload').remove();
        });

        // Remove image functionality for interior images
        $(document).on('click', '.box-uploadphoto:eq(1) .remove-image-btn', function() {
            var fileName = $(this).closest('.col-photoupload').attr('data-file-name');
            var fileIndex = interiorFileData.findIndex(file => file.name === fileName);
            if (fileIndex > -1) {
                interiorFileData.splice(fileIndex, 1); // Remove the file from interiorFileData
            }
            $(this).closest('.col-photoupload').remove();
        });
        // Fix the CSS issue with the pseudo-element
        var style = document.createElement('style');
        style.innerHTML = `
            .item-photoupload::before {
                content: "";
                display: inline;
                width: 100%;
                padding-bottom: 70.253164557%;
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection
