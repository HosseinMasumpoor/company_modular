<?php

namespace Modules\Project\Http\Controllers\v1;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Project\Services\ProjectFeatureService;

class ProjectFeatureController extends CoreController
{
    public function __construct(private readonly ProjectFeatureService $service) {}

    public function index(string $projectId)
    {
        $data = $this->service->list($projectId);
        return successResponse($data);
    }

    public function store(Request $request, string $projectId)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:300'
        ]);

        $result = $this->service->store($projectId, $data);
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
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function order(string $featureId, string $substituteId)
    {
        $result = $this->service->changeOrder($featureId, $substituteId);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }
}
