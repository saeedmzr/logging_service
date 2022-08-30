<?php

namespace App\Console\Commands;

use App\Repositories\Log\LogRepository;
use App\Traits\ImportLineTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class importLogs extends Command
{

    use ImportLineTrait;

    private $logRepsoitory;

    public function __construct(LogRepository $logRepository)
    {
        parent::__construct();
        $this->logRepsoitory = $logRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Using this command for inserting logs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

//        Get  time of latest logg based on logged_at colomn to avoid duplicating records
        $lastLoggedAt = $this->logRepsoitory->getLatestLogDateTime();

        try {
            if ($file = fopen(public_path('logs/logs.txt'), "r")) {
                while (!feof($file)) {
//                    read file line by line to invoid file from conquering memory
                    $line = fgets($file);
//                remove space and \n
                    $line = trim(preg_replace('/\s\s+/', '', $line));

//                    check line only if its not a empty line
                    if (!empty($line))
                        $this->importLineToLog($line, $lastLoggedAt);
                }

            }
            fclose($file);

            $this->info("Logs Has been recorded successfully.");

        } catch (NoFileException $exception) {
            $this->info("The file doesn't exist");
        }

        return 0;
    }


}
