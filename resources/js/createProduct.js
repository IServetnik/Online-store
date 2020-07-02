$(document).ready(function() {
    $('.add-size').click(function() {
        var lastInput = $('.size-input').last();
        lastInput.after('<input type="text" class="form-control size-input" placeholder="Size" name="sizes[]">');
    });
});