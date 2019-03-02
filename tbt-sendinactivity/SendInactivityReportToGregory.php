<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SendInactivityReportController;

class SendInactivityReportToGregory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:inactivity {fromDate=date(now())} {toDate=date(now())}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To send Inactivity Deduction Report to Gregory.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $success = app(SendInactivityReportController::class)->exportAndSendEmail($this->argument('fromDate'), $this->argument('toDate'));
            if($success) {
                $this->info('Successfully sent.');
            }else {
                $this->error('Not sent. No data or invalid date or date format.Check again.');
            }
        }catch(\Exception $e) {
            dd($e);
        }
    }
}
