<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CardController extends Controller
{
  public function favorites()
  {
    return view('card.favorites');
  }

  public function getFavoriteProductsInfo(Request $request)
  {
    $productIds = $request->input('productIds');

    if (!is_array($productIds)) {
      $productIds = json_decode($productIds, true);
    }

    $products = Product::whereIn('id', $productIds)->get();
    return response()->json($products);
  }
}