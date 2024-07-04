@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-upload-image</title>
@endsection

@section('content')
<div class="container">
    <h2>Upload and Reorder Images</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('carpostregistertestuploadsubmitPage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" id="imageInput" name="images[]" multiple>
        <div id="imagePreview" class="d-flex flex-wrap"></div>
        <input type="hidden" name="imageOrder" id="imageOrder">
        <button type="submit" class="btn btn-primary">Upload Images</button>
    </form>

    @if(isset($images) && count($images) > 0)
        <h3>Uploaded Images</h3>
        <div class="uploaded-images d-flex flex-wrap">
            @foreach ($images as $index => $image)
                <div class="img-container m-2">
                    <p class="order-number">Order: {{ $index + 1 }}</p>
                    <p>{{ basename($image['path']) }}</p>
                    <img src="{{ asset($image['url']) }}" class="img-thumbnail" style="width: 150px;">
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var imageInput = $('#imageInput');
        var imagePreview = $('#imagePreview');
        var imageOrder = $('#imageOrder');
        var fileData = [];

        // Function to update the image preview
        function updateImagePreview(files) {
            imagePreview.empty();
            fileData = []; // Reset file data

            for (var i = 0; i < files.length; i++) {
                (function(index) {
                    var file = files[index];
                    fileData.push(file); // Store file data
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var orderLabel = $('<p>').text('Order: ' + (index + 1)).addClass('order-number');
                        var fileName = $('<p>').text(file.name); // Show only filename
                        var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail m-2').css('width', '150px');
                        var div = $('<div>').addClass('img-container').append(orderLabel).append(fileName).append(img);
                        imagePreview.append(div);
                    }
                    reader.readAsDataURL(file);
                })(i);
            }
        }

        // Handle image input change
        imageInput.on('change', function(e) {
            var files = e.target.files;
            updateImagePreview(files);

            // Initialize SortableJS on imagePreview
            new Sortable(imagePreview[0], {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    console.log('Moved item from index', evt.oldIndex, 'to index', evt.newIndex);
                    
                    // Update order labels
                    imagePreview.children().each(function(index, element) {
                        $(element).find('.order-number').text('Order: ' + (index + 1));
                    });

                    // Capture the new order
                    var order = [];
                    imagePreview.children().each(function(index, element) {
                        order.push($(element).find('img').attr('src'));
                    });
                    imageOrder.val(order.join(','));
                    console.log('Current order:', order);
                },
            });
        });

        // Handle form submission
        $('form').submit(function(e) {
            e.preventDefault();

            var order = [];
            imagePreview.children().each(function(index, element) {
                var src = $(element).find('img').attr('src');
                var fileIndex = fileData.findIndex(file => URL.createObjectURL(file) === src);
                if (fileIndex > -1) {
                    order.push(fileData[fileIndex]);
                }
            });

            var formData = new FormData(this);
            for (var i = 0; i < order.length; i++) {
                formData.append('images[]', order[i]);
            }

            // Log formData contents for debugging
            // formData.forEach((value, key) => {
            //     if (value instanceof File) {
            //         console.log(key + ':', value.name); // Log file names instead of base64 data URLs
            //     } else {
            //         console.log(key + ':', value);
            //     }
            // });
            $.ajax({
                url: '{{ route('carpostregistertestuploadsubmitPage') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });


        });
    });
</script>
@endsection
