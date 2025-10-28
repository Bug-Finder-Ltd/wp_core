jQuery(document).ready(function($){
    // Open modal
    $('body').on('click', '.nd-payment-details-btn', function(e){

        e.preventDefault();

        var paymentId = $(this).data('id');

        $.post(ajaxurl, { action: 'nd_get_payment_details', payment_id: paymentId }, function(response){
            if(response.success){
                $('body').append(response.data.html);
                $('.nd-payment-modal').fadeIn();
            } else {
                alert('Could not fetch payment details.');
            }
        });
    });

    // Close modal
    $('body').on('click', '.nd-payment-modal .close-btn', function(){
        $('.nd-payment-modal').fadeOut(function(){
            $(this).remove();
        });
    });

    // Approve
    $('body').on('click', '.nd-payment-modal .approve-btn', function(){
        var paymentId = $(this).data('id');
        var feedback  = $('.nd-payment-modal .feedback').val();

        $.post(ajaxurl, {
            action: 'nd_update_payment_status',
            payment_id: paymentId,
            status: 'succeeded',
            feedback: feedback
        }, function(response){
            if(response.success){
                alert('Payment Approved');
                location.reload(); // reload to update table
            } else {
                alert('Failed to update payment.');
            }
        });
    });

    // Reject
    $('body').on('click', '.nd-payment-modal .reject-btn', function(){
        var paymentId = $(this).data('id');
        var feedback  = $('.nd-payment-modal .feedback').val();

        $.post(ajaxurl, {
            action: 'nd_update_payment_status',
            payment_id: paymentId,
            status: 'rejected',
            feedback: feedback
        }, function(response){
            if(response.success){
                alert('Payment Rejected');
                location.reload();
            } else {
                alert('Failed to update payment.');
            }
        });
    });
});
