@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-step1</title>
@endsection

@section('content')


<style>
    #image-preview {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .item-photoupload {
        margin: 5px;
        cursor: move;
        box-sizing: border-box;
        position: relative;
        transition: transform 0.2s ease; /* ลดความ sensitive */
        z-index: 1;
    }


    .item-photoupload {
        cursor: move;
    }

    #image-preview-exterior {
        min-height: 100px; /* กำหนดความสูงของ droppable area */
        border: 2px dashed #ccc; /* กำหนดเส้นขอบของ droppable area */
        padding: 10px; /* เพิ่ม padding เพื่อให้สามารถลากและวางได้ง่ายขึ้น */
    }



    /* CSS */
    .dropzone {
        min-height: 0px;
        border: 0px solid rgba(0,0,0,.3);
        background: #fff;
        padding: 0px 0px;
    }

    .dropzone .dz-preview {
        position: relative;
        display: inline-block;
        vertical-align: top;
        margin: 8px;
        border: 0px solid #ebebeb;
        background: #f9f9f9;
        padding: 8px;
        text-align: center;
    }

    .dropzone .dz-preview .dz-remove {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 11px;
        color: white;
        background-color: lightgray;
        border: none;
        z-index: 100000;
        border-radius: 50%; /* เพิ่มบรรทัดนี้เพื่อทำให้มีรูปวงกลม */
        width: 25px; /* Adjust width and height for the desired size */
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* opacity: 90%; */
    }

    .dropzone .dz-remove:hover {
        color: red;
    }

    .dz-details {
        display: none;
    }

    .dz-button {
        display: none;
    }

    .dropzone .dz-remove i {
    /* Style for the trash icon */
        color: white;
    }
    .bi {
        line-height: 2.2;
    }

    .dropzone .dz-remove:hover {
        /* Add hover effect if needed */
        background-color: darkred;
    }
</style>
<div id="wait" class="box-waiting " style="display:none;"><div class="waiting-wrapper-image"><img src="{{asset('uploads/wait.gif')}}" /></div></div>

<h1>||</h1>
<div class="container">
    <!-- Dropzone Form for Image Upload -->
    <form action="{{ route('upload.image') }}" class="dropzone" id="image-dropzone"></form>

    <!-- Main Form for Post Creation -->
    <form id="post-form" method="POST" action="{{ route('post.store') }}">
        @csrf
        <!-- Other form fields -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" required></textarea>
        </div>

        <input type="hidden" name="images" id="images-input">
        <button type="submit">Submit</button>
    </form>
</div>
<h1>||</h1>

<form method="POST" id="regis" action="{{route('carpostregistertestuploadsubmitPage')}}" enctype="multipart/form-data">
    @csrf
    <div id="topontop"></div>


    <div id="step3" >

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
                                                <div>
                                                    <div class="box-uploadphoto">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload1.svg')}}" alt=""> รูปภายนอกรถ</div>
                                                        <div><label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถยนต์<span>*</span></label></div>

                                                        

                                                        <div class="row row-photoupload">
                                                            
                                                            <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                                <div class="item-photoupload">
                                                                    <button><i class="bi bi-trash3-fill"></i></button>
                                                                    <img src="images/Rectangle 2330.jpg" alt="">
                                                                </div>
                                                            </div>

                                                        </div>





                                                        <div class="btn-uploadimg">
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="frm-step-button text-center">
                                    <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                    <button type="submit" class="btn btn-step btn-nextstep" id="submit-btn">สร้าง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</form>






@endsection

@section('script')
<script>
    // Initialize Dropzone
    Dropzone.options.imageDropzone = {
        paramName: "file",
        maxFilesize: 10, // MB
        parallelUploads: 10,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        success: function (file, response) {
            console.log(response); // Handle the server response
            // Save the response (image URL) for later use in the form submission
            let imagesInput = document.getElementById('images-input');
            let currentImages = imagesInput.value ? JSON.parse(imagesInput.value) : [];
            currentImages.push(response.url);
            imagesInput.value = JSON.stringify(currentImages);
        }
    };

    // Handle form submission
    document.getElementById('post-form').addEventListener('submit', function (e) {
        e.preventDefault();
        this.submit();
    });

</script>


@endsection