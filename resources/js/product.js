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
    } else if(input.is('a')) {
        var inputs = $(".filter input[type=text]");
        inputs.val("");
        var checkbox = $(".filter input[type=checkbox]");
        checkbox.prop("checked", false);
        
        var urlParams = "";
    } else {
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
    $('.filter-div > #min_price').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > #max_price').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > #discount').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > .color').change(function(e) {
        var checkbox = $(this);

        sendAjax(checkbox, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > #brand').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > #name').change(function(e) {
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });

    $('.filter-div > #clear').click(function(e) {
        e.preventDefault();
        var input = $(this);

        sendAjax(input, function(response) {
            updateProducts(response);
        }, function(jqXHR) {
            $('#response').text("Something went wrong").addClass("text-danger");
        });
    });
});