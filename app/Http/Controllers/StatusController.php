<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Services\StatusService;

class StatusController extends Controller
{
    public function __construct(
        private StatusService $statusService,
    ) {
    }

    public function index()
    {
        return $this->statusService->getAllStatuses();
    }

    public function create()
    {
        //
    }

    public function store(StoreStatusRequest $request)
    {
        //
    }


    public function show(Status $status)
    {
        //
    }


    public function edit(Status $status)
    {
        //
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        //
    }

    public function destroy(Status $status)
    {
        //
    }
}
