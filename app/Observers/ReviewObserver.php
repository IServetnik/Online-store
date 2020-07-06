<?php

namespace App\Observers;

use App\Models\Review;
use \Auth;

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
}
