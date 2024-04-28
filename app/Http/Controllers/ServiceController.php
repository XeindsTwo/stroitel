<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
  public function store(Request $request)
  {
    $key = 'service_requests_' . $request->ip();
    $maxRequests = 3;
    $decayInSeconds = 1800; // 30 минут

    if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::hit($key, $decayInSeconds);

      try {
        $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|max:255',
          'phone' => 'required|string|max:20',
          'question' => 'nullable|string|max:1000',
          'service_type' => 'required|string|max:255',
        ]);

        $service = Service::create($validatedData);
        return response()->json(['message' => 'Заявка на оказание услуги успешно создана. Ожидайте ответа по почте или номеру телефона', 'service' => $service]);
      } catch (Exception $e) {
        return response()->json(['message' => 'Ошибка при создании заявки на оказание услуги', 'error' => $e->getMessage()], 500);
      }
    } else {
      return response()->json(['error' => 'Слишком много запросов за короткое время. Пожалуйста, попробуйте позже отправить данные'], 429);
    }
  }
}