<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        function validateRequiredFields() {
            var isValid = true;
            var errorMessages = [];
            var invoiceFormType = $('input[name="invoiceform"]:checked').val();

            // Check if an invoice form type is selected
            if (!invoiceFormType) {
                isValid = false;
                errorMessages.push('กรุณาเลือกประเภทการออกใบเสร็จรับเงิน/ใบกำกับภาษี');
            }
            
            // Proceed with additional validation based on selected invoice form type
            if (invoiceFormType === 'full_receipt') {
                var personType = $('input[name="person_type"]:checked').val();
                if (!personType) {
                    isValid = false;
                    errorMessages.push('กรุณาเลือกประเภทบุคคล');
                } else {
                    if (personType === 'individual') {
                        // Check if all fields in .w_people are filled
                        $('.w_people').find('input, select').each(function() {
                            if ($(this).val().trim() === '') {
                                isValid = false;
                                var label = $(this).closest('div').find('label').text().trim();
                                errorMessages.push('กรุณากรอกข้อมูล: ' + label);
                                return false; // Break out of each loop
                            }
                        });
                    } else if (personType === 'corporation') {
                        // Check if all fields in .w_office are filled
                        $('.w_office').find('input, select').each(function() {
                            if ($(this).val().trim() === '') {
                                isValid = false;
                                var label = $(this).closest('div').find('label').text().trim();
                                errorMessages.push('กรุณากรอกข้อมูล: ' + label);
                                return false; // Break out of each loop
                            }
                        });
                    }
                }
            } else if (invoiceFormType === 'short_receipt') {
                // Check if all fields in .w_invoice2 are filled
                $('.w_invoice2').find('input, select').each(function() {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        var label = $(this).closest('div').find('label').text().trim();
                        errorMessages.push('กรุณากรอกข้อมูล: ' + label);
                        return false; // Break out of each loop
                    }
                });
            }

            // Check if a donation option is selected
            var boxDonate = $('input[name="boxdonate"]:checked').val();
            if (!boxDonate) {
                isValid = false;
                errorMessages.push('กรุณาเลือกตัวเลือกการบริจาค');
            } else {
                if (boxDonate === 'donate') {
                    // Check if a donation amount is selected
                    var donation = $('select[name="donation"]').val();
                    if (!donation) {
                        isValid = false;
                        errorMessages.push('กรุณาเลือกยอดเงินที่ต้องการบริจาค');
                    }
                }
            }

            // Display all error messages
            if (errorMessages.length > 0) {
                $('.error-invoiceform').html(errorMessages.join('<br>'));
            } else {
                $('.error-invoiceform').text('');
            }

            return isValid;
        }
        document.getElementById('submit-button').addEventListener('click', function() {
            if (validateRequiredFields()) {
                var invoiceFormType = $('input[name="invoiceform"]:checked').val();
                
                // Determine which confirmation message to show based on invoiceFormType
                if (invoiceFormType === 'no_receipt') {
                    Swal.fire({
                        title: 'ยืนยันการดำเนินการ',
                        text: 'คุณแน่ใจหรือไม่ที่จะทำรายการต่อโดยไม่ต้องการรับใบกำกับภาษีหรือใบเสร็จ',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'ใช่, ดำเนินการต่อ',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('Form validation Passed');
                            // Submit the form
                            document.getElementById('cart_form').submit();
                        } else {
                            console.log('Form validation cancelled');
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'ยืนยันการดำเนินการ',
                        text: 'กรุณาตรวจสอบข้อมูลก่อนดำเนินการต่อ',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'ใช่, ดำเนินการต่อ',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // console.log('Form validation Passed');
                            // Submit the form
                            document.getElementById('cart_form').submit();
                        } else {
                            // console.log('Form validation cancelled');
                        }
                    });
                }
            } else {
                console.log('Form validation failed');
            }
        });

        $('.box_invoice input').click(function () {
            var box_invoice = $('.box_invoice').find('input:checked').attr('rel');
            if ($('.' + box_invoice).is(":hidden")) {
                $('.w_invoice1, .w_invoice2').hide();
                $('.' + box_invoice).fadeIn();
            } else {
                $('.w_invoice1, .w_invoice2').hide();
            }
        });
        $('.box_type_form input').click(function () {
            var box_type_form = $('.box_type_form').find('input:checked').attr('rel');
            if ($('.' + box_type_form).is(":hidden")) {
                $('.w_people, .w_office').hide();
                $('.' + box_type_form).fadeIn();
            } else {
                $('.w_people, .w_office').hide();
            }
        });
        $('.box-branch-type input').click(function () {
            var box_branch = $('.box-branch-type').find('input:checked').attr('rel');
            if ($('.' + box_branch).is(":hidden")) {
                $('.w_headoffice, .w_officebranch').hide();
                $('.' + box_branch).fadeIn();
            } else {
                $('.w_headoffice, .w_officebranch').hide();
            }
        });
        $('.box-donate input').click(function () {
            var box_donate = $('.box-donate').find('input:checked').attr('rel');
            if ($('.' + box_donate).is(":hidden")) {
                $('.w_donate, .w_notdonate').hide();
                $('.' + box_donate).fadeIn();
            } else {
                $('.w_donate, .w_notdonate').hide();
            }
        });
    });
