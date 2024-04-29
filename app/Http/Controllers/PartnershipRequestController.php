<?php

namespace App\Http\Controllers;

use App\Models\PartnershipRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PartnershipRequestController extends Controller
{
  public function store(Request $request)
  {
    $key = 'partnership_requests_' . $request->ip();
    $maxRequests = 3;
    $decayInSeconds = 1800; //1800 секунд = 30 минутам

    if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::hit($key, $decayInSeconds);

      try {
        $request->validate([
          'email' => 'required|email|max:255',
          'organization_name' => 'required|max:255',
          'phone' => 'required|max:255',
          'comment' => 'nullable|max:2000',
        ]);

        PartnershipRequest::create($request->all());

        return response()->json(['message' => 'Заявка успешно отправлена']);
      } catch (Exception) {
        return response()->json(['error' => 'Ошибка при обработке запроса'], 500);
      }
    } else {
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте чуть позже отправить заявления'], 429);
    }
  }
}