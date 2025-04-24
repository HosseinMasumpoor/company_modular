<?php

namespace Modules\ContactUs\Interfaces\Repositories;

use Modules\Core\Interfaces\RepositoryInterface;

interface ContactUsRepositoryInterface
{
    public function findByField(string $field, string $value);
    public function getByfields(array $fields);
    public function newItem(array $data);
    public function updateItem(string $id, array $data);
    public function deleteItem(string $id);
}
