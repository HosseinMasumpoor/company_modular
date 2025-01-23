<?php

namespace Modules\Project\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Media;
use Modules\Project\Repositories\ProjectGalleryRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProjectGalleryService
{
    use Media;
    private string $imageFolder = 'projects/gallery';

    public function __construct(protected ProjectGalleryRepository $repository){}

    public function list(string $projectId): Collection
    {
        return $this->repository->getByFields([
            'project_id' => $projectId
        ]);
    }

    public function store(string $projectId, array $data): Model
    {
        $data["project_id"] = $projectId;
        $data["src"] = $this->storeFile($data["image"], $this->imageFolder);
        $data["order"] = (int) $this->repository->getLastOrder($projectId) + 1;
        return $this->repository->newItem($data);
    }

    public function delete(string $id): bool
    {
        $this->removeFile($this->repository, $id, 'src', $this->imageFolder);
        return $this->repository->remove($id);
    }


    public function changeOrder(string $imageId, string $substituteId): bool
    {
        $substituteOrder = ProjectGalleryRepository::FindByField('id', $substituteId)->order;
        $imageOrder = ProjectGalleryRepository::FindByField('id', $imageId)->order;
        try {
            DB::beginTransaction();
            ProjectGalleryRepository::UpdateItem([
                'order' => $substituteOrder
            ], $imageId);
            ProjectGalleryRepository::UpdateItem([
                'order' => $imageOrder
            ], $substituteId);
            DB::commit();
            return true;
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->repository, $id, 'src', $this->imageFolder);
    }
}
