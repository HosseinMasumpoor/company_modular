<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Project\Filter\Category;
use Modules\Project\Filter\Search;
use Modules\Project\Models\Project;

class ProjectRepository extends Repository
{
    public string|Model $model = Project::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                $this->query()
            )
            ->through([
                Category::class,
                Search::class,
            ])
            ->thenReturn()
            ->orderByDesc('created_at');
    }

    public function syncCategories($id, $categories)
    {
        $record = (new self)->FindByField('id', $id);
        return $record->categories()->sync($categories);
    }

    public function syncTechnologies($id, $technologies)
    {
        $record = (new self)->FindByField('id', $id);
        return $record->technologies()->sync($technologies);
    }

    public function related($id, $limit = 6)
    {
        $relatedProjects = $this->index()->get();
        $count = $relatedProjects->count();

        if ($count < $limit) {
            $remaining = $limit - $count;

            $randomProjects = $this->query()->whereNotIn('id', function ($subQuery) use ($relatedProjects) {
                $subQuery->select('id')->fromSub($relatedProjects, 'subquery');
            })->where('id', '!=', $id)->where('projects.locale', app()->getLocale())
                ->inRandomOrder()->limit($remaining);

            $relatedProjects = $relatedProjects->union($randomProjects);
        }

        return $relatedProjects->where('projects.locale', app()->getLocale());
    }
}
