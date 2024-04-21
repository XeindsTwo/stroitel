<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::with('subcategories')->get();
    return view('admin.categories.index', compact('categories'));
  }

  public function create()
  {
    return view('admin.categories.create');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255|unique:categories',
      'image' => 'required|image|mimes:webp,png,jpg,jpeg|max:2048',
      'subcategories' => 'array',
      'subcategories.*.name' => 'required|max:255',
      'subcategories.*.image' => 'required|image|mimes:webp,png,jpg,jpeg|max:2048',
    ], [
      'name.unique' => 'Имя категории должно быть уникальным.',
    ]);

    if ($validator->fails()) {
      return response()->json(['success' => false, 'message' => 'Ошибки валидации', 'errors' => $validator->errors()], 422);
    }

    $imagePath = $request->file('image')->store('public/category_images');
    $imageName = basename($imagePath);

    $category = new Category();
    $category->name = $request->name;
    $category->image = $imageName;

    if (!$category->save()) {
      return response()->json(['success' => false, 'message' => 'Ошибка при сохранении основной категории'], 500);
    }

    if ($request->has('subcategories')) {
      foreach ($request->subcategories as $subcategoryData) {
        $subcategoryImagePath = $subcategoryData['image']->store('public/subcategory_images');
        $subcategoryImageName = basename($subcategoryImagePath);

        $subcategory = new Subcategory();
        $subcategory->name = $subcategoryData['name'];
        $subcategory->image = $subcategoryImageName;
        $subcategory->category_id = $category->id;

        $subcategory->save();
      }
    }

    return response()->json(['message' => 'Категория успешно создана']);
  }

  public function edit($id)
  {
    $category = Category::with('subcategories')->findOrFail($id);
    return view('admin.categories.edit', compact('category'));
  }

  public function destroy($id)
  {
    $category = Category::findOrFail($id);
    foreach ($category->subcategories as $subcategory) {
      Storage::delete('public/subcategory_images/' . $subcategory->image);
    }

    $category->subcategories()->delete();
    Storage::delete('public/category_images/' . $category->image);
    $category->delete();

    return response()->json(['message' => 'Категория успешно удалена']);
  }
}