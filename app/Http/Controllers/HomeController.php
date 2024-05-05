<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
  public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    $categories = $this->getCategories();
    $discountedProducts = $this->getDiscountedProducts();
    return view('index', compact('categories', 'discountedProducts'));
  }

  public function getCategories()
  {
    try {
      return Category::take(12)->get();
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при получении категорий'], 500);
    }
  }

  public function getDiscountedProducts()
  {
    try {
      return Product::whereNotNull('new_price')->take(9)->get();
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при получении скидочных товаров'], 500);
    }
  }
}