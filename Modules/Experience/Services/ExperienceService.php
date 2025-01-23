<?php

namespace Modules\Experience\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\Media;
use Modules\Experience\Repositories\ExperienceRepository;

class ExperienceService
{
    use Media;

    private string $imageFolder = 'experiences';

    public function __construct(protected ExperienceRepository $repository){}

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function store(array $data): bool
    {
        $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
        return (bool) $this->repository->newItem($data);
    }

    public function update(array $data, string $id): bool
    {
        if (isset($data["image"])) {
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
            $this->removeFile($this->repository, $id, "image", $this->imageFolder);
        }

        return $this->repository->updateItem($data, $id);
    }

    public function delete(string $id): bool
    {
        return $this->repository->remove($id);
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->repository, $id, 'image', $this->imageFolder);
    }
}
