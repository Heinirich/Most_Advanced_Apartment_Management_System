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
        foreach(Bam_Rooms('all') as $room){
            echo Bam_CurrentTenant($room->id);
        }
        return Command::SUCCESS;
    }
}
