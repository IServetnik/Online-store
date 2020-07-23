$(document).ready(function() {
    $('.add-size').click(function() {
        var name = $('.size-input').last().attr('name');
        if(name) {
            var reg = /\[(\d+)\]/;
            var key = parseInt(name.match(reg)[1])+1;
        } else {
            var key = 0;
        }

        var size_name_select = $('.size_name_select').first().clone();
        size_name_select.attr('name', 'sizes['+key+'][id]');

        $(this).before('<div class="form-check form-check-inline">\
            '+size_name_select.prop('outerHTML')+'\
            <input type="text" class="form-control size-input d-inline" placeholder="Quantity" name="sizes['+key+'][quantity]">\
            <button class="btn btn-danger btn-sm delete-size">delete</button>\
        </div>');
    });

    $(document).on("click", ".delete-size" , function() {
        var parentDiv = $(this).parent();
        console.log(parentDiv);
        parentDiv.remove();
        $(this).remove();
    });
});