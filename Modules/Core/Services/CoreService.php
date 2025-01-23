<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Interfaces\RepositoryInterface;

abstract class CoreService
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrieve all records.
     */
    public function list(): Builder
    {
        return $this->repository->index();
    }

    /**
     * Retrieve a single entity by its ID.
     */
    public function getItem(int $id): ?Model
    {
        return $this->repository->findByField("id", $id);
    }

    /**
     * Create a new record.
     *
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Model
    {
        return $this->repository->newItem($data);
    }

    /**
     * Update an existing record.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, string $id): Model
    {
        return $this->repository->updateItem($data, $id);
    }

    /**
     * Delete a record by its ID.
     */
    public function delete(string $id): void
    {
        $this->repository->remove($id);
    }
}
