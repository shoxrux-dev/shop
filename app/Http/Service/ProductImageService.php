<?php

namespace App\Http\Service;

use App\Const\ImageFolderPath;
use App\Http\Util\FileUtil;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageService
{
    public static function store(Request $request, Product $product): void
    {
        foreach ($request->file('images') as $image) {
            if(!is_null($image)) {
                $productImage = new ProductImage();
                $productImage['product_id'] = $product['id'];
                $image = FileUtil::store($image, ImageFolderPath::PRODUCT);
                $productImage['image'] = $image;
                $productImage->save();
            }
        }
    }

    public static function deleteByProduct(Product $product)
    {
        foreach ($product->images as $product_image) {
            FileUtil::delete($product_image['image'], ImageFolderPath::PRODUCT);
            $product_image->delete();
        }
    }

}
