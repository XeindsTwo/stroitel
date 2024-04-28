<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
  public function index()
  {
    $serviceTypes = Service::distinct('service_type')->pluck('service_type');
    $services = Service::orderBy('created_at', 'desc')->orderBy('service_type')->get();
    return view('admin.manage_services', compact('services', 'serviceTypes'));
  }

  public function destroy($id): JsonResponse
  {
    try {
      $service = Service::findOrFail($id);
      $service->delete();
      return response()->json(['message' => 'Заявление успешно удалено']);
    } catch (ModelNotFoundException) {
      return response()->json(['error' => 'Заявление не найдено'], 404);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при удалении заявления'], 500);
    }
  }
}