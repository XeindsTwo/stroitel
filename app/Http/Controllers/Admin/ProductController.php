<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductComposition;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
  public function indexCatalog()
  {
    try {
      $products = Product::all();
      return view('catalog', compact('products'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }

  public function show($id)
  {
    try {
      $product = Product::with('compositions')->findOrFail($id);
      return view('product', compact('product'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }

  public function indexPage()
  {
    $products = Product::all();
    return view('admin.products.index', compact('products'));
  }

  public function createPage()
  {
    $categories = Category::with('subcategories')->get();
    return view('admin.products.create', compact('categories'));
  }

  public function store(Request $request): JsonResponse
  {
    try {
      $category = Category::findOrFail($request->input('category_id'));
      $subcategoryRule = $category->subcategories->isEmpty() ? '' : 'required|exists:subcategories,id';

      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required|max:2300',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => $subcategoryRule,
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $article = mt_rand(1000000000, 9999999999);
      while (Product::where('article', $article)->exists()) {
        $article = mt_rand(1000000000, 9999999999);
      }

      $imagePath = $request->file('image')->store('public/products');
      $imageName = basename($imagePath);

      $product = new Product();
      $product->article = $article;
      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      $product->image_path = $imageName;
      $product->category_id = $request->input('category_id');
      $product->subcategory_id = $request->input('subcategory_id');
      $product->save();

      foreach ($request->input('properties') as $property) {
        $composition = new ProductComposition();
        $composition->product_id = $product->id;
        $composition->property_name = $property['name'];
        $composition->property_value = $property['value'];
        $composition->save();
      }

      return response()->json(['success' => 'Продукт успешно создан']);

    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $product = Product::findOrFail($id);
      Storage::delete('public/products/' . $product->image_path);
      $product->compositions()->delete();
      $product->delete();

      return response()->json(['message' => 'Товар успешно удален']);
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при удалении товара'], 500);
    }
  }
}