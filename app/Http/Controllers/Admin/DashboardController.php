<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{


    public function index(
        DashboardService $dashboardService
    ) {


        $metrics =
            $dashboardService
                ->getAdminMetrics();



        $charts =
            $dashboardService
                ->getAdminCharts();



        $calendarEvents =
            $dashboardService
                ->getCalendarEvents();



        return view(
            'admin.dashboard',
            compact(
                'metrics',
                'charts',
                'calendarEvents'
            )
        );


    }
}
