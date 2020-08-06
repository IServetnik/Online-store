$(document).ready(function() {
    $(document).on("click", ".add-size" , function(e) {
        var id = $('.size-div').last().data('id');
        id++;

        $(this).before('<div class="form-group size-div" data-id="'+id+'">\
                    <div class="form-inline">\
                        <input type="text" class="form-control col-10" name="sizes['+id+'][name]" placeholder="Size name">\
                        <button class="btn btn-danger delete-size col-2" data-id="'+id+'">delete</button>\
                    </div>\
                    \
                    <div class="form-row container-fluid mt-3 form-inline">\
                        <div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="'+id+'" data-color-id="0">\
                            <input type="text" class="form-control form-control-sm" id="color" placeholder="Color name" name="sizes['+id+'][colors][0][name]">\
                            <input type="text" class="form-control form-control-sm" placeholder="Quantity" name="sizes['+id+'][colors][0][quantity]">\
                            <button class="btn btn-danger btn-sm delete-color" disabled data-id="'+id+'">delete</button>\
                        </div>\
                        <button type="button" class="btn btn-link btn-sm add-color">Add new color</button>\
                    </div>\
                </div>');
    });

    $(document).on("click", ".add-color" , function(e) {
        var sizeId = $(this).prev().data('id');
        var colorId = $('.color-div[data-id="'+sizeId+'"]').last().data('color-id');
        colorId++;

        $(this).before('<div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="'+sizeId+'" data-color-id="'+colorId+'">\
                            <input type="text" class="form-control form-control-sm" id="color" placeholder="Color name" name="sizes['+sizeId+'][colors]['+colorId+'][name]">\
                            <input type="text" class="form-control form-control-sm" placeholder="Quantity" name="sizes['+sizeId+'][colors]['+colorId+'][quantity]">\
                            <button class="btn btn-danger btn-sm delete-color" data-id="'+sizeId+'">delete</button>\
                        </div>');
    });

    $(document).on("click", ".delete-size" , function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var sizeDiv = $('.size-div[data-id="'+id+'"]');

        sizeDiv.remove();
    });

    $(document).on("click", ".delete-color" , function(e) {
        e.preventDefault();

        var colorDiv = $(this).parent();

        colorDiv.remove();
    });
});