<?php

namespace App\Listeners;

use App\Events\TaskAssigned;
use App\Jobs\ProcessTaskNotificationJob;

class SendTaskAssignmentNotification
{
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
    public function handle(TaskAssigned $event): void
    {
        ProcessTaskNotificationJob::dispatch($event->task);
    }
}
