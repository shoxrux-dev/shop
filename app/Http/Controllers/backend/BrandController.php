<?php

namespace App\Http\Controllers\backend;

use App\Const\ImageFolderPath;
use App\Http\Controllers\Controller;
use App\Http\Util\FileUtil;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('backend.brand.index',
            [
                'brands' => $brands,
                'categories' => $categories
            ]
        );
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'mimes:jpeg,png,jpg', 'max:5000'],
            'categories' => ['required', 'array']
        ]);

        $brand = new Brand();
        $brand['name'] = $request->input('name');
        if($request->hasFile('image')) {
            $brand['image'] = FileUtil::store($request->file('image'), ImageFolderPath::BRAND);
        }

        $brand->save();

        $categories = Category::getCategoriesByIds($request->input('categories'));
        $brand->categories()->syncWithoutDetaching($categories);

        return redirect()->back()->with('message', 'Brand created successfully');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        FileUtil::delete($brand['image'], ImageFolderPath::BRAND);
        $brand->categories()->detach();
        $brand->delete();
        return redirect()->back()->with('message', 'Brand deleted successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $categories = Category::all();
        return view('backend.brand.edit',
        [
           'brand' => $brand,
           'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['mimes:jpeg,png,jpg', 'max:5000'],
            'categories' => ['required', 'array']
        ]);

        $brand = Brand::find($id);
        $brand['name'] = $request->input('name');

        if($request->file('image')) {
            FileUtil::delete($brand['image'], ImageFolderPath::BRAND);
            $brand['image'] = FileUtil::store($request->file('image'), ImageFolderPath::BRAND);
        }

        $brand->update();

        if($request->input('categories')) {
            $categories = Category::getCategoriesByIds($request->input('categories'));
            $brand->categories()->sync($categories);
        }
        return redirect()->route('backend.brand.index')->with('message', 'Brand updated successfully');
    }

}
