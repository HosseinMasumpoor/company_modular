<?php

namespace Modules\Customer\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Media;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Partner\Repositories\PartnerRepository;
use Throwable;

class CustomerService
{
    use Media;
    private string $imageFolder = 'customers';

    public function __construct(protected CustomerRepository $repository){}

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
        }

        return $this->repository->updateItem($data, $id);
    }

    public function changeOrder(string $id, string $substituteId): bool
    {
        $itemOrder = $this->repository->findByField('id', $id)->order;
        $substituteOrder = $this->repository->findByField('id', $substituteId)->order;

        try {
            DB::beginTransaction();

            $this->repository->updateItem([
                'order' => $substituteOrder,
            ], $id);

            $this->repository->updateItem([
                'order' => $itemOrder,
            ], $substituteId);

            DB::commit();
            return true;
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(string $id): bool
    {
        $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
        return $this->repository->remove($id);
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->repository, $id, 'image', $this->imageFolder);
    }
}
