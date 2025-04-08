<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    public function index()
    {
        $lastTenProducts = Product::latest()->take(8)->get();
        $cart = Cart::where('user_id', Auth::id())->get();
//        echo count($cart);
        return view('frontend.index',
            [
                'lastTenProducts' => $lastTenProducts,
            ]
        );
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $otherProducts = $product->categories[0]->products->take(8);

        return view('frontend.product',
        [
            'product' => $product,
            'otherProducts' => $otherProducts
        ]);
    }

    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->first();

//        $products = new Collection();
//        self::tree($category, $products);

        $products = $category->products()->paginate(12);
        $brands = $category->brands()->get();
        $sizes = $category->sizes()->get();
        $child_categories = $category->children()->get();

        return view('frontend.category-products',
            [
                'products' => $products,
                'brands' => $brands,
                'sizes' => $sizes,
                'child_categories' => $child_categories,
                'category_name' => $category['name']
            ]
        );
    }

    private static function tree($category, &$products)
    {
        if($category->products->isNotEmpty()) {
            $products = $products->merge($category->products()->get());
        }
        if($category->children->isNotEmpty()) {
            foreach ($category->children as $child) {
                self::tree($child, $products);
            }
        }
    }

}
