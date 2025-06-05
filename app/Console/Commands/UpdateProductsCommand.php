<?php

namespace App\Console\Commands;

use App\Jobs\UpdateProductJob;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product price and stock with random values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = now();

        $this->info('Dispatching jobs to update products...');

        Product::inRandomOrder()->limit(5)->each(function ($product) {
            UpdateProductJob::dispatch($product);
        });

        $end = now();
        $duration = $start->diffInSeconds($end);

        Log::channel('product_update')->info('Dispatched 1000 product updates', [
            'duration_seconds' => round($duration, 2)
        ]);

        $this->info('Took ' . round($duration, 2) . ' seconds.');
    }
}
