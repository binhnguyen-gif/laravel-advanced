<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\EventSendMail;
use App\Listeners\SendMailRegisterUser;
use Illuminate\Support\Facades\Log;

use function Illuminate\Events\queueable;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EventSendMail::class => [
            SendMailRegisterUser::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
//        Event::listen(EventSendMail::class, [SendMailRegisterUser::class, 'handleTest']);

//        Event::listen(queueable(function (EventSendMail $eventSendMail) {
//            Log::info('Test delay');
//        })->delay(now()->addSeconds(60)));

//        Event::listen(queueable(function (EventSendMail $eventSendMail) {
//            throw new \Exception('Not found');
//            Log::info('hello');
//        })->catch(function (EventSendMail $event, \Throwable $e) {
//            Log::error('error');
//        }));

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
