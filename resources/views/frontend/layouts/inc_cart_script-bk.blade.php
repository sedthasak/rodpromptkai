
<script type="text/javascript">
    $('.box_invoice input').click(function () {
        var box_invoice = $('.box_invoice').find('input:checked').attr('rel');
            if (  $('.'+box_invoice).is( ":hidden" ) ) {
                $('.w_invoice1, .w_invoice2').hide();
                $('.'+box_invoice).fadeIn();
            }else{
                $('.w_invoice1, .w_invoice2').hide();
            }
    }); 
    $('.box_type_form input').click(function () {
        var box_type_form = $('.box_type_form').find('input:checked').attr('rel');
            if (  $('.'+box_type_form).is( ":hidden" ) ) {
                $('.w_people, .w_office').hide();
                $('.'+box_type_form).fadeIn();
            }else{
                $('.w_people, .w_office').hide();
            }
    }); 
    $('.box-branch-type input').click(function () {
        var box_branch = $('.box-branch-type').find('input:checked').attr('rel');
            if (  $('.'+box_branch).is( ":hidden" ) ) {
                $('.w_headoffice, .w_officebranch').hide();
                $('.'+box_branch).fadeIn();
            }else{
                $('.w_headoffice, .w_officebranch').hide();
            }
    }); 
    $('.box-donate input').click(function () {
        var box_donate = $('.box-donate').find('input:checked').attr('rel');
            if (  $('.'+box_donate).is( ":hidden" ) ) {
                $('.w_donate, .w_notdonate').hide();
                $('.'+box_donate).fadeIn();
            }else{
                $('.w_donate, .w_notdonate').hide();
            }
    }); 


    // Function to update displayed prices based on hidden inputs
    function updateDisplayedPrices() {
        var price = parseFloat(document.getElementById('price').value);
        var priceNotVat = parseFloat(document.getElementById('price_not_vat').value);
        var vat = parseFloat(document.getElementById('vat').value);
        var discount = parseFloat(document.getElementById('discount').value);
        var total = parseFloat(document.getElementById('total').value);

        document.getElementById('price_not_vat_show').textContent = '฿' + priceNotVat.toFixed(2);
        document.getElementById('vat_show').textContent = '฿' + vat.toFixed(2);
        document.getElementById('price_show').textContent = '฿' + price.toFixed(2);
        document.getElementById('discount_amount').textContent = '฿' + discount.toFixed(2);
        document.getElementById('total_show').textContent = '฿' + total.toFixed(2);
    }

    // Function to show coupon info section and update UI after applying coupon
    function applyCoupon(data) {
        document.getElementById('coupons_id').value = data.coupon_id;
        document.getElementById('coupons_rate').value = data.rate;
        document.getElementById('coupons').value = data.name;

        document.getElementById('coupon-name').textContent = data.name;

        // Calculate discount amount
        var price = parseFloat(document.getElementById('price').value);
        var discountRate = parseFloat(data.rate);
        var discountAmount = price * (discountRate / 100);

        // Update discount amount in hidden field
        document.getElementById('discount').value = discountAmount;

        // Update discount amount in UI
        document.getElementById('discount_amount').textContent = '฿' + discountAmount.toFixed(2);

        // Update total price after discount
        var totalPrice = price - discountAmount;

        // Update total price in hidden field
        document.getElementById('total').value = totalPrice;

        // Update total price in UI
        document.getElementById('total_show').textContent = '฿' + totalPrice.toFixed(2);

        // Show coupon info section
        document.getElementById('coupon_info').style.display = 'block';

        // Show discount info section
        document.getElementById('discount_info').style.display = 'flex';

        // Hide coupon add section
        document.getElementById('coupon_add').style.display = 'none';

        // Show success message and hide error message
        document.querySelector('.code-success').style.display = 'block';
        document.querySelector('.code-error').style.display = 'none';
    }

    // Event listener for applying a coupon
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
                // Show error message and hide success message
                document.querySelector('.code-success').style.display = 'none';
                document.querySelector('.code-error').style.display = 'block';
            }
        });
    });

    // Function to cancel coupon and update UI
    function cancelCoupon() {
        // Clear coupon details
        document.getElementById('coupons_id').value = '';
        document.getElementById('coupons_rate').value = '';
        document.getElementById('coupons').value = '';
        document.getElementById('coupon-name').textContent = '';

        // Reset discount amount to zero in hidden field
        document.getElementById('discount').value = 0;

        // Update discount amount to zero in UI
        document.getElementById('discount_amount').textContent = '฿0.00';

        // Update total price back to original price
        var originalPrice = parseFloat(document.getElementById('price').value);
        document.getElementById('total').value = originalPrice;
        document.getElementById('total_show').textContent = '฿' + originalPrice.toFixed(2);

        // Show coupon add section
        document.getElementById('coupon_add').style.display = 'block';

        // Hide coupon info section
        document.getElementById('coupon_info').style.display = 'none';

        // Hide discount info section
        document.getElementById('discount_info').style.display = 'none';
    }

    // Event listener for canceling a coupon
    document.querySelector('.btn-del-code').addEventListener('click', function() {
        cancelCoupon();
    });

    // Function to calculate initial prices on page load
    function calculateInitialPrices() {
        updateDisplayedPrices(); // Update displayed prices when page loads
    }

    // Call the function to calculate initial prices on page load
    calculateInitialPrices();
</script>