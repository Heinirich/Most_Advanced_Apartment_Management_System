<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use AfricasTalking\SDK\AfricasTalking;
use DB;

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
            $users = Bam_CurrentTenant($room->id,'data');
                foreach ($users as $key => $user) {
                    $username = env('AFRICASTALKING_USERNAME'); 
                    $apiKey   = env('AFRICASTALKING_API_KEY');
                    $from       = env('SENDER_ID');               
                    $AT       = new AfricasTalking($username, $apiKey);
                    $sms      = $AT->sms();
                    $recipients = $user->phone_number;
                    $message = $sms_group->sms_body;
                    try {
                        // Use the service
                        $result   = $sms->send([
                            'to'      => $recipients, 
                            'message' => $message,
                            'from'    => $from
                        ]);
                    print_r($result);
                    } catch (Exception $e) {
                        echo "Error: ".$e->getMessage();
                    }
                    \DB::table('sms_communications')->where('id',$sms_group->id)->update(['sms_status'=>1]);
                    $logs = new \App\Models\SmsLog();
                    $logs->user_id = $user->id;
                    $logs->sms = $sms_group->sms_body;
                    $logs->save();
                    
                
                
            }
        }
        return Command::SUCCESS;
    }
}
