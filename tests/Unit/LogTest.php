<?php

namespace Tests\Unit;

use App\Models\Log;
use App\Repositories\Log\LogRepository;
use Tests\TestCase;

class LogTest extends TestCase
{


    public function test_store_new_log()
    {
        $log = Log::factory()->make();

        $this->assertIsObject($log);
    }

    public function test_check_count_if_i_pass_all_of_the_service_names()
    {
        $log = Log::factory()->count(100)->make();
        $service_names = Log::query()->select('service_name')->distinct()->get()->toArray();

        $logRepository = new LogRepository(new Log()) ;

        $services_count = $logRepository->searchForLoggCount(['serviceNames' =>  $service_names ]) ;
        $this->assertEquals($services_count , $logRepository->all()->count());

    }
}
