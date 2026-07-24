<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportFilterRequest;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AppointmentsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function __construct(
        private ReportService $reportService
    ) {
    }

    /**
     * Exibe a página de relatórios.
     */
    public function index(
        ReportFilterRequest $request
    ) {

        $filters = $request->validated();


        $appointments =
            $this->reportService
                ->getAppointmentsReport(
                    $filters
                );


        $summary =
            $this->reportService
                ->getRevenueSummary(
                    $filters
                );


        return view(
            'admin.reports.index',
            compact(
                'appointments',
                'summary',
                'filters'
            )
        );

    }

    /**
     * Exporta relatório em PDF.
     */
    public function exportPdf(
        ReportFilterRequest $request
    ) {
        $filters = $request->validated();

        $appointments = $this->reportService
            ->getAppointmentsReport($filters);

        $summary = $this->reportService
            ->getRevenueSummary($filters);

        $pdf = Pdf::loadView(
            'admin.reports.pdf',
            [
                'appointments' => $appointments,
                'summary' => $summary,
            ]
        );

        return $pdf->download(
            'relatorio-agendamentos.pdf'
        );
    }

    /**
     * Exporta relatório em Excel.
     */
    /**
     * Exporta relatório em Excel.
     */
    public function exportExcel(
        ReportFilterRequest $request
    ) {

        $filters = $request->validated();


        $appointments =
            $this->reportService
                ->getAppointmentsReport(
                    $filters
                );


        return Excel::download(
            new AppointmentsExport(
                $appointments
            ),
            'relatorio-agendamentos.xlsx'
        );

    }

}
