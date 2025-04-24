<?php

namespace Modules\Core\Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Modules\Core\Repositories\Repository;
use Modules\Core\Tests\Models\DummyModel;
use Tests\TestCase;

class CoreRepositoryTest extends TestCase
{
    private $model;
    private $repository;
    private $builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = Mockery::mock(Model::class);

        $this->repository = new Repository();
        $this->repository->model = $this->model;
        $this->builder = Mockery::mock(Builder::class);
    }

    public function tearDown(): void
    {
        Parent::tearDown();
        Mockery::close();
    }

    public function testGetByFields()
    {
        $fields = [
            'column' => 'value'
        ];

        $collection = new Collection([$this->model]);

        $this->model->shouldReceive('query')->andReturn($this->builder);

        foreach($fields as $key => $value) {
            $this->builder->shouldReceive('where')->with($key, $value)->andReturnSelf();
        }
        $this->builder->shouldReceive('get')->andReturn($collection);

        $result = $this->repository->getByFields($fields);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($collection, $result);
    }

    public function testFindByField(){
        $column = 'column';
        $value = 'value';

        $data = $this->model;
        $this->model->shouldReceive('query')->andReturn($this->builder);
        $this->builder->shouldReceive('where')->with($column, $value)->andReturnSelf();
        $this->builder->shouldReceive('first')->andReturn($data);

        $result = $this->repository->findByField($column, $value);
        $this->assertInstanceOf(Model::class, $result);
        $this->assertEquals($data, $result);
    }

    public function testNewItem(){
        $data = [
            'column' => 'value'
        ];
        $this->model->shouldReceive('create')->with($data)->andReturn($this->model);
        $result = $this->repository->newItem($data);
        $this->assertInstanceOf(Model::class, $result);
    }

    public function testUpdateItem(){
        $id = 1;
        $data = [
            'column1' => 'value1',
            'column2' => 'value2'
        ];

        $record = Mockery::mock(Model::class);

        $this->builder->shouldReceive('where')->with('id', $id)->andReturnSelf();
        $this->builder->shouldReceive('first')->andReturn($record);

        $this->model->shouldReceive('query')->andReturn($this->builder);

        foreach ($data as $key => $value) {
            $record->shouldReceive('setAttribute')->with($key, $value)->once();
            $record->shouldReceive('getAttribute')->with($key)->andReturn($value);
        }

        $record->shouldReceive('save')->andReturn(true);

        $result = $this->repository->updateItem($data, $id);

        $this->assertTrue($result);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $record->{$key});
        }
    }

    public function testDeleteItem(){
        $id = 1;
        $record = $this->model;

        $this->model->shouldReceive('query')->andReturn($this->builder);

        $this->builder->shouldReceive('where')->with('id', $id)->andReturnSelf();
        $this->builder->shouldReceive('first')->andReturn($record);

        $this->model->shouldReceive('findByField')->with('id', $id)->andReturn($record);

        $record->shouldReceive('delete')->andReturn(true);
        $result = $this->repository->remove($id);

        $this->assertTrue($result);

    }

    public function testDestroyItem(){
        $id = rand(1, 50);
        $this->model->shouldReceive('destroy')->with($id)->once()->andReturn(true);
        $result = $this->repository->destroy($id);
        $this->assertTrue($result);
    }

//    public function testRestoreItem(){
//        $id = rand(1, 50);
//
//        // Test case 1: Model does not support soft delete
//        $this->model->shouldReceive('isSoftDelete')->andReturn(false);
//        $result = $this->repository->restore($id);
//        $this->assertNull($result);
//
//        // Test case 2: Model supports soft delete but record does not exist
//        $this->model->shouldReceive('isSoftDelete')->andReturn(true);
//        $this->model->shouldReceive('withTrashed')->andReturnSelf();
//        $this->model->shouldReceive('find')->with($id)->andReturn(null);
//        $result = $this->repository->restore($id);
//        $this->assertNull($result);
//
//        // Test case 3: Model supports soft delete and record exists
//        $record = Mockery::mock(Model::class); // Create a mock object for the record
//        $record->shouldReceive('restore')->once()->andReturn($record);
//
//        $this->model->shouldReceive('isSoftDelete')->andReturn(true);
//        $this->model->shouldReceive('withTrashed')->andReturnSelf();
//        $this->model->shouldReceive('find')->with($id)->andReturn($record);
//
//        $result = $this->repository->restore($id);
//        $this->assertSame($record, $result);
//
//
////        $record->shouldReceive('restore')->with($id)->andReturnSelf();
////
////        $result = $this->repository->restore($id);
////        $this->assertEquals($record, $result);
//    }

    public function testIndex(){
        $this->model->shouldReceive('query')->andReturn($this->builder);
        $this->builder->shouldReceive('orderBy')->with('created_at', 'desc')->andReturnSelf();
        $result = $this->repository->index();
        $this->assertInstanceOf(Builder::class, $result);
    }

    public function testFindByIdWithTrashedReturnNullWhenModelHasNotSoftDelete(){
        $id = rand(1, 50);

        $this->model->shouldReceive('isSoftDelete')->andReturn(false);
        $result = $this->repository->findByIdWithTrashed($id);
        $this->assertNull($result);
    }

    public function testFindByIdWithTrashedReturnModelWhenModelHasSoftDelete(){
        $id = rand(1, 50);

        $record = Mockery::mock(DummyModel::class);
        $dummyInstance = new DummyModel();
        $mocked = Mockery::mock($dummyInstance)->makePartial();
        $mocked->shouldReceive('withTrashed')->once()->andReturnSelf();
        $mocked->shouldReceive('find')->with($id)->andReturn($record);
        $result = $this->repository->findByIdWithTrashed($id);
        $this->assertSame($record, $result);
        $this->assertInstanceOf(DummyModel::class, $result);

    }
}
