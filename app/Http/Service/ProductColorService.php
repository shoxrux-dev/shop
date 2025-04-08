<?php

namespace App\Http\Service;

use App\Const\ImageFolderPath;
use App\Http\Util\FileUtil;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Support\Str;

class ProductColorService
{
    public static function store(
        array $productColorNames,
        array $productColorImages,
        Product $product
    ): void
    {
        $length = count($productColorImages);
        for ($i = 0; $i < $length; $i++) {
            $productColor = new ProductColor();
            $productColor['name'] = $productColorNames[$i];
            $image = FileUtil::store($productColorImages[$i], ImageFolderPath::PRODUCT_COLOR);
            $productColor['image'] = $image;
            $productColor['slug'] = Str::slug($productColorNames[$i], '-');
            $productColor['product_id'] = $product['id'];
            $productColor->save();
        }
    }

    public static function delete(Product $product)
    {
        foreach ($product->colors as $product_color) {
            FileUtil::delete($product_color['image'], ImageFolderPath::PRODUCT_COLOR);
            $product_color->delete();
        }
    }
}
