<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListLogsRequest;
use App\Http\Resources\LogResource;
use App\Repositories\Log\LogRepository;

class LogController extends Controller
{
    private $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function counter(ListLogsRequest $request)
    {
        $count = $this->logRepository->searchForLoggCount($request->validated());

        return new LogResource(['count' => $count]);
    }

}
