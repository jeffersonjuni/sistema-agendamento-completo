<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HistoryService;

class HistoryController extends Controller
{


    public function __construct(
        private HistoryService $historyService
    ) {
    }






    /**
     * Histórico geral de agendamentos.
     */
    public function index()
    {


        $history =
            $this->historyService
                ->getAdminHistory(

                    request()->only([

                        'status',

                        'client',

                        'service',

                        'start_date',

                        'end_date',

                    ])

                );




        return view(
            'admin.history.index',
            compact('history')
        );


    }



}
