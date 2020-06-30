var processing = false; 

function sendAjax(input, success_callback, error_callback) {
    if(!processing){
        processing = true;
        updateUrl(input);

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location.href,
            type: 'GET',
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


function updateUrl(input) {
    var url = window.location.href.split('?')[0];
    var inputSerialize = input.val() ? input.serialize()+"&" : '';

    var params = window.location.search.substr(1);
    if(input.attr('type') == 'checkbox') {
        if(!input.is(":checked")) {
            params = params.replace(new RegExp(encodeURI(input.prop('name')+"="+input.val()+"&?")), '');
            var urlParams = "?"+params;
        } else {
            var urlParams = "?"+inputSerialize+params;
        }
    }else {
        params = params.replace(new RegExp(input.attr('id')+"="+"[^&]*&?"), '');
        var urlParams = "?"+inputSerialize+params;
    }
    
    window.history.pushState({},"IS", url+urlParams);
}
function updateProducts(response) {
    var page = $(response);
    var table = $('.products', page);
    $(".products").replaceWith(table);

    var pagination = $('.div-pagination', page);
    $(".div-pagination").replaceWith(pagination);
}






$(document).ready(function() {
    $('#min_price').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });

    $('#max_price').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });

    $('#discount').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });

    $('.color').change(function(e) {
        var checkbox = $(this);

        sendAjax(checkbox, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });

    $('#brand').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });

    $('#name').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Product has not been deleted from cart").addClass("text-danger");
        });
    });
});