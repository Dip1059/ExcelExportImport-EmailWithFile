<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Controller;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail {apid=1} {apid2=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the data in excel sheet to email';

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
        /*$this->info($this->argument('apid'));
        $this->info($this->argument('apid2'));*/

        try {
            $done = app(Controller::class)->exportAndSendEmail($this->argument('apid'), $this->argument('apid2'));
            if($done) {
                $this->info($done);
            }else {
                $this->error('Not done');
            }   
        }catch(\Exception $e) {
            dd($e);
        }
    }
}
