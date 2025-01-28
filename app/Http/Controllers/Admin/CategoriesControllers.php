<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesControllers extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/categories/'), $imageName);
        $image_url = 'images/categories/' . $imageName;

        $data = Category::create([
            'nama' => $validatedData['nama'],
            'gambar' => $image_url,
        ]);

        if ($data) {
            return redirect()->route('admin.category')->with('message', 'Category created successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.category')->with('message', 'Category created failed')->with('icon', 'error');
        }
    }

    public function destroy($id)
    {
        $category = Category::find(decrypt($id));

        if ($category->delete()) {
            return redirect()->route('admin.category')->with('message', 'Category created successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.category')->with('message', 'Category created failed')->with('icon', 'error');
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find(decrypt($id));

        if (!$category) {
            return redirect()->route('admin.category')->with('message', 'Category not found')->with('icon', 'error');
        }

        $validatedData = $request->validate([
            'nama' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories/'), $imageName);
            $image_url = 'images/categories/' . $imageName;
        } else {
            $image_url = $category->gambar;
        }

        $category->update([
            'nama' => $validatedData['nama'],
            'gambar' => $image_url,
        ]);

        if ($category) {
            return redirect()->route('admin.category')->with('message', 'Category created successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.category')->with('message', 'Category created failed')->with('icon', 'error');
        }
    }
}
