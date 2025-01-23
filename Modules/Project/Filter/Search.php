<?php

namespace Modules\Project\Filter;

use Modules\Core\Filter\Filter;

class Search extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('name', 'LIKE', '%' . request($this->filterName()) . '%')
            ->orWhere('summary', 'LIKE', '%' . request($this->filterName()) . '%');
    }
}
