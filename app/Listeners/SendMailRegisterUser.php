<?php

namespace App\Listeners;

use App\Events\EventSendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class SendMailRegisterUser implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventSendMail $event): void
    {
        $name = $event->name;
        Log::info('Test:'.$name);
    }
//    public function handleTest(EventSendMail $event) :void {
//        Log::info('Test event'. $event->name);
//    }
}
