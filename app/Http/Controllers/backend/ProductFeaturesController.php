<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductFeature;
use Illuminate\Http\Request;

class ProductFeaturesController extends Controller
{
    public function delete($id)
    {
        $productFeature = ProductFeature::find($id);
        $productFeature->delete();
        return back()->with('message', 'Product Feature deleted successfully');
    }
}
