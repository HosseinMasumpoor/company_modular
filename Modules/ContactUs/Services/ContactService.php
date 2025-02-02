<?php

namespace Modules\ContactUs\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Repositories\ContactRepository;

class ContactService
{
    public function __construct(protected ContactRepository $repository)
    {
    }

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function getItem(string $id): ?Model
    {
        return $this->repository->findByField('id', $id);
    }

    public function store($data): Model
    {
        return $this->repository->newItem($data);
    }

    public function visit(string $id): bool
    {
        return $this->repository->updateItem([
            'is_read' => true
        ], $id);
    }

    public function delete(string $id): bool
    {
        return $this->repository->remove($id);
    }
}
