<?php

namespace App\Http\Controllers\backend;

use App\Const\ImageFolderPath;
use App\Http\Controllers\Controller;
use App\Http\Util\FileUtil;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function delete($id)
    {
        $productColor = ProductColor::find($id);
        FileUtil::delete($productColor['image'], ImageFolderPath::PRODUCT_COLOR);
        $productColor->delete();
        return back()->with('message', 'Product Color deleted successfully');
    }
}
