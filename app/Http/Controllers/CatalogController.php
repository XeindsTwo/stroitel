<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;

class CatalogController extends Controller
{
  public function index()
  {
    try {
      $categories = Category::all();
      return view('products.catalog', compact('categories'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }

  public function show($id)
  {
    try {
      $product = Product::with(['compositions', 'category', 'subcategory'])->findOrFail($id);
      $categoryName = $product->category->name;
      $subcategory = $product->subcategory;
      $subcategoryName = $subcategory ? $subcategory->name : null;
      $category = $product->category;

      return view('products.product_details', compact('product', 'categoryName', 'subcategoryName', 'subcategory', 'category'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }

  /**
   * Отображает страницу с подкатегориями указанной категории
   * @param int $category_id Идентификатор категории
   */
  public function indexSubcategories($category_id)
  {
    $category = Category::findOrFail($category_id);
    $subcategories = $category->subcategories;
    return view('products.catalog_subcategories', compact('category', 'subcategories'));
  }

  /**
   * Отображает страницу с товарами для указанной категории
   * @param int $category_id Идентификатор категории
   */
  public function indexProducts($categoryId)
  {
    try {
      $category = Category::findOrFail($categoryId);
      $categoryName = $category->name;
      $products = $category->products;
      return view('products.index', compact('products', 'category', 'categoryName'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }

  /**
   * Отображает страницу с товарами для указанной подкатегории.
   * @param int $subcategory_id Идентификатор подкатегории.
   */
  public function indexSubcategoryProducts($category_id, $subcategory_id)
  {
    try {
      $category = Category::findOrFail($category_id);
      $subcategory = $category->subcategories()->findOrFail($subcategory_id);
      $categoryName = $subcategory->category->name;
      $products = $subcategory->products;

      return view('products.index_subcategory', compact('products', 'subcategory', 'categoryName'));
    } catch (Exception) {
      return redirect()->route('error404');
    }
  }
}