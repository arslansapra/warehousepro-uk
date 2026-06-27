<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService)
    {

        $stats = $dashboardService->getStats();

        return view('dashboard', compact('stats'));

    }
}
