<?php

namespace Modules\Experience\Http\Controllers\v1;

use Modules\Core\Http\Controllers\CoreController;
use Modules\Experience\Http\Requests\StoreExperienceRequest;
use Modules\Experience\Http\Requests\UpdateExperienceRequest;
use Modules\Experience\Services\ExperienceService;

class ExperienceController extends CoreController
{
    public function __construct(private readonly ExperienceService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = $this->service->list()->get();
        return successResponse($experiences);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExperienceRequest $request)
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
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, string $id)
    {
        $result = $this->service->update($request->validated(), $id);
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

    function getImage(string $id)
    {
        $data = $this->service->getImage($id);
        return fileResponse($data);
    }
}
