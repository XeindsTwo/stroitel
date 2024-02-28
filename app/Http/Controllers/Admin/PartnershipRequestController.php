<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;

class PartnershipRequestController extends Controller
{
  public function index()
  {
    $requests = PartnershipRequest::all();
    return view('admin.partnership_requests', compact('requests'));
  }
}