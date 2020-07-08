var processing = false; 
function sendAjax(btn, rating, text, success_callback, error_callback) {
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
                product_id: btn.data('product-id'),
                rating: rating.val(),
                text: text.val(),
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

function updateReviews(response) {
    var reviews = response.reviews;
    $('.reviews').empty();

    reviews.forEach((review) => {
        //format: YYYY-MM-DD hh:mm:ss
        var created_at = new Date(review['created_at']).toISOString().replace(/T/, ' ').replace(/\..+/, '');
        var updated_at = new Date(review['updated_at']).toISOString().replace(/T/, ' ').replace(/\..+/, '');

        $('.reviews').append('<h4>'+review['text']+'</h4>');
        $('.reviews').append('<b><i>Rating:'+review['rating']+'</i></b><br>');
        $('.reviews').append('<small>created: '+created_at+'</small>');
        if(review['created_at']!= review['updated_at']) {
            $('.reviews').append('<small>updated: '+updated_at+'</small><br><br>');
        }
    })
}





$(document).ready(function() {
    $('.write-review').click(function(e) {
        var btn = $(this);
        var rating = $('input.rating-radio:checked');
        var text = $('textarea#text');

        if(rating.val() == undefined) {
            $('#response').text("You did not rate").addClass("text-danger");
        } else if(text.val() == "") {
            $('#response').text("You did not write a review").addClass("text-danger");
        }else {
            sendAjax(btn, rating, text, function (response) {
                rating.prop('checked', false);
                text.val('');

                updateReviews(response);

                $('#write-review').remove();
                
                if($('#rating').length) {
                    $('#rating').text(response.rating);
                } else {
                    $('#type').after('<p><b>Rating: </b> <span id="rating">'+response.rating+'</span><p>');
                }
                
                $('#response').text("Review written successfully").addClass("text-success");
            }, function (jqXHR) {
                $('#response').text("The review was not written").addClass("text-danger");
            });
        }
    });
});