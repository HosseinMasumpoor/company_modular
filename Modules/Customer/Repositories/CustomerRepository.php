<?php

namespace Modules\Customer\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\Repository;
use Modules\Customer\Models\Customer;

class CustomerRepository extends Repository
{
    public string|Model $model = Customer::class;
}
