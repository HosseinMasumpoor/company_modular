<?php

namespace App\Repositories;

use App\Filter\Name;
use App\Interfaces\RepositoryInterface;
use Modules\Project\Models\ProjectCategory;
use Illuminate\Pipeline\Pipeline;

class ProjectCategoryRepository implements RepositoryInterface
{
    private function query(): \Illuminate\Database\Eloquent\Builder
    {
        return ProjectCategory::query();
    }

    public static function GetByFields($fields)
    {
        $query = (new self)->query();
        foreach ($fields as $key => $value) {
            $query = $query->where($key, $value);
        }
        return $query->get();
    }

    public static function FindByField($field, $value)
    {
        return (new self)->query()->where($field, $value)->first();
    }

    static function NewItem($data): \Illuminate\Database\Eloquent\Model
    {
        return  ProjectCategory::create($data);
    }

    static function UpdateItem($data, $id): int
    {
        $record = (new self)->FindByField("id", $id);
        foreach ($data as $key => $value) {
            $record->{$key} = $value;
        }
        return $record->save();
    }


    static function Remove($id)
    {
        $record = (new self)->FindByField("id", $id);
        return $record->delete();
    }

    public static function Index()
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()

            )
            ->through(
                Name::class
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }
}
