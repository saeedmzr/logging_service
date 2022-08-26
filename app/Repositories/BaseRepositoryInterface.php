<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{

    public function all(array $columns = ['*'], array $relations = []);


    public function allTrashed();

    public function create(array $payload);


}
