@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-step1</title>
@endsection

@section('content')


<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 45px;
        user-select: none;
        -webkit-user-select: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 9px;
        right: 12px;
        width: 20px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 43px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 17px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

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
                                                    <div class="box-uploadphoto">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload2.svg')}}" alt=""> รูปห้องโดยสาร</div>
                                                        <div><label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label></div>
                                                        
                                                        <div id="interior-dropzone" class="dropzone interior-dropzone">

                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                        </div>
                                                    </div>
                                                    <div class="box-uploadphoto dealerlicenseplate">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload3.svg')}}" alt=""> เล่มทะเบียนรถ</div>
                                                        <div><label>เอกสารชุดนี้จะไม่แสดงในโพสต์<span>*</span></label></div>
                                                        
                                                        <div id="licenseplate-dropzone" class="dropzone licenseplate-dropzone">
                                                            
                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <input aria-labelledby="licenseplate_pictures_label" type="button" name="licenseplate_pictures" id="licenseplate_pictures">
                                                            <i class="bi bi-plus-circle-fill"></i> เพิ่มสำเนา/เล่มทะเบียนรถ
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



@endsection