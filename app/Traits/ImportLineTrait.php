<?php

namespace App\Traits;

use App\Models\Log;
use Carbon\Carbon;

trait ImportLineTrait
{


    public function importLineToLog(string $line, $lastLoggedAt = null)
    {


        $date = $this->getBetween($line, "[", "]");
        $loggedAt = Carbon::parse($date)->toDateTime();


//                check if logged at is ok and we didnt have aleady saved it.
        if (empty($lastLoggedAt) || Carbon::parse($lastLoggedAt)->timestamp < $loggedAt->getTimestamp()) {

//                   get service name
            $service = explode(' - -', $line)[0];
//                  getstatus code
            $statusCode = $this->getBetween($line, '" ', '\n');


            $methodVendpontVersion = $this->getBetween($line, '"', '"');

//                  get method
            $method = explode(' ', $methodVendpontVersion)[0];

//                   get endpoint
            $endpoint = explode(' ', $methodVendpontVersion)[1];

//             get http version
            $httpVersion = explode(' ', $methodVendpontVersion)[2];

            $payload = [
                'service_name' => $service,
                'status_code' => $statusCode,
                'logged_at' => $loggedAt,
                'method' => $method,
                'endpoint' => $endpoint,
                'http_version' => $httpVersion,
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
