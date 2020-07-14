$(document).ready(function() {
    $('.add-size').click(function() {
        $(this).before('<div class="form-check form-check-inline">\
            <input type="text" class="form-control size-input d-inline" placeholder="Size" name="sizes_name[]">\
            <input type="text" class="form-control size-input d-inline" placeholder="Quantity" name="quantity[]">\
            <button class="btn btn-danger btn-sm delete-size">delete</button>\
        </div>');
    });

    $(document).on("click", ".delete-size" , function() {
        var parentDiv = $(this).parent();
        parentDiv.remove();
        $(this).remove();
    });
});