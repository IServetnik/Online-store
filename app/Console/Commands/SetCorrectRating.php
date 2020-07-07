<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Services\ProductService;
use \App\Services\ReviewService;

class SetCorrectRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:setcorrectrating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the correct rating if the review was not added by the site';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $productService = app(ProductService::class);
        $reviewService = app(ReviewService::class);

        $products = $productService->getAll();
        foreach ($products as $product) {
            $reviews = $reviewService->getByProduct($product->id);
            if($reviews->isEmpty()) continue;

            $this->warn("Setting {$product->name} rating...");

            $rating = $reviews->sum('rating') / $reviews->count();
            $rating = round($rating, 1);

            $product->rating = $rating;
            $product->save();

            $this->line("Product id: {$product->id}; Product rating: {$product->rating};");
            $this->info(ucfirst($product->name)." rating set\n");
        }
        $this->info("\nProduct rating setting completed successfully.");
    }
}
