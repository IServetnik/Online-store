<div class="modal fade review-div" id="edit-review-{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label for="rating">Rating:</label>
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="form-check form-check-inline">
                            <input type="radio" name="rating" class="form-check-input rating-radio" value="{{$i}}" @if ($review->rating == $i) {{ 'checked' }} @endif>
                            <label class="form-check-label" for="rating-{{$i}}">{{$i}}</label>
                        </div>
                    @endfor
                    <br>
                    <label for="text">Text:</label>
                    <textarea class="form-control" name="text" placeholder="Text" rows="3">{{ $review->text }}</textarea><br>

                    <input type="submit" class="btn btn-success" value="Write a review">
                </form>
            </div>
        </div>
    </div>
</div>