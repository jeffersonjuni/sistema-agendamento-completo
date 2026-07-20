<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{


    public function index(
        DashboardService $dashboardService
    ) {


        $userId = auth()->id();



        $metrics =
            $dashboardService
                ->getClientMetrics($userId);



        $charts =
            $dashboardService
                ->getClientCharts($userId);



        $calendarEvents =
            $dashboardService
                ->getClientCalendarEvents($userId);



        return view(
            'client.dashboard',
            compact(
                'metrics',
                'charts',
                'calendarEvents'
            )
        );


    }


}
