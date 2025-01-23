<?php

namespace Modules\Partner\Http\Controllers\v1;


use Modules\Core\Http\Controllers\CoreController;
use Modules\Partner\Http\Requests\v1\StorePartnerRequest;
use Modules\Partner\Http\Requests\v1\UpdatePartnerRequest;
use Modules\Partner\Services\PartnerService;

class PartnerController extends CoreController
{
    public function __construct(private readonly PartnerService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($partners);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $result = $this->service->store($request->validated());
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, string $id)
    {
        $result = $this->service->update($request->validated(), $id);

        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function changeOrder(string $id, string $substituteId)
    {
        $result = $this->service->changeOrder($id, $substituteId);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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
}
