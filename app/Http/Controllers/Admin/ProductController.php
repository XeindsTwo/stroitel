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

class ProductController extends Controller
{
  /**
   * Отображает страницу с подкатегориями указанной категории
   * @param int $category_id Идентификатор категории
   */
  public function indexSubcategories($category_id)
  {
    $category = Category::findOrFail($category_id);
    $subcategories = $category->subcategories;
    return view('admin.products.index_categories', compact('category', 'subcategories'));
  }

  // Отображает страницу управления товарами, на которой отображаются все категории
  public function indexPage()
  {
    $categories = Category::all();
    return view('admin.products.index', compact('categories'));
  }

  /**
   * Отображает страницу с товарами для указанной категории
   * @param int $category_id Идентификатор категории
   */
  public function indexProducts($category_id)
  {
    $category = Category::findOrFail($category_id);
    $products = $category->products;
    return view('admin.products.index_products', compact('products', 'category'));
  }

  /**
   * Отображает страницу с товарами для указанной подкатегории.
   * @param int $subcategory_id Идентификатор подкатегории.
   */
  public function indexSubcategoryProducts($category_id, $subcategory_id)
  {
    $category = Category::findOrFail($category_id);
    $subcategory = $category->subcategories()->findOrFail($subcategory_id);
    $categoryName = $subcategory->category->name;
    $products = $subcategory->products;

    return view('admin.products.index_subcategory_products', compact('products', 'subcategory', 'categoryName'));
  }

  public function createPage()
  {
    $categories = Category::with('subcategories')->get();
    return view('admin.products.create', compact('categories'));
  }

  public function edit($id)
  {
    $product = Product::findOrFail($id);
    $productComposition = $product->compositions;
    $categories = Category::with('subcategories')->get();
    return view('admin.products.edit', compact('product', 'productComposition', 'categories'));
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
      $availability = $request->has('availability');
      $product->availability = $availability;
      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->new_price = $request->input('new_price');
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

  public function update(Request $request, $id): JsonResponse
  {
    try {
      $product = Product::findOrFail($id);
      $category = Category::findOrFail($request->input('category_id'));
      $subcategoryRule = $category->subcategories->isEmpty() ? '' : 'required|exists:subcategories,id';

      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required|max:2300',
        'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => $subcategoryRule,
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      if ($request->hasFile('image')) {
        Storage::delete('public/products/' . $product->image_path);
        $imagePath = $request->file('image')->store('public/products');
        $product->image_path = basename($imagePath);
      }

      $product->update([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'new_price' => $request->input('new_price'),
        'description' => $request->input('description'),
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
        'availability' => $request->has('availability') ? $request->input('availability') : false,
      ]);

      $existingProperties = $product->compositions->pluck('property_name')->toArray();

      foreach ($request->input('properties') as $property) {
        if (in_array($property['name'], $existingProperties)) {
          $composition = $product->compositions->where('property_name', $property['name'])->first();
          $composition->update(['property_value' => $property['value']]);
          unset($existingProperties[array_search($property['name'], $existingProperties)]);
        } else {
          $composition = new ProductComposition();
          $composition->product_id = $product->id;
          $composition->property_name = $property['name'];
          $composition->property_value = $property['value'];
          $composition->save();
        }
      }

      if (!empty($existingProperties)) {
        ProductComposition::where('product_id', $product->id)
          ->whereIn('property_name', $existingProperties)
          ->delete();
      }

      return response()->json(['success' => 'Продукт успешно обновлен']);

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