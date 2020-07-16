$(document).ready(function() {
    $('.add-size').click(function() {
        var name = $('.size-input').last().attr('name');
        var reg = /\[(\d+)\]/;
        var key = parseInt(name.match(reg)[1])+1;

        $(this).before('<div class="form-check form-check-inline">\
            <input type="text" class="form-control size-input d-inline" placeholder="Size" name="sizes['+key+'][name]">\
            <input type="text" class="form-control size-input d-inline" placeholder="Quantity" name="sizes['+key+'][quantity]">\
            <button class="btn btn-danger btn-sm delete-size">delete</button>\
        </div>');
    });

    $(document).on("click", ".delete-size" , function() {
        var parentDiv = $(this).parent();
        parentDiv.remove();
        $(this).remove();
    });
});