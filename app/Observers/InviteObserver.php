<?php

namespace App\Observers;

use App\Jobs\SendInviteEmail;
use App\Models\Invite;

class InviteObserver
{
    public function created(Invite $invite): void
    {
        SendInviteEmail::dispatch($invite);
    }
}
