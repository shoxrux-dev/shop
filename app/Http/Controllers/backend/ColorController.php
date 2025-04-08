<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('backend.color.index',
        [
            'colors' => $colors
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('colors', 'name')],
            'color' => ['required', Rule::unique('colors', 'color')],
        ]);

        $color = new Color();
        $color['name'] = $request->input('name');
        $color['color'] = $request->input('color');
        $color['slug'] = Str::slug($request->input('name'), '-');
        $color->save();
        return redirect()->route('backend.color.index')->with('message', $color['name'] . ' color created successfully !');
    }

    public function delete($id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->route('backend.color.index')->with('message', 'Color deleted successfully !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required'],
        ]);
        $color = Color::find($id);
        $color['name'] = $request->input('name');
        $color['color'] = $request->input('color');
        $color['slug'] = Str::slug($request->input('name'), '-');
        $color->update();

        return redirect()->route('backend.color.index')->with('message', $color['name'] . ' color updated successfully !');
    }
}
