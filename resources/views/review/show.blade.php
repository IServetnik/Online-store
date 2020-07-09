<div class="reviews">
    @foreach ($reviews as $review)
        <h4>{{ $review->text }}</h4>
        <b><i>Rating: {{ $review->rating }}</i></b><br>
        <small>created: {{ $review->created_at }}</small>
        @if ($review->created_at != $review->updated_at)
            <small>updated: {{ $review->updated_at }}</small>
        @endif 
        <br>
        @if (Auth::check() && ($review->user_id == Auth::user()->id || Auth::user()->is_admin))
            <form action="{{ route('review.destroy', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-link text-danger btn-sm" value="delete">
            </form>
        @endif
        <br><br>
    @endforeach
</div>