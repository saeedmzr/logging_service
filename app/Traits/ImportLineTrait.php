<?php

namespace App\Traits;

use App\Models\Log;
use Carbon\Carbon;

trait ImportLineTrait
{


    public function importLineToLog(string $line, $last_logged_at = null)
    {



        $date = $this->getBetween($line, "[", "]");
        $logged_at = Carbon::parse($date)->toDateTime();


//                check if logged at is ok and we didnt have aleady saved it.
        if (empty($last_logged_at) || Carbon::parse($last_logged_at)->timestamp < $logged_at->getTimestamp()) {

//                   get service name
            $service = explode(' - -', $line)[0];
//                  getstatus code
            $status_code = $this->getBetween($line, '" ', '\n');


            $method_endpont_version = $this->getBetween($line, '"', '"');

//                  get method
            $method = explode(' ', $method_endpont_version)[0];

//                   get endpoint
            $endpoint = explode(' ', $method_endpont_version)[1];

//             get http version
            $http_version = explode(' ', $method_endpont_version)[2];

            $payload = [
                'service_name' => $service,
                'status_code' => $status_code,
                'logged_at' => $logged_at,
                'method' => $method,
                'endpoint' => $endpoint,
                'http_version' => $http_version,
            ];
//              create our payload and store in DB
            Log::create($payload);


        }
//        dd($line);


    }


//    a customized fucntion for pulling our parametrs from that string

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
