<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all(array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->get($columns);
    }


    public function allTrashed()
    {
        return $this->model->query()->onlyTrashed()->get();
    }


    public function create(array $payload): ?Model
    {

        return $this->model->create($payload);
    }

}
