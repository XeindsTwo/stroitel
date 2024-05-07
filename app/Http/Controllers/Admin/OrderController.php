<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Order::with('user', 'products')->get();
    return view('admin.manage_orders', compact('orders'));
  }

  public function destroy($id): JsonResponse
  {
    try {
      $order = Order::findOrFail($id);
      $order->products()->detach();
      $order->delete();

      return response()->json(['success' => 'Заказ успешно удален']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при удалении заказа: ' . $e->getMessage()], 500);
    }
  }
}