<?php

namespace Modules\Project\Http\Controllers\v1;

use Modules\Core\Http\Controllers\CoreController;
use Modules\Project\Http\Requests\v1\Project\StoreProjectRequest;
use Modules\Project\Http\Requests\v1\Project\UpdateProjectRequest;
use Modules\Project\Services\ProjectService;

class ProjectController extends CoreController
{
    public function __construct(private readonly ProjectService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->service->list()->paginate(10);
        return successResponse($projects);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
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
    public function update(UpdateProjectRequest $request, string $id)
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


    public function getImage(string $id)
    {
        $data = $this->service->getImage($id);
        return fileResponse($data);
    }

    public function getPresentationFile(string $id)
    {
        $data = $this->service->getPresentationFile($id);
        return fileResponse($data);
    }
}
