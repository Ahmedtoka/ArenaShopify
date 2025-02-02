<?php

namespace App\Jobs\Shopify\Sync;

use App\Models\Product as ModelsProduct;
use App\Models\ProductVariant as ModelsProductVariant;
use App\Traits\FunctionTrait;
use App\Traits\RequestTrait;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Product implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use FunctionTrait, RequestTrait;
    public $user, $store;
    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($user, $store) {
        $this->user = $user;
        $this->store = $store;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle() {
        try {
            $since_id = 0;
            $headers = getShopifyHeadersForStore($this->store);
            $products = [];
            do {
                $endpoint = getShopifyURLForStore('products.json?since_id='.$since_id, $this->store);
                $response = $this->makeAnAPICallToShopify('GET', $endpoint, null, $headers);
                $products = $response['statusCode'] == 200 ? $response['body']['products'] ?? null : null;
                foreach($products as $product) {
                    $this->updateOrCreateThisProductInDB($product);
                    $since_id = $product['id'];
                    foreach ($product['variants'] as $variant) {
                        $this->updateOrCreateThisVariantInDB($variant);
                    }
                }
            } while($products !== null && count($products) > 0);
        } catch(Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function updateOrCreateThisProductInDB($product) {
        try {
            $payload = [
                'store_id' => $this->store->table_id,
                'id' => $product['id'],
                'title' => $product['title'],
                'vendor' => $product['vendor'],
                'body_html' => $product['body_html'],
                'handle' => $product['handle'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
                'product_type' => $product['product_type'],
                'admin_graphql_api_id' => $product['admin_graphql_api_id'],
                'variants' => json_encode($product['variants']),
                'options' => json_encode($product['options']),
                'images' => json_encode($product['images']),
                'tags' => $product['tags']
            ];
            $update_arr = [
                'store_id' => $this->store->table_id,
                'id' => $product['id']
            ];
            ModelsProduct::updateOrCreate($update_arr, $payload);
            return true;
        } catch(Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function updateOrCreateThisVariantInDB($variant)
    {
        try {
            $payload = [
                'store_id' => $this->store->table_id,
                'id' => $variant['id'],
                'product_id' => $variant['product_id'],
                'title' => $variant['title'],
                'price' => $variant['price'],
                'sku' => $variant['sku'],
                'option1' => $variant['option1'],
                'option2' => $variant['option2'],
                'option3' => $variant['option3'],
                'created_at' => $variant['created_at'],
                'updated_at' => $variant['updated_at'],
                'barcode' => $variant['barcode'],
                'admin_graphql_api_id' => $variant['admin_graphql_api_id'],
                'inventory_item_id' => $variant['inventory_item_id'],
                'inventory_quantity' => $variant['inventory_quantity'],
                'image_id' => $variant['image_id']
            ];
            $update_arr = [
                'store_id' => $this->store->table_id,
                'id' => $variant['id']
            ];
            ModelsProductVariant::updateOrCreate($update_arr, $payload);
            return true;
        } catch (Exception $e) {
            dd($e);
            Log::info($e->getMessage());
        }
    }
}
