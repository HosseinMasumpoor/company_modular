<?php

namespace Modules\Project\Filter;

use Modules\Core\Filter\Filter;

class Category extends Filter
{

    protected function applyFilter($builder)
    {
        return $builder->join("category_project", "category_project.project_id", "=", "projects.id")->join("categories", "category_project.category_id", "categories.id")
            ->where('categories.id', request($this->filterName()));
    }
}
