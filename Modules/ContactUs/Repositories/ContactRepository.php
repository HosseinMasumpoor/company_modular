<?php

namespace Modules\ContactUs\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Models\Contact;
use Modules\Core\Repositories\Repository;

class ContactRepository extends Repository
{
    public string|Model $model = Contact::class;
}
