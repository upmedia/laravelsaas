<?php

namespace App\Listeners\Auth;

use App\Mail\Auth\ActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user)
            ->send(new ActivationEmail($event->user->generateConfirmationToken()));
    }

    public function failed($event, $exception)
    {
        dd('Event failed');
    }
}
