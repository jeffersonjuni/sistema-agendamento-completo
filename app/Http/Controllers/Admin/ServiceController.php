<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use App\Enums\AppointmentStatus;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService
    ) {
    }


    public function index()
    {
        $services = $this->serviceService->getServices();

        return view(
            'admin.services.index',
            compact('services')
        );
    }


    public function create()
    {
        return view(
            'admin.services.create'
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'price' => [
                'required',
                'numeric'
            ],

            'duration' => [
                'required',
                'integer'
            ],

            'status' => [
                'required',
                'boolean'
            ],

        ]);


        $this->serviceService->createService(
            $validated
        );


        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Serviço cadastrado com sucesso.'
            );
    }


    public function edit(Service $service)
    {
        return view(
            'admin.services.edit',
            compact('service')
        );
    }


    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'price' => [
                'required',
                'numeric'
            ],

            'duration' => [
                'required',
                'integer'
            ],

            'status' => [
                'required',
                'boolean'
            ],

        ]);


        $this->serviceService->updateService(
            $service,
            $validated
        );


        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Serviço atualizado com sucesso.'
            );
    }


    public function destroy(Service $service)
    {
        if (
            $service->appointments()
                ->whereNotIn('status', [
                    AppointmentStatus::CANCELLED->value,
                ])
                ->exists()
        ) {

            return redirect()
                ->route('admin.services.index')
                ->with(
                    'error',
                    'Não é possível excluir um serviço que possui agendamentos vinculados.'
                );

        }


        $this->serviceService->deleteService(
            $service
        );


        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Serviço excluído com sucesso.'
            );
    }


    public function toggleStatus($id)
    {
        $this->serviceService->toggleStatus($id);


        return redirect()
            ->route('admin.services.index')
            ->with(
                'success',
                'Status do serviço atualizado com sucesso.'
            );
    }
}
