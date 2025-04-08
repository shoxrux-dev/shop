<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('id')->get();
        $categories = Category::all();

        return view('backend.size.index',
            [
                'sizes' => $sizes,
                'categories' => $categories,
            ]
        );
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.size.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('sizes', 'name'),],
            'categories' => ['required', 'array']
        ]);

        $size = new Size();
        $size['name'] = $request->input('name');
        $size['slug'] = Str::slug($request->input('name'), '-');
        $size->save();

        $categories = Category::getCategoriesByIds($request->input('categories'));
        $size->categories()->syncWithoutDetaching($categories);

        return redirect()->route('backend.size.index')->with('message', 'Size created successfully');
    }

    public function delete($id)
    {
        $size = Size::find($id);
        $size->categories()->detach();
        $size->delete();
        return redirect()->route('backend.size.index')->with('message', 'Size deleted successfully');
    }

    public function edit($id)
    {
        $size = Size::find($id);
        $categories = Category::all();

        return view('backend.size.edit',
            [
                'size' => $size,
                'categories' => $categories,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'categories' => ['required', 'array']
        ]);

        $size = Size::find($id);

        $size['name'] = $request->input('name');
        $size['slug'] = Str::slug($request->input('name'), '-');
        $size->update();

        if($request->input('categories')) {
            $categories = Category::getCategoriesByIds($request->input('categories'));
            $size->categories()->sync($categories);
        }

        return redirect()->route('backend.size.index')->with('message', 'Size updated successfully');
    }

}