</script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        function updateDisplayedPrices() {
            var price = parseFloat(document.getElementById('price').value);
            var priceNotVat = parseFloat(document.getElementById('price_not_vat').value);
            var vat = parseFloat(document.getElementById('vat').value);
            var discount = parseFloat(document.getElementById('discount').value) || 0;
            var donateInput = parseFloat(document.getElementById('donate_input').value) || 0;
            var totalResult = price - discount; // Total before donation, after discount
            var total = totalResult + donateInput; // Final total including donation

            // Update the hidden fields
            document.getElementById('total_result').value = totalResult;
            document.getElementById('total').value = total;

            document.getElementById('price_not_vat_show').textContent = '฿' + priceNotVat.toFixed(2);
            document.getElementById('vat_show').textContent = '฿' + vat.toFixed(2);
            document.getElementById('price_show').textContent = '฿' + price.toFixed(2);
            document.getElementById('discount_amount').textContent = '฿' + discount.toFixed(2);
            document.getElementById('total_show').textContent = '฿' + total.toFixed(2);

            if (donateInput > 0) {
                document.getElementById('donate_info').style.display = 'block';
                document.getElementById('donate_amount').textContent = '฿' + donateInput.toFixed(2);
                document.getElementById('total_before').textContent = '฿' + totalResult.toFixed(2);
            } else {
                document.getElementById('donate_info').style.display = 'none';
            }
        }

        function applyCoupon(data) {
            var price = parseFloat(document.getElementById('price').value);
            var discountRate = parseFloat(data.rate);
            var limitRate = parseFloat(data.limit_rate) || 0;

            // Calculate the discount amount based on the rate
            var discountAmount = price * (discountRate / 100);

            // Apply the limit_rate if it exists
            if (limitRate > 0) {
                discountAmount = Math.min(discountAmount, limitRate);
            }

            // Update the hidden fields
            document.getElementById('discount').value = discountAmount;

            // Calculate total price after applying discount
            var totalResult = price - discountAmount; // Total after discount but before donation

            document.getElementById('total_result').value = totalResult; // Update total_result

            // Add donate input to the total price
            var donateInput = parseFloat(document.getElementById('donate_input').value) || 0;
            var totalPrice = totalResult + donateInput; // Final total after donation

            document.getElementById('total').value = totalPrice; // Update total
            document.getElementById('discount_amount').textContent = '฿' + discountAmount.toFixed(2);
            document.getElementById('total_show').textContent = '฿' + totalPrice.toFixed(2);

            // Update coupon fields
            document.getElementById('coupons_id').value = data.id;
            document.getElementById('coupons_rate').value = data.rate;
            document.getElementById('coupons').value = data.name;
            document.getElementById('coupon-name').textContent = data.code;

            document.getElementById('discount_span').textContent = data.rate + '%';

            document.getElementById('coupon_info').style.display = 'block';
            document.getElementById('discount_info').style.display = 'flex';
            document.getElementById('coupon_add').style.display = 'none';
            document.querySelector('.code-warning').style.display = 'none';

            // Update displayed prices to reflect the changes
            updateDisplayedPrices();
        }

        document.getElementById('submit-code').addEventListener('click', function() {
            var code = document.getElementById('discount-code').value;

            fetch('{{ route("applyCouponAction") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    applyCoupon(data);
                } else {
                    document.querySelector('.code-warning').textContent = data.message;
                    document.querySelector('.code-warning').style.display = 'block';
                }
            });
        });

        function cancelCoupon() {
            document.getElementById('coupons_id').value = '';
            document.getElementById('coupons_rate').value = '';
            document.getElementById('coupons').value = '';
            document.getElementById('coupon-name').textContent = '';
            document.getElementById('discount_span').textContent = '';

            document.getElementById('discount').value = 0;
            document.getElementById('discount_amount').textContent = '฿0.00';

            var originalPrice = parseFloat(document.getElementById('price').value);
            document.getElementById('total_result').value = originalPrice;

            // Add donate input to the original price to calculate total
            var donateInput = parseFloat(document.getElementById('donate_input').value) || 0;
            var totalPrice = originalPrice + donateInput;

            document.getElementById('total').value = totalPrice; // Update total
            document.getElementById('total_show').textContent = '฿' + totalPrice.toFixed(2);

            updateDisplayedPrices();

            document.getElementById('coupon_add').style.display = 'block';
            document.getElementById('coupon_info').style.display = 'none';
            document.getElementById('discount_info').style.display = 'none';
            document.querySelector('.code-warning').style.display = 'none';
        }

        document.querySelector('.btn-del-code').addEventListener('click', function() {
            cancelCoupon();
        });

        function calculateInitialPrices() {
            updateDisplayedPrices();
        }

        calculateInitialPrices();

        // Handle changes to the donation select box
        document.querySelector('select[name="donation"]').addEventListener('change', function() {
            var donateInput = document.getElementById('donate_input');
            var donationValue = this.value || '0'; // Use '0' if empty
            
            donateInput.value = donationValue;
            
            // Update displayed prices to reflect any changes
            updateDisplayedPrices();
        });

        // Handle the 'notdonate' radio button click
        document.getElementById('notdonate').addEventListener('click', function() {
            var donationSelect = document.querySelector('select[name="donation"]');
            var donateInput = document.getElementById('donate_input');

            donationSelect.value = ''; // Reset to "กรุณาเลือก"
            donateInput.value = '0'; // Reset donate_input to 0

            // Update displayed prices to reflect the changes
            updateDisplayedPrices();
        });
    });
