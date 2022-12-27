<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SmsUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sms All User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
