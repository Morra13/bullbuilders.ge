<?php
/** @var \App\Models\User $user */
/** @var \App\Models\Instruction $instruction */
?>
<div id="smart-button-container">
    <div style="text-align: center;">
        <div id="paypal-button-container"></div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID', 'sb')}}&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"
></script>
<script>
    var email = $("#input-email");

    email.keyup(function() {
        checkEmail();
    });

    /**
     * Check email
     */
    function checkEmail() {
        $.ajax({
            url: "{{route(\App\Http\Controllers\Api\ValidationController::ROUTE_EMAIL_CORRECT)}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify({'email': email.val()})
        })
            .done(function( data ) {
                if (data.result == 'error') {
                    email.addClass('text-danger');
                    email.parent().closest('.form-group').addClass('has-danger');
                    email.parent().parent().find('.invalid-feedback').removeClass('d-none');
                    email.parent().parent().find('.invalid-feedback').html(data.message);
                } else {
                    email.removeClass('text-danger');
                    email.parent().closest('.form-group').removeClass('has-danger');
                    email.parent().parent().find('.invalid-feedback').addClass('d-none');
                }
            });
    }

    $("#buy-now").click(function() {
        $.ajax({
            url: "{{route(\App\Http\Controllers\Api\TransactionController::ROUTE_CREATE)}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify({ 'instruction_id': $('#instruction_id').val(), 'email': email.val()})
        })
            .done(function( data ) {
                if (data.result == 'error') {
                    $('#form-error').html(data.message);
                } else {
                    $('#form-error').html('');
                    $('#form-container').addClass('d-none');
                    $('#paypal-container').removeClass('d-none');
                    $('#transaction_id').val(data.transaction_id);
                }
            });
    });

    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{"amount":{"currency_code":"USD","value":{{$instruction->price}}}}]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    $('#paypal-container').addClass('d-none');
                    $('#loader').removeClass('d-none');

                    $.ajax({
                        url: "{{route(\App\Http\Controllers\Api\TransactionController::ROUTE_SUCCESS)}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        data: JSON.stringify({ 'transaction_id': $('#transaction_id').val(), 'payment_data': orderData})
                    })
                        .done(function( data ) {
                            if (data.result == 'error') {
                                // Show a success message within this page, e.g.
                                actions.redirect('https://creatory.pro/transaction/error/' + $('#transaction_id').val() + '?error=' + data.message);
                            } else {
                                actions.redirect('https://creatory.pro/transaction/success/' + $('#transaction_id').val());
                            }
                        });
                });
            },

            onError: function(err) {

                $('#paypal-container').addClass('d-none');
                $('#loader').removeClass('d-none');

                $.ajax({
                    url: "{{route(\App\Http\Controllers\Api\TransactionController::ROUTE_ERROR)}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify({ 'transaction_id': $('#transaction_id').val(), 'payment_data': err})
                })
                    .done(function( data ) {
                        actions.redirect('https://creatory.pro/transaction/error/' + $('#transaction_id').val());
                    });
            }
        }).render('#paypal-button-container');
    }

    initPayPalButton();
</script>