</script>








<script>
    $(document).ready(function() {
        // Function to update districts based on selected province
        function updateDistricts(provinceSelector, districtSelector) {
            $(provinceSelector).on('change', function() {
                var provinceId = $(this).val();
                $.ajax({
                    url: "{{ route('cartselectdistrict') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        province_id: provinceId
                    },
                    success: function(response) {
                        $(districtSelector).html(response);
                        $(districtSelector).trigger('change'); // Trigger change to update subdistricts
                    }
                });
            });
        }

        // Function to update subdistricts based on selected district
        function updateSubdistricts(districtSelector, subdistrictSelector) {
            $(districtSelector).on('change', function() {
                var districtId = $(this).val();
                $.ajax({
                    url: "{{ route('cartselectsubdistrict') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        district_id: districtId
                    },
                    success: function(response) {
                        $(subdistrictSelector).html(response);
                    }
                });
            });
        }

        // Individual form
        updateDistricts('#individual_province', '#individual_district');
        updateSubdistricts('#individual_district', '#individual_subdistrict');

        // Corporation form
        updateDistricts('#corporation_province', '#corporation_district');
        updateSubdistricts('#corporation_district', '#corporation_subdistrict');

        // Short receipt form
        updateDistricts('#short_province', '#short_district');
        updateSubdistricts('#short_district', '#short_subdistrict');
    });
</script>