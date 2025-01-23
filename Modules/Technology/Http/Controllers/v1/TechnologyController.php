<?php

namespace Modules\Technology\Http\Controllers\v1;

use Modules\Core\Http\Controllers\CoreController;
use Modules\Technology\Http\Requests\v1\StoreTechnologyRequest;
use Modules\Technology\Http\Requests\v1\UpdateTechnologyRequest;
use Modules\Technology\Services\TechnologyService;

class TechnologyController extends CoreController
{
    public function __construct(private readonly TechnologyService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = $this->service->list()->get();
        return successResponse($technologies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
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
    public function update(UpdateTechnologyRequest $request, string $id)
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

    public function getIcon(string $id)
    {
        $data = $this->service->getIcon($id);
        return fileResponse($data);
    }
}
