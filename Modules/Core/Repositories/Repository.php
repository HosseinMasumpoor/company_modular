<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Core\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    /**
     * The model class or instance used by the repository.
     *
     * @var Model|string
     */
    public string|Model $model;

    protected function query(): Builder{
        return $this->model::query();
    }

    /**
     * Get items by many fields
     *
     * @param  array|collection  $fields  Column to filter by.
     */

    public function getByFields($fields): \Illuminate\Database\Eloquent\Collection
    {
        $query = $this->query();
        foreach ($fields as $key => $value) {
            $query = $query->where($key, $value);
        }
        return $query->get();
    }

    /**
     * Find a single model by column value.
     *
     * @param  string  $field  Column to filter by.
     * @param  mixed  $value  Value to match in the specified column.
     */
    public function findByField(string $field, mixed $value): ?Model
    {
        return $this->query()->where($field, $value)->first();
    }

    /**
     * Create a new record in the repository.
     *
     * @param  array<string, mixed>  $data  The data for creating the new record.
     * @return Model The newly created model instance.
     */
    public function newItem($data): Model
    {
        return $this->model::create($data);
    }

    /**
     * Update an existing record in the repository.
     *
     * @param  int  $id  The ID of the model to update.
     * @param  array<string, mixed>  $data  The data to update in the model.
     * @return bool Checks update operation is successfully or not
     */
    public function updateItem($data, $id): bool
    {
        $record = $this->findByField("id", $id);
        foreach ($data as $key => $value) {
            $record->{$key} = $value;
        }
        return $record->save();
    }

    public function remove($id): bool{
        $record = $this->findByField("id", $id);
        return $record->delete();
    }

    public function destroy(int $id): bool
    {
        return $this->model::destroy($id);
    }

    public function restore(int $id): ?Model
    {
        if (! method_exists($this->model, 'isSoftDelete')) {
            return null;
        }

        $object = $this->model->withTrashed()->find($id);
        if (! $object) {
            return null;
        }

        $object->restore();

        return $object;
    }

    public function index(): Builder
    {
        return $this->query()->orderBy('created_at', 'desc');
    }

    public function findByIdWithTrashed(int $id): ?Model
    {
        $modelClass = is_string($this->model) ? $this->model : get_class($this->model);
        if (! in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($modelClass))) {
            return null;
        }

        if (is_string($this->model)) {
            $modelInstance = new $this->model;
        } else {
            $modelInstance = $this->model;
        }

        return $modelInstance->withTrashed()->find($id);
    }
}
