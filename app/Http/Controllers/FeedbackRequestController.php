<?php

namespace App\Http\Controllers;

use App\Models\FeedbackRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FeedbackRequestController extends Controller
{
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name_feedback' => 'required|string|max:70|regex:/^[А-Яа-яЁё\s\-]+$/u',
      'email_feedback' => 'required|email|max:120',
      'phone_feedback' => 'required|string|max:20',
      'comment_feedback' => 'nullable|string|max:2000',
      'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $maxRequests = 3;
    $decayInSeconds = 10; // 30 минут = 1800 секунд

    $key = 'feedback_requests_' . $request->ip();

    if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::hit($key, $decayInSeconds);

        try {
            $filePath = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('feedback_files', 'public');
            }

            $feedbackRequest = FeedbackRequest::create([
                'name_feedback' => $request->name_feedback,
                'email_feedback' => $request->email_feedback,
                'phone_feedback' => $request->phone_feedback,
                'comment_feedback' => $request->comment_feedback,
                'file_path' => $filePath,
            ]);

            return response()->json(['message' => 'Фидбек-запрос успешно создан', 'feedback_request' => $feedbackRequest], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ошибка при обработке запроса ' . $e->getMessage()], 500);
        }
    } else {
      $retryAfter = RateLimiter::availableIn($key);
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте снова через ' . $retryAfter . ' секунд.'], 429);
    }
  }
}
