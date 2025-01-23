<?php


namespace Modules\Core\Interfaces;

interface RepositoryInterface
{
    public function getByFields($fields);
    public function newItem($data);
    public function updateItem($data,$id);
    public function remove($id);
}
