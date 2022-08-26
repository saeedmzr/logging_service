<?php

namespace App\Repositories\Log;

use App\Repositories\BaseRepositoryInterface;

interface LogRepositoryInterface extends BaseRepositoryInterface
{
    public function getLatestLogDateTime();

    public function searchForLoggCount(array $payload);


}
