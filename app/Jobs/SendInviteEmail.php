<?php

namespace App\Jobs;

use App\Mail\InviteEmail;
use App\Models\Invite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInviteEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(public Invite $invite) {}

    public function handle(): void
    {
        Mail::to($this->invite->email)->send(new InviteEmail($this->invite));
    }
}
