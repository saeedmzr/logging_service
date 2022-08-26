<?php

namespace App\Repositories\Log;

use App\Models\Log;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class LogRepository extends BaseRepository implements LogRepositoryInterface
{
    protected $model;

    public function __construct(Log $model)
    {
        $this->model = $model;
    }

    public function getLatestLogDateTime()
    {
        $item = $this->model->orderBy('logged_at', 'desc')->first();
        if (!$item) return false;

        return $item->logged_at;
    }

    public function searchForLoggCount(array $payload = [])
    {

        $query = $this->model;
        if (isset($payload['serviceNames'])) {
            $query = $query->whereIn('service_name', $payload['serviceNames']);
        }

        if (isset($payload['statusCode'])) {
            $query = $query->where('status_code', $payload['statusCode']);
        }

        if (isset($payload['startDate'])) {
            $query = $query->where('logged_at', '>=', Carbon::createFromFormat('d/M/Y H:i:s',$payload['startDate']));
        }
        if (isset($payload['endDate'])) {
            $query = $query->where('logged_at', '<=', Carbon::createFromFormat('d/M/Y H:i:s',$payload['endDate']) );
        }


        return $query->count();
    }

    private function getBetween($string, $start = "", $end = ""): string
    {
        if (strpos($string, $start)) { // required if $start not exist in $string
            $startCharCount = strpos($string, $start) + strlen($start);
            $firstSubStr = substr($string, $startCharCount, strlen($string));
            $endCharCount = strpos($firstSubStr, $end);
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            return substr($firstSubStr, 0, $endCharCount);
        } else {
            return '';
        }
    }


}
