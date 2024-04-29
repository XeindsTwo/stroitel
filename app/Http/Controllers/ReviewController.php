<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
  public function showReviewsPage()
  {
    $reviews = Review::where('status', true)->latest()->get();
    return view('company.reviews', compact('reviews'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|regex:/^[\p{Cyrillic}A-Za-z\s\-]+$/u|max:255',
      'email' => 'required|email|max:255',
      'comment' => 'required|string|max:2000',
      'rating' => 'required|integer|min:1|max:5',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $maxRequests = 3;
    $decayInSeconds = 1800; //1800 секунд = 30 минутам

    $key = 'review_requests_' . $request->ip();

    if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::hit($key, $decayInSeconds);

      try {
        $review = Review::create([
          'name' => $request->name,
          'email' => $request->email,
          'comment' => $request->comment,
          'rating' => $request->rating,
        ]);

        return response()->json(['message' => 'Отзыв успешно отправлен. Ожидайте проверки отзыва администратором. В дальнейшем отзыв будет одобрен или отклонён', 'review' => $review]);
      } catch (Exception) {
        return response()->json(['error' => 'Ошибка при обработке запроса'], 500);
      }
    } else {
      $retryAfter = RateLimiter::availableIn($key);
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте снова через ' . $retryAfter . ' секунд.'], 429);
    }
  }
}
