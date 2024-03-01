<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartnershipRequestController extends Controller
{
  public function index()
  {
    $requests = PartnershipRequest::all();
    return view('admin.partnership_requests', compact('requests'));
  }

  public function destroy($id)
  {
    try {
      $partnershipRequest = PartnershipRequest::findOrFail($id);
      $partnershipRequest->delete();
      return response()->json(['message' => 'Заявление успешно удалено']);
    } catch (ModelNotFoundException) {
      return response()->json(['error' => 'Заявление не найдено'], 404);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при удалении заявления'], 500);
    }
  }
}