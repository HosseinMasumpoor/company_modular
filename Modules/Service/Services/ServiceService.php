<?php

namespace Modules\Service\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\Media;
use Modules\Service\Repositories\ServiceRepository;

class ServiceService
{
    use Media;
    private string $imageFolder          = "services";
    private string $iconFolder           = "services/icons";

    public function __construct(protected ServiceRepository $repository)
    {
    }

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function add(array $data): bool
    {
        $image = $data["image"];
        $data['image'] = $this->storeFile($image, $this->imageFolder);

        $image = $data["icon"];
        $data['icon'] = $this->storeFile($image, $this->iconFolder);

        return (bool) $this->repository->newItem($data);
    }

    public function update(array $data, int $id): bool
    {
        if (isset($data["icon"])) {
            $this->removeFile($this->repository, $id, 'icon', $this->iconFolder);
            $data["icon"] = $this->storeFile($data["icon"], $this->iconFolder);
        }

        if (isset($data["image"])) {
            $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
        }

        return $this->repository->updateItem($data, $id);
    }

    public function changeOrder(int $id, int $substituteId): bool
    {
        $substituteOrder = $this->repository->findByField('id', $substituteId)->order;
        $itemOrder = $this->repository->findByField('id', $id)->order;

        try {
            DB::beginTransaction();

            $this->repository->updateItem([
                'order' => $substituteOrder
            ], $id);

            $this->repository->updateItem([
                'order' => $itemOrder
            ], $substituteId);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
        $this->removeFile($this->repository, $id, 'icon', $this->iconFolder);

        return $this->repository->Remove($id);
    }
    function getImage($id)
    {
        return $this->getMedia($this->repository, $id, 'image', $this->imageFolder);
    }

    function getIcon($id)
    {
        return $this->getMedia($this->repository, $id, 'icon', $this->iconFolder);
    }
}
