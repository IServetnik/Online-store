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
        if (!request()->has('product_id')) return false;
        
        $this->updateRating($review);
    }
     
    /**
     * deleted
     *
     * @param  App\Models\Review $review
     * @return void
     */
    public function deleted(Review $review)
    {   
        $this->updateRating($review);
    }
    


    /**
     * updateRating
     *
     * @param  mixed $review
     * @return void
     */
    public function updateRating(Review $review)
    {
        $product = $review->product;
        $reviews = $product->reviews;
        $count = $reviews->count() ? $reviews->count() : 1;

        $rating = $reviews->sum('rating') / $count;
        $rating = round($rating, 1);
        $product->rating = $rating;
        $product->save();
    }
}
