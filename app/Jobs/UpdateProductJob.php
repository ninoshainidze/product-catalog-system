<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateProductJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $oldPrice = $this->product->price;
        $oldStock = $this->product->stock;

        $newPrice = round(mt_rand(1000, 10000) / 100, 2); // Random price
        $newStock = rand(0, 500); // Random stock

        $this->product->update([
            'price' => $newPrice,
            'stock' => $newStock,
        ]);

        Log::channel('product_update')->info('Updated Product ID ' . $this->product->id, [
            'old_price' => $oldPrice,
            'new_price' => $newPrice,
            'old_stock' => $oldStock,
            'new_stock' => $newStock,
        ]);
    }
}
