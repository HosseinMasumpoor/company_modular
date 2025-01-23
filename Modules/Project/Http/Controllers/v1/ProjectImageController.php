<?php

namespace Modules\Project\Http\Controllers\v1;

use Modules\Core\Http\Controllers\CoreController;
use Modules\Project\Http\Requests\v1\ProjectImage\ProjectImageStoreRequest;
use Modules\Project\Services\ProjectGalleryService;

class ProjectImageController extends CoreController
{
    public function __construct(private readonly ProjectGalleryService $service) {}

    public function index(string $projectId)
    {
        $data = $this->service->list($projectId);
        return successResponse($data);
    }

    public function store(ProjectImageStoreRequest $request, string $projectId)
    {
        $result = $this->service->store($projectId, $request->validated());
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }

    public function order(string $imageId, string $subtitudeId)
    {
        $result = $this->service->changeOrder($imageId, $subtitudeId);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }

    public function getImage(string $id)
    {
        $data = $this->service->getImage($id);
        return fileResponse($data);
    }
}
