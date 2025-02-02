<?php

namespace Modules\ContactUs\Http\Controllers\v1;


use Modules\ContactUs\Http\Requests\StoreContactRequest;
use Modules\ContactUs\Services\ContactService;
use Modules\Core\Http\Controllers\CoreController;

class ContactController extends CoreController
{
    public function __construct(private readonly ContactService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->service->list()->paginate(10);
        return successResponse($contacts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $result = $this->service->store($request->validated());
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->service->getItem($id);
        $this->service->visit($id);
        return successResponse($data);
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
}
