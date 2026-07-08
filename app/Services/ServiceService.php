<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function getServices()
    {
        return Service::latest()->get();
    }


    public function createService(array $data)
    {
        return Service::create($data);
    }


    public function updateService(Service $service, array $data)
    {
        $service->update($data);

        return $service;
    }


    public function deleteService(Service $service)
    {
        return $service->delete();
    }


    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);


        $service->update([
            'status' => !$service->status,
        ]);


        return $service;
    }
}
