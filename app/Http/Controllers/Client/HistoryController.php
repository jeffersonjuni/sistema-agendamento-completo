<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\HistoryService;

class HistoryController extends Controller
{


    public function __construct(
        private HistoryService $historyService
    ) {
    }







    /**
     * Histórico do cliente.
     */
    public function index()
    {


        $userId = auth()->id();




        $upcomingAppointments =
            $this->historyService
                ->getClientUpcomingAppointments(
                    $userId
                );





        $history =
            $this->historyService
                ->getClientHistory(
                    $userId
                );






        return view(
            'client.history.index',
            compact(
                'upcomingAppointments',
                'history'
            )
        );


    }



}
