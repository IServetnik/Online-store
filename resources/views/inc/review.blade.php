<div class="modal fade review-div" id="modal-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="rating">Rating:</label>
                <div class="form-check form-check-inline">
                    <input type="radio" name="rating" id="rating-1" class="form-check-input rating-radio" value="1")>
                    <label class="form-check-label" for="rating-1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="rating" id="rating-2" class="form-check-input rating-radio" value="2")>
                    <label class="form-check-label" for="rating-2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="rating" id="rating-3" class="form-check-input rating-radio" value="3")>
                    <label class="form-check-label" for="rating-3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="rating" id="rating-4" class="form-check-input rating-radio" value="4")>
                    <label class="form-check-label" for="rating-4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="rating" id="rating-5" class="form-check-input rating-radio" value="5")>
                    <label class="form-check-label" for="rating-5">5</label>
                </div><br>
                <label for="text">Text:</label>
                <textarea class="form-control" name="text" id="text" placeholder="Text" rows="3"></textarea><br>

                <button type="button" class="btn btn-primary write-review" data-dismiss="modal" data-product-id="{{ $product->id }}" data-route="{{ route('review.store') }}">Write a review</button><br>
            </div>
        </div>
    </div>
</div>