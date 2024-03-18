<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductComposition;
use Illuminate\Support\Facades\Storage;

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
    return view('admin.products.create');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required',
      'price' => 'required',
      'description' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $article = mt_rand(1000000000, 9999999999);
    while (Product::where('article', $article)->exists()) {
      $article = mt_rand(1000000000, 9999999999);
    }

    $imagePath = $request->file('image')->store('public/products');
    $imageName = basename($imagePath);
    $product = new Product();
    $product->article = $article;
    $product->name = $validatedData['name'];
    $product->price = $validatedData['price'];
    $product->description = $validatedData['description'];
    $product->image_path = $imageName;
    $product->save();

    foreach ($request->input('properties') as $property) {
      $composition = new ProductComposition();
      $composition->product_id = $product->id;
      $composition->property_name = $property['name'];
      $composition->property_value = $property['value'];
      $composition->save();
    }

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
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