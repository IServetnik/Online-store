<?php

namespace App\Observers;

use App\Models\Review;
use \Auth;
use App\Services\ProductService;
use App\Services\ReviewService;

class ReviewObserver
{    
    /**
     * creating
     *
     * @param  App\Models\Review $review
     * @return void
     */
    public function creating(Review $review)
    {
        if (Auth::check()) {
            $review->user_id = Auth::user()->id;
        }
    }
    
    /**
     * created
     *
     * @param  App\Models\Review $review
     * @return void
     */
    public function created(Review $review)
    {
        $reviews = app(ReviewService::class)->getByProduct(request()->get('product_id'));
        $product = app(ProductService::class)->getById(request()->get('product_id'));

        $rating = $reviews->sum('rating') / $reviews->count();
        $rating = round($rating, 1);
        $product->rating = $rating;
        $product->save();
    }
}
