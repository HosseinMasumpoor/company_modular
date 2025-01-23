<?php

namespace Modules\Technology\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\MediaService;
use Modules\Core\Services\StorageService;
use Modules\Core\Traits\Media;
use Modules\Technology\Repositories\TechnologyRepository;

class TechnologyService
{
    use Media;
    public function __construct(private readonly TechnologyRepository $repository){}
    private string $iconFolder = 'technologies';

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function store(array $data): Model
    {
        $data["icon"] = $this->storeFile($data["icon"], $this->iconFolder);

        return $this->repository->newItem($data);
    }

    public function update(array $data, string $id): bool
    {

        if (isset($data["icon"])) {
            $data["icon"] = $this->storeFile($data["icon"], $this->iconFolder);
            $this->removeFile($this->repository, $id, 'icon', $this->iconFolder);
        }

        return $this->repository->updateItem($data, $id);
    }

    public function delete(string $id): bool
    {
        $this->removeFile($this->repository, $id, 'icon', $this->iconFolder);
        return $this->repository->remove($id);
    }

    public function getIcon($id): array
    {
        return $this->getMedia($this->repository, $id, 'icon', $this->iconFolder);
    }
}
