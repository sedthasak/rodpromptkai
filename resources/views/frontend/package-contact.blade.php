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
                            <a href="{{route('packagePage')}}" class="btn-menu-pricing">ประสิทธิภาพการทำงานมาตรฐาน</a>
                            <div class="btn-menu-pricing active">ประสิทธิภาพสูง</div>
                        </div>
                        <div class="sub-topic-pricing">
                            <h3>ลงขายสำหรับธุรกิจขนาดใหญ่</h3>
                            <p>กรุณากรอกแบบฟอร์มด้านล่าง ทางทีมงานจะติดต่อกลับไปโดยเร็วที่สุด</p>
                        </div>
                    </div>
                    <div class="form-package-contact">
                        <form id="packageContactForm">
                            @csrf <!-- Include CSRF token for security -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <label>ชื่อ - นามสกุล <span>*</span></label>
                                        <input type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-package-contact">
                                        <label>เบอร์โทรศัพท์ที่ติดต่อได้ <span>*</span></label>
                                        <input type="text" name="phone" id="phone" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-package-contact">
                                        <label>Line ID</label>
                                        <input type="text" name="line" id="line">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <label>ชื่อธุรกิจ</label>
                                        <input type="text" name="business_name" id="business_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="box-package-contact">
                                        <div class="form-check">
                                            <input type="checkbox" id="exampleCheck1" checked>
                                            <label for="exampleCheck1">ข้าพเจ้ายอมรับในการเก็บรวบรวม ใช้ เปิดเผย และเก็บรักษาข้อมูลส่วนบุคคล</label>
                                        </div>
                                        <button type="submit" class="btn-default btn-red" id="submitBtn">ขอนัดทีมงานให้ติดต่อกลับ</button>
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
    $(document).ready(function () {
        // Handle form submission
        $('#packageContactForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: '{{ route("submitPackageContact") }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Show success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.success,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Optionally clear the form or redirect
                            $('#packageContactForm')[0].reset();
                        }
                    });
                },
                error: function (xhr) {
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while saving the data. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection
