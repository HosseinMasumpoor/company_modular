<?php

namespace Modules\Project\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Project\Repositories\ProjectFeatureRepository;
use Throwable;

readonly class ProjectFeatureService
{
    public function __construct(protected ProjectFeatureRepository $repository) {}

    public function list(string $projectId): Collection
    {
        return $this->repository->getByFields([
            'project_id' => $projectId
        ]);
    }

    public function store(string $projectId, array $data): Model
    {
        $data["project_id"] = $projectId;
        $data["order"] = (int) $this->repository->getLastOrder($projectId) + 1;
        return $this->repository->newItem($data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->remove($id);
    }


    public function changeOrder(string $featureId, string $substituteId): bool
    {
        $substituteOrder = $this->repository->findByField('id', $substituteId)->order;
        $imageOrder = $this->repository->findByField('id', $featureId)->order;

        try {
            DB::beginTransaction();
            $this->repository->updateItem([
                'order' => $substituteOrder
            ], $featureId);
            $this->repository->updateItem([
                'order' => $imageOrder
            ], $substituteId);
            DB::commit();
            return true;
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
    }
}
