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
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <label for="rating">Rating:</label>
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="form-check form-check-inline">
                            <input type="radio" name="rating" id="rating-{{$i}}" class="form-check-input rating-radio" value="{{$i}}")>
                            <label class="form-check-label" for="rating-{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                    <br>
                    <label for="text">Text:</label>
                    <textarea class="form-control" name="text" id="text" placeholder="Text" rows="3"></textarea><br>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <input type="submit" class="btn btn-primary" value="Write a review">
                </form>
            </div>
        </div>
    </div>
</div>