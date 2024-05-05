<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  /**
   * Выполняет поиск товаров по заданному запросу и отображает результаты.
   *
   * Метод выполняет поиск товаров в категориях, содержащих заданный запрос,
   * а затем отображает результаты поиска на соответствующей странице
   *
   * @param \Illuminate\Http\Request $request Запрос с данными поиска
   */
  public function search(Request $request)
  {
    $searchQuery = $request->input('search');

    // Ищем категории, содержащие товары, соответствующие запросу
    $categories = Category::whereHas('products', function ($query) use ($searchQuery) {
      $query->where('name', 'LIKE', "%$searchQuery%")
        ->orWhereRaw("LOWER(name) LIKE ?", ["%" . strtolower($searchQuery) . "%"]);
    })->with(['products' => function ($query) use ($searchQuery) {
      $query->where('name', 'LIKE', "%$searchQuery%")
        ->orWhereRaw("LOWER(name) LIKE ?", ["%" . strtolower($searchQuery) . "%"]);
    }])->get();

    return view('search', compact('categories', 'searchQuery'));
  }
}