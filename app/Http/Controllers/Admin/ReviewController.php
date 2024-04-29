<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
  public function unapproved()
  {
    $unapprovedReviews = Review::where('status', 0)->get();
    return view('admin.reviews.manage_reviews', compact('unapprovedReviews'));
  }

  public function approved()
  {
    $approvedReviews = Review::where('status', 1)->get();
    return view('admin.reviews.manage_reviews-approved', compact('approvedReviews'));
  }

  public function destroy($id)
  {
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    $review->delete();
    return response()->json(['message' => 'Отзыв успешно удален']);
  }

  public function approve($id)
  {
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    $review->status = 1;
    $review->save();
    return response()->json(['message' => 'Отзыв успешно одобрен']);
  }

  public function reject($id)
  {
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    $review->delete();
    return response()->json(['message' => 'Отзыв отклонен (удален)']);
  }
}