$(document).ready(function() {

    loadCart();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function(response) {
                $('.cart-count').html(response.count);
            }
        });
    }

    $(document).on('click', '.addToCartbtn', function(event) {
        event.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty
            },
            success: function(response) {
                swal("", response.status, "success");
                loadCart();
            }
        });
    });

    $(document).on('click', '.increment-btn', function(event) {
        event.preventDefault();

        var input = $(this).siblings('.qty-input');
        var value = parseInt(input.val());
        if (value < 10) {
            input.val(value + 1);
        }
    });

    $(document).on('click', '.decrement-btn', function(event) {
        event.preventDefault();

        var input = $(this).siblings('.qty-input');
        var value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1);
        }
    });

    $(document).on('click', '.delete-cart-item', function(event) {
        event.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method: "POST",
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id
            },
            success: function(response) {
                loadCart();
                $('.cartitems').load(location.href + " .cartitems");
                swal("", response.status, "success");
            }
        });
    });

    $(document).on('click', '.changeQuantity', function(event) {
        event.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        var data = {
            'prod_id': prod_id,
            'prod_qty': qty
        };

        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: data,
            success: function(response) {
                $('.cartitems').load(location.href + " .cartitems");
            }
        });
    });

});

