<?php

namespace Modules\ContactUs\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Interfaces\Repositories\ContactUsRepositoryInterface;
use Modules\ContactUs\Models\Contact;
use Modules\Core\Repositories\Repository;

class ContactRepository implements ContactUsRepositoryInterface
{
    protected function query(): Builder
    {
        return Contact::query();
    }
    public function findByField($field, $value)
    {
        return $this->query()->where($field, $value)->first();
    }

    public function getByfields(array $fields)
    {
        $query = $this->query();
        foreach ($fields as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->get();
    }

    public function newItem(array $data)
    {
        return Contact::create($data);
    }

    public function updateItem(string $id, array $data)
    {
        $item = $this->findByField('id', $id);
        foreach ($data as $key => $value) {
            $item->{$key} = $value;
        }
        return $item->save();
    }

    public function deleteItem($id)
    {
        // TODO: Implement deleteItem() method.
    }
}
