$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();

        var btn = $(this);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {
                name: btn.data('product-name'),
            },
            success: function (response) {
                $('#response').text("Product successfully added to cart").addClass("text-success");
            },
            error: function (jqXHR) {
                $('#response').text("Product has not been added to cart").addClass("text-danger");
            }
        })
    });


    $('.delete-from-cart').click(function(e) {
        e.preventDefault();

        var btn = $(this);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {
                name: btn.parent().data('product-name'),
            },
            success: function (response) {
                $('#response').text("Product successfully deleted from cart").addClass("text-success");
                btn.parent().parent().remove();
            },
            error: function (jqXHR) {
                $('#response').text("Product has not been deleted from cart").addClass("text-danger");
            }
        })
    });


    $('.increase-quantity').click(function(e) {
        e.preventDefault();

        var btn = $(this);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {
                name: btn.parent().data('product-name'),
            },
            success: function (response) {
                $('#response').text("The quantity of products in the cart increased").addClass("text-success");
                var quantity = btn.siblings('span.product-quantity');
                var quantityText = quantity.text();
                quantity.text(++quantityText);
            },
            error: function (jqXHR) {
                $('#response').text("The quantity of products in the cart has not increased").addClass("text-danger");
            }
        })
    });


    $('.decrease-quantity').click(function(e) {
        e.preventDefault();

        var btn = $(this);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {
                name: btn.parent().data('product-name'),
            },
            success: function (response) {
                $('#response').text("The quantity of products in the cart decreased").addClass("text-success");

                if(response.quantity === 1) {
                    btn.parent().parent().remove();
                } else {
                    var quantity = btn.siblings('span.product-quantity');
                    var quantityText = quantity.text();
                    quantity.text(--quantityText);
                }
            },
            error: function (jqXHR) {
                $('#response').text("The quantity of products in the cart has not decreased").addClass("text-danger");
            }
        })
    });
});