<?php

namespace App\Http\Controllers;

use App\Analytics\DashboardAnalytics;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function __construct(
        protected DashboardAnalytics $analytics
    ) {
    }

    /**
     * Halaman Analytics.
     */
    public function index(): View
    {
        return view('admin.analytics', [
            'analytics' => $this->analytics->build(),
        ]);
    }

    /**
     * API Analytics.
     */
    public function api(): JsonResponse
    {
        return response()->json(
            $this->analytics->build()
        );
    }
}