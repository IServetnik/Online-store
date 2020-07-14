var processing = false; 
function sendAjax(btn, size_name, success_callback, error_callback) {
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
                name: btn.data('product-name'),
                size_name: size_name,
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





$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        var btn = $(this);

        var checkboxes = $('input.size-'+btn.parent().parent().data('product-name')+':checked');
        if(checkboxes.length == 0) {
            $('#response').text("You did not select a size").addClass("text-danger");
        } else {
            var size_name = $('input.size-'+btn.parent().parent().data('product-name')+':checked').map(function(){
                                                                return this.value;
                                                            }).get();
            sendAjax(btn, size_name, function (response) {
                checkboxes.each(function(index, value) {
                    $(value).prop('checked', false);
                });

                $('#response').text("Product successfully added to cart").addClass("text-success");
                $('#total-price').text(response.totalPrice.toFixed(3));
            }, function (jqXHR) {
                $('#response').text("Product has not been added to cart").addClass("text-danger");
            });
        }
    });


    $('.delete-from-cart').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        var size_name = btn.parent().parent().data('size');
        sendAjax(btn, size_name, function(response) {
            $('#response').text("Product successfully deleted from cart").addClass("text-success");
            btn.parent().parent().remove();

            $('#total-price').text(response.totalPrice.toFixed(3));
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });


    $('.increase-quantity').click(function(e) {
        e.preventDefault();
        var btn = $(this);

        var size_name = btn.parent().parent().data('size');
        sendAjax(btn, size_name, function(response) {
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

        var size_name = btn.parent().parent().data('size');
        sendAjax(btn, size_name, function(response) {
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