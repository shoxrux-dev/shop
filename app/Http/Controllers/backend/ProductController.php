<?php

namespace App\Http\Controllers\backend;

use App\Const\ImageFolderPath;
use App\Http\Controllers\Controller;
use App\Http\Service\ProductColorService;
use App\Http\Service\ProductFeatureService;
use App\Http\Service\ProductImageService;
use App\Http\Util\FileUtil;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Rules\UniqueArrayValuesRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $sizes = Size::all();
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::paginate(20);
        return view('backend.product.index',
            [
                'products' => $products,
                'sizes' => $sizes,
                'categories' => $categories,
                'brands' => $brands,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required'],
            'description' => ['required'],
            'brand_id' => ['required'],
            'images' => ['required', 'max:4'],
            'images.*' => ['mimes:jpeg,png,jpg', 'max:5000'],
            'categories' => ['required', 'array'],
            'product_color_images' => ['required', 'array'],
            'product_color_images.*' => ['mimes:jpeg,png,jpg', 'max:5000'],
            'product_color_names' => ['required', 'array', new UniqueArrayValuesRule],
            'product_color_names.*' => ['string'],
            'product_feature_keys' => ['array'],
            'product_feature_values' => ['array'],
        ]);

        try {
            DB::beginTransaction();

            $product = new Product();
            $product['name'] = $request->input('name');
            $product['quantity'] = $request->input('quantity');
            $product['description'] = $request->input('description');
            $product['price'] = $request->input('price');
            $product['brand_id'] = $request->input('brand_id');
            $product['slug'] = Str::slug($request->input('name'), '-');

            $product->save();

            ProductFeatureService::store(
                $request->input('product_feature_keys'),
                $request->input('product_feature_values'),
                $product
            );
            ProductImageService::store($request, $product);
            ProductColorService::store(
                $request->input('product_color_names'),
                $request->file('product_color_images'),
                $product
            );

            $categories = Category::getCategoriesByIds($request->input('categories'));
            $product->categories()->syncWithoutDetaching($categories);

            $sizes = Size::getSizesByIds($request->input('sizes'));
            $product->sizes()->syncWithoutDetaching($sizes);

            DB::commit();
            return redirect()->route('backend.product.index')->with('message', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('backend.product.index')->with('message', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('backend.product.index')->with('message', 'Product not found !');
            }

            $product->sizes()->detach();
            $product->categories()->detach();

            ProductImageService::deleteByProduct($product);
            ProductColorService::delete($product);
            ProductFeatureService::delete($product);

            $product->delete();

            DB::commit();
            return redirect()->route('backend.product.index')->with('message', 'Product deleted successfully !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.product.index')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    public function showImage($image)
    {
        if (File::exists(public_path(ImageFolderPath::PRODUCT . '/' . $image))) {
            return response()->file(public_path(ImageFolderPath::PRODUCT . '/' . $image));
        } elseif (File::exists(public_path(ImageFolderPath::PRODUCT_COLOR . '/' . $image))) {
            return response()->file(public_path(ImageFolderPath::PRODUCT_COLOR . '/' . $image));
        } else {
            return view('backend.404');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $sizes = Size::all();
        $brands = Brand::all();

        return view('backend.product.edit',
            [
                'product' => $product,
                'categories' => $categories,
                'sizes' => $sizes,
                'brands' => $brands,
            ]);
    }

    public function detachSize($sizeId, $productId)
    {
        $product = Product::find($productId);
        $product->sizes()->detach($sizeId);
        return back()->with('message', 'Size detached successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required'],
            'description' => ['required'],
            'brand_id' => ['required'],
            'categories' => ['required', 'array'],
//            'images' => ['required', 'max:4'],
//            'images.*' => ['mimes:jpeg,png,jpg', 'max:5000'],
            'product_color_images' => ['required', 'array'],
//            'product_color_images.*' => ['mimes:jpeg,png,jpg', 'max:5000'],
            'product_color_names' => ['required', 'array', new UniqueArrayValuesRule],
//            'product_color_names.*' => ['string'],
            'product_feature_keys' => ['array'],
            'product_feature_values' => ['array'],
        ]);

        try {
            DB::beginTransaction();
            $product = Product::find($id);
            if (!$product) {
                throw new \Exception('Product not found');
            }

            $product['name'] = $request->input('name');
            $product['quantity'] = $request->input('quantity');
            $product['description'] = $request->input('description');
            $product['price'] = $request->input('price');
            $product['brand_id'] = $request->input('brand_id');
            $product['slug'] = Str::slug($request->input('name'), '-');

            $product->update();

            if($request->hasFile('images')){
                ProductImageService::store($request, $product);
            }

            if($request->input('product_color_names') && $request->file('product_color_images')) {
                ProductColorService::store(
                    $request->input('product_color_names'),
                    $request->file('product_color_images'),
                    $product
                );
            }

            if($request->input('sizes')) {
                $sizes = Size::getSizesByIds($request->input('sizes'));
                $product->sizes()->syncWithoutDetaching($sizes);
            }

            if($request->input('categories')) {
                $categories = Category::getCategoriesByIds($request->input('categories'));
                $product->categories()->syncWithoutDetaching($categories);
            }

            DB::commit();
            return redirect()->route('backend.product.index')->with('message', 'Product updated successfully !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.product.index')->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

}
