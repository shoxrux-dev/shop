<?php

namespace App\Http\Controllers\backend;

use App\Const\ImageFolderPath;
use App\Http\Controllers\Controller;
use App\Http\Util\FileUtil;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $categories = Category::paginate(10);
        $allCategories = Category::all();
        return view('backend.category.index',
            [
                'categories' => $categories,
                'allCategories' => $allCategories
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name'),],
            'image' => ['mimes:jpeg,png,jpg', 'max:5000'],
        ]);

        $category = new Category();

        if($request->hasFile('image')) {
            $category['image'] = FileUtil::store($request->file('image'), ImageFolderPath::CATEGORY);
        }

        $category['name'] = $request->input('name');
        $category['parent_id'] = $request->input('parent_id');
        $category['slug'] = Str::slug($request->input('name'), '-');
        $category->save();
        return redirect()->route('backend.category.index')->with('message', 'Category created successfully !');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        FileUtil::delete($category['image'], ImageFolderPath::CATEGORY);

        $category->delete();
        return redirect()->route('backend.category.index')->with('message', 'Category deleted successfully !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['mimes:jpeg,png,jpg', 'max:5000'],
        ]);

        $category = Category::find($id);

        if($request->hasFile('image')) {
            FileUtil::delete($category['image'], ImageFolderPath::CATEGORY);

            $category['image'] = FileUtil::store($request->file('image'), ImageFolderPath::CATEGORY);
        }

        $category['name'] = $request->input('name');
        $category['parent_id'] = $request->input('parent_id');
        $category['slug'] = Str::slug($request->input('name'), '-');

        $category->update();

        return redirect()->route('backend.category.index')->with('message', 'Category updated successfully !');
    }
}
