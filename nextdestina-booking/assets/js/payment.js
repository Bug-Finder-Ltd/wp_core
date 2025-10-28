jQuery(document).ready(function($) {
    const $form = $('#booking-form');

    if ($form.length) {
        const $totalPriceField = $('input[name="total_price"]');
        const totalPrice = $totalPriceField.length ? $totalPriceField.val() : 0;
        let paypalRendered = false;

        $form.on('submit', function(e) {
            e.preventDefault();

            Notiflix.Loading.standard('Submitting your booking...');

            const $paymentMethodInputs = $('input[name="payment_method"]');
            const $paymentMethodField = $('input[name="payment_method"]:checked');

            // CASE 1: No payment methods available → book without payment

            if (!$paymentMethodInputs.length) {
                const formData = new FormData(this);
                formData.append('action', 'booking_without_payment');

                fetch(bookingData.ajax_url, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(response => {
                    Notiflix.Loading.remove();
                    if (response.success) {
                        window.location.href = bookingData.thank_you_url;
                    } else {
                        alert('Booking failed: ' + response.message);
                    }
                })
                .catch(err => {
                    Notiflix.Loading.remove();
                    console.error('Booking error:', err);
                    alert('An error occurred while processing your booking.');
                });

                return; // stop here
            }

            // CASE 2: Payment methods exist but none selected

            if (!$paymentMethodField.length) {
                Notiflix.Loading.remove();
                alert("Please select a payment method.");
                return;
            }

            const paymentMethod = $paymentMethodField.val().trim().toLowerCase();

            if (paymentMethod === 'stripe') {
                if ($form.data('stripeCreated') === true) {
                    return;
                }
                $form.data('stripeCreated', true);

                const formData = new FormData(this);
                formData.append('action', 'create_stripe_checkout');

                fetch(bookingData.ajax_url, {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    return Stripe(bookingData.stripe_key).redirectToCheckout({ sessionId: data.id });
                })
                .catch(err => {
                    $form.data('stripeCreated', false);
                    console.error("Stripe error:", err);
                    Notiflix.Loading.remove();
                });

            } else if (paymentMethod === 'paypal') {
                const $container = $('#paypal-button-container');
                $container.show();

                if (!paypalRendered) {
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{ amount: { value: totalPrice } }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function() {
                                const formData = new FormData($form[0]);
                                formData.append('action', 'nextdestina_process_paypal_payment');
                                formData.append('orderID', data.orderID);

                                fetch(bookingData.ajax_url, {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(response => {
                                    if (response.success) {
                                        window.location.href = bookingData.thank_you_url;
                                    } else {
                                        alert('Payment failed: ' + response.message);
                                    }
                                });
                            });
                        },
                        onCancel: function() {
                            alert('Payment was canceled by the user.');
                        },
                        onError: function(err) {
                            console.error('PayPal error:', err);
                            alert('An error occurred during the PayPal transaction.');
                        }
                    }).render('#paypal-button-container');

                    paypalRendered = true;

                    setTimeout(() => {
                        const $iframe = $('#paypal-button-container iframe');
                        if ($iframe.length) {
                            $iframe[0].scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 500);

                } else {
                    alert("Please complete the PayPal payment below.");
                }

            } else {
                const formData = new FormData($form[0]);
                formData.append('action', 'nextdestina_process_manual_payment');
                formData.append('manual_method', paymentMethod);

                fetch(bookingData.ajax_url, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        window.location.href = bookingData.thank_you_url;
                    } else {
                        alert('Failed: ' + response.message);
                    }
                })
                .catch(err => {
                    console.error('Manual payment error:', err);
                    alert('An error occurred while processing your booking.');
                });
            }
        });
    }
});

/*
 * Payment Charge
 */

jQuery(document).ready(function ($) {

    // Manual payment form

    function hideShowPaymentForm(payment_method){
        if(payment_method == 'stripe' || payment_method == 'paypal'){
         $('.payment-extra-fields').hide().find('input, textarea, select').prop('disabled', true);
       } else {
        $('.payment-extra-fields').show().find('input, textarea, select').prop('disabled', false);
       }
    }

    var selectedMethod = $('input[name="payment_method"]:checked').val();
    hideShowPaymentForm(selectedMethod);

    $(document).on('change', 'input[name="payment_method"]', function(){

        let payment_method = $(this).val();
        hideShowPaymentForm(payment_method);
    });

    // Only run if base price exists
    
    if ($("#base-price").length) {
        function updateSummary() {
            let basePrice = parseFloat($("#base-price").data("price"));
            if (isNaN(basePrice)) {
                console.error('Base price is not a valid number:', $("#base-price").data("price"));
                return;
            }

            // Get selected payment method, default to first if none selected
            let method = $("input[name='payment_method']:checked").val();
            if (!method) {
                method = $("input[name='payment_method']").first().val();
                $("input[name='payment_method']").first().prop('checked', true);
            }

            // Ensure paymentCharges exists
            window.paymentCharges = window.paymentCharges || {};

            // If method is missing, default charges to 0
            let chargeData = paymentCharges[method] || { percentage: 0, fixed: 0 };

            let percentage = parseFloat(chargeData.percentage) || 0;
            let fixed = parseFloat(chargeData.fixed) || 0;

            let gatewayCharge = (basePrice * (percentage / 100)) + fixed;
            let finalTotal = basePrice + gatewayCharge;

            $("#gateway-charge").text("$" + gatewayCharge.toFixed(2));
            $("#final-total").text("$" + finalTotal.toFixed(2));
        }

        // Update summary on payment method change
        $("input[name='payment_method']").on("change", updateSummary);

        // Initial calculation
        updateSummary();
    }
});
