<?php

namespace App\Listeners;

use App\Events\UserRegisteredToEvent;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredToEventConfirmation;

class SendRegisteredConfirmEmail implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredToEvent $event): void
    {
        Mail::to($event->attendee->user)->send(
            new RegisteredToEventConfirmation($event->attendee)
        );
    }
}
