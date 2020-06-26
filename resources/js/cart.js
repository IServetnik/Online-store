$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        sendAjax(btn, function (response) {
            $('#response').text("Product successfully added to cart").addClass("text-success");
        }, function (jqXHR) {
            $('#response').text("Product has not been added to cart").addClass("text-danger");
        });
    });


    $('.delete-from-cart').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        sendAjax(btn, function(response) {
            $('#response').text("Product successfully deleted from cart").addClass("text-success");
            btn.parent().parent().remove();
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });


    $('.increase-quantity').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        sendAjax(btn, function(response) {
            $('#response').text("The quantity of products in the cart increased").addClass("text-success");
            var quantity = btn.siblings('span.product-quantity');
            var quantityText = quantity.text();
            quantity.text(++quantityText);

            $('#total-price').text(response.totalPrice.toFixed(3));
        }, function(jqXHR) {
            $('#response').text("The quantity of products in the cart has not increased").addClass("text-danger");
        });
    });


    $('.decrease-quantity').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        sendAjax(btn, function(response) {
            $('#response').text("The quantity of products in the cart decreased").addClass("text-success");

            if(response.quantity === 0) {
                btn.parent().parent().remove();
            } else {
                var quantity = btn.siblings('span.product-quantity');
                var quantityText = quantity.text();
                quantity.text(--quantityText);
            }

            $('#total-price').text(response.totalPrice.toFixed(3));
        }, function(jqXHR) {
            $('#response').text("The quantity of products in the cart has not decreased").addClass("text-danger");
        });
    });
});




var processing = false; 
function sendAjax(btn, success_callback, error_callback) {
    if(!processing){
        processing = true;
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
                processing = false;
                success_callback(response);
            },
            error: function (jqXHR) {
                processing = false;
                error_callback(jqXHR);
            }
        })
    }
}