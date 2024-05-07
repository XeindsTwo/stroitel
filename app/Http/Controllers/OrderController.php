<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
  public function index()
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
        $item->subtotal = $item->quantity * ($item->new_price ?: $item->price);
        $totalPrice += $item->subtotal;
      }

      return view('order', compact('cartItems', 'totalPrice'));
    } catch (Exception $e) {
      return back()->with('error', 'Произошла ошибка при загрузке корзины: ' . $e->getMessage());
    }
  }

  public function store(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'delivery_address' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:2500',
        'delivery_option' => 'required|in:pickup,delivery',
        'payment_option' => 'required|in:cash,non-cash',
      ]);

      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
      }

      $userId = Auth::id();

      $cartItems = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('products.name', 'products.id as product_id', 'products.price', 'products.new_price', 'carts.quantity')
        ->where('carts.user_id', $userId)
        ->get();

      $order = new Order();
      $order->user_id = $userId;
      $order->fill($validator->validated());
      $order->save();

      $totalPrice = 0;

      foreach ($cartItems as $item) {
        $price = $item->new_price ?? $item->price;
        $subtotal = $price * $item->quantity;
        $totalPrice += $subtotal;

        $order->products()->attach($item->product_id, ['quantity' => $item->quantity, 'total_price' => $subtotal]);
      }

      $order->total_price = $totalPrice;
      $order->save();

      DB::table('carts')->where('user_id', $userId)->delete();
      return response()->json(['success' => 'Заказ был успешно создан']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибки при создании заказа: ' . $e->getMessage()], 500);
    }
  }
}