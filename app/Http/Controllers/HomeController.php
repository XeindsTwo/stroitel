<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
  public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    $categories = $this->getCategories();
    return view('index', compact('categories'));
  }

  public function getCategories()
  {
    try {
      return Category::take(12)->get();
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при получении категорий'], 500);
    }
  }
}