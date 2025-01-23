<?php

namespace Modules\Service\Http\Controllers\v1;

use Modules\Core\Http\Controllers\CoreController;
use Modules\Service\Http\Requests\v1\StoreServiceRequest;
use Modules\Service\Http\Requests\v1\UpdateServiceRequest;
use Modules\Service\Services\ServiceService;

class ServiceController extends CoreController
{
    public function __construct(private ServiceService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services =  $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($services);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $result = $this->service->add($request->validated());
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, int $id)
    {
        $result = $this->service->update($request->validated(), $id);

        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function changeOrder(int $id, int $substituteId)
    {
        $result = $this->service->changeOrder($id, $substituteId);
        if ($result) {
            return successResponse(__(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        $result = $this->service->delete($id);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function getImage(string $id)
    {
        $data = $this->service->getImage($id);
        return fileResponse($data);
    }

    public function getIcon(string $id)
    {
        $data = $this->service->getIcon($id);
        return fileResponse($data);
    }
}
