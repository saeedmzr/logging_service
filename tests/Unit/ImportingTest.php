<?php

namespace Tests\Unit;

use App\Models\Log;
use App\Traits\ImportLineTrait;
use Tests\TestCase;

class ImportingTest extends TestCase
{

    use ImportLineTrait;


    public function test_count_doesnt_change_if_we_import_empty_file()
    {

        $count = Log::all()->count();
        if ($file = fopen(public_path('logs/empty.txt'), "r")) {
            while (!feof($file)) {
                $line = fgets($file);
                $line = trim(preg_replace('/\s\s+/', '', $line));
                if (!empty($line))
                    $this->importLineToLog($line);
            }
        }

        fclose($file);

        $count_after_importing_empty_line = Log::all()->count();

        $this->assertEquals($count, $count_after_importing_empty_line);
    }

    public function test_count_if_file_only_include_one_line()
    {
        $count = Log::all()->count();

        if ($file = fopen(public_path('logs/one_line_log.txt'), "r")) {
            while (!feof($file)) {
                $line = fgets($file);
                $line = trim(preg_replace('/\s\s+/', '', $line));

                if (!empty($line))
                    $this->importLineToLog($line);
            }
        }

        fclose($file);

        $count_after_importing_empty_line = Log::all()->count();
        $this->assertEquals($count + 1, $count_after_importing_empty_line);

    }
    public function test_count_if_file_include_empty_lines()
    {
        $count = Log::all()->count();

//        File include 2 loggs and 3 empty lines

        if ($file = fopen(public_path('logs/include_empty_line.txt'), "r")) {
            while (!feof($file)) {
                $line = fgets($file);
//                remove space
                $line = trim(preg_replace('/\s\s+/', '', $line));

                if (!empty($line))
                    $this->importLineToLog($line);
            }
        }

        fclose($file);

        $count_after_importing_empty_line = Log::all()->count();
        $this->assertEquals($count + 2, $count_after_importing_empty_line);
    }
    public function test_preventing_from_duplication()
    {
        if ($file = fopen(public_path('logs/logs.txt'), "r")) {
            while (!feof($file)) {
                $line = fgets($file);
//                remove space
                $line = trim(preg_replace('/\s\s+/', '', $line));

                if (!empty($line))
                    $this->importLineToLog($line);
            }
        }

        $count_first_time = Log::all()->count();

//        get last item time and prevent it from duplation
        $last_one_inserted = Log::orderBy('logged_at', 'desc')->first();


//        File include 2 loggs and 3 empty lines

        if ($file = fopen(public_path('logs/logs.txt'), "r")) {
            while (!feof($file)) {
                $line = fgets($file);
//                remove space
                $line = trim(preg_replace('/\s\s+/', '', $line));

                if (!empty($line))
                    $this->importLineToLog($line,$last_one_inserted->logged_at);
            }
        }

        fclose($file);

        $count_after_importing_second_time = Log::all()->count();

        $this->assertEquals($count_first_time , $count_after_importing_second_time);
    }

}
