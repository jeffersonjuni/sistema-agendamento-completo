<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{


    public function index(
        DashboardService $dashboardService
    )
    {


        return view(
            'client.dashboard'
        );


    }


}
