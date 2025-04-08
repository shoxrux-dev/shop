<?php

namespace App\Http\Service;


use App\Models\Product;
use App\Models\ProductFeature;

class ProductFeatureService
{
    public static function store(
        array $productFeatureKeys,
        array $productFeatureValues,
        Product $product): void
    {
        $length = count($productFeatureKeys);
        for ($i = 0; $i < $length; $i++) {
            $productFeature = new ProductFeature();
            $productFeature['product_id'] = $product['id'];
            $productFeature['key'] = $productFeatureKeys[$i];
            $productFeature['value'] = $productFeatureValues[$i];
            $productFeature->save();
        }
    }

    public static function delete(Product $product)
    {
        foreach ($product->features as $product_feature) {
            $product_feature->delete();
        }
    }
}
