@extends('../frontend/layouts/layout')

@section('subhead')
    <title>Package - รถพร้อมขาย</title>
@endsection

@section('content')

<section class="row">
    <div class="col-12 bg-package">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="title-pricing">Pricing</h2>
                        <div class="tab-menu-pricing">
                            <a href="package.php" class="btn-menu-pricing">ประสิทธิภาพการทำงานมาตรฐาน</a>
                            <div class="btn-menu-pricing active">ประสิทธิภาพสูง</div>
                        </div>
                        <div class="sub-topic-pricing">
                            <h3>ลงขายสำหรับธุรกิจขนาดใหญ่</h3>
                            <p>กรุณากรอกแบบฟอร์มด้านล่าง ทางทีมงานจะติดต่อกลับไปโดยเร็วที่สุด</p>
                        </div>
                    </div>
                    <div class="form-package-contact">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <label>ชื่อ - นามสกุล <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-package-contact">
                                        <label>เบอร์โทรศัพท์ที่ติดต่อได้ <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-package-contact">
                                        <label>Line ID <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <label>ชื่อธุรกิจ <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <div class="form-check">
                                            <input type="checkbox" id="exampleCheck1" checked>
                                            <label for="exampleCheck1">ข้าพเจ้ายอมรับในการเก็บรวบรวม ใช้ เปิดเผย และเก็บรักษาข้อมูลส่วนบุคคล</label>
                                        </div>
                                        <button class="btn-default btn-red">ขอนัดทีมงานให้ติดต่อกลับ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    // Add any additional JavaScript needed
</script>
@endsection
