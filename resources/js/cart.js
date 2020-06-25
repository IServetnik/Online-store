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
                name: btn.data('product-name'),
            },
            success: function (response) {
                $('#response').text("Product successfully deleted from cart").addClass("text-success");
                $("[data-product-name="+btn.data('product-name')+"]").remove();
            },
            error: function (jqXHR) {
                $('#response').text("Product has not been deleted from cart").addClass("text-danger");
            }
        })
    });
});