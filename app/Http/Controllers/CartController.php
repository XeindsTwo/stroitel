<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
  public function favorites()
  {
    return view('cart.favorites');
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

  public function addToCart(Request $request): JsonResponse
  {
    try {
      if (!Auth::check()) {
        return response()->json(['message' => 'Вы должны быть авторизованы для добавления товара в корзину'], 401);
      }

      $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1|max:1000',
      ]);

      $userId = Auth::id();
      $productId = $request->product_id;
      $quantity = $request->quantity;

      $product = Product::findOrFail($productId);

      if (!$product->availability) {
        return response()->json(['message' => 'Данный товар недоступен для покупки'], 403);
      }

      $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

      if ($cartItem) {
        $newQuantity = $cartItem->quantity + $quantity;
        if ($newQuantity > 1000) {
          return response()->json(['message' => 'Превышен лимит на данный товар в корзине. Максимальное количество - 1000 единиц'], 402);
        }
        $cartItem->quantity = $newQuantity;
        $cartItem->save();
      } else {
        Cart::create([
          'user_id' => $userId,
          'product_id' => $productId,
          'quantity' => $quantity,
        ]);
      }

      return response()->json(['message' => 'Товар успешно добавлен в корзину']);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->getMessage()], 422);
    } catch (Exception $e) {
      return response()->json(['message' => $e->getMessage()], 500);
    }
  }

  public function showCart()
  {
    try {
      $userId = Auth::id();

      $cartItems = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('products.name', 'products.id as product_id', 'products.price', 'products.new_price', 'carts.quantity', 'carts.id as cart_id')
        ->where('carts.user_id', $userId)
        ->get();

      $totalPrice = 0;
      foreach ($cartItems as $item) {
        $totalPrice += $item->quantity * ($item->new_price ? $item->new_price : $item->price);
      }

      return view('cart.cart')->with('cartItems', $cartItems)->with('totalPrice', $totalPrice);
    } catch (Exception $e) {
      return back()->with('error', 'Произошла ошибка при загрузке корзины: ' . $e->getMessage());
    }
  }

  public function removeFromCart(Request $request)
  {
    try {
      $userId = Auth::id();
      $productId = $request->input('product_id');

      Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->delete();

      return response()->json(['message' => 'Товар успешно удален из корзины']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при удалении товара из корзины: ' . $e->getMessage()], 500);
    }
  }

  public function updateCartItemQuantity(Request $request): JsonResponse
  {
    try {
      $request->validate([
        'product_id' => 'required|exists:carts,product_id,user_id,' . Auth::id(),
        'quantity' => 'required|integer|min:1|max:1000',
      ]);

      $userId = Auth::id();
      $productId = $request->input('product_id');
      $newQuantity = $request->input('quantity');

      // текущее количество товара в корзине для данного пользователя и продукта
      $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

      if (!$cartItem) {
        return response()->json(['error' => 'Товар не найден в корзине'], 404);
      }

      // не превышает ли новое количество лимит в 1000 единиц для данного товара
      if ($newQuantity > 1000) {
        return response()->json(['error' => 'Превышен лимит в 1000 единиц для данного товара'], 402);
      }

      $cartItem->update(['quantity' => $newQuantity]);

      return response()->json(['message' => 'Количество товара в корзине успешно обновлено']);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->validator->errors()->first()], 422);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при обновлении количества товара в корзине: ' . $e->getMessage()], 500);
    }
  }
}