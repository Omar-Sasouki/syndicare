<?php

namespace App\Console\Commands;

use App\Models\Residence;
use App\Models\User;
use App\Notifications\PaymentReminderNotification;
use App\Notifications\TableUpdatedNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendPaymentReminder extends Command
{
    protected $signature = 'payment:reminder';

    protected $description = 'Send payment reminder to users';

    public function handle()
    {
       
    }
}
