<?php

namespace App\Http\Controllers\backend;

use App\Const\ImageFolderPath;
use App\Http\Controllers\Controller;
use App\Http\Util\FileUtil;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function delete($id)
    {
        $productImage = ProductImage::find($id);
        FileUtil::delete($productImage['image'], ImageFolderPath::PRODUCT);
        $productImage->delete();
        return back()->with('message', 'Product Image deleted successfully');
    }
}
