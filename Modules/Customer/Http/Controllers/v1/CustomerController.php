<?php

namespace Modules\Customer\Http\Controllers\v1;


use Modules\Core\Http\Controllers\CoreController;
use Modules\Customer\Http\Requests\StoreCustomerReqeust;
use Modules\Customer\Http\Requests\UpdateCustomerReqeust;
use Modules\Customer\Services\CustomerService;

class CustomerController extends CoreController
{
    public function __construct(private readonly CustomerService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($items);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerReqeust $request)
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
    public function update(UpdateCustomerReqeust $request, string $id)
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
