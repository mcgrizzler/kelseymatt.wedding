<?php

namespace App\Jobs;

use App\Notifications\ExportCompletedNotification;
use Filament\Actions\Exports\Jobs\ExportCompletion;
use Illuminate\Contracts\Auth\Authenticatable;

class ExportCompletionWithEmail extends ExportCompletion
{
    public function handle(): void
    {
        parent::handle();

        $user = $this->export->user;

        if (! ($user instanceof Authenticatable)) {
            return;
        }

        $user->notify(new ExportCompletedNotification($this->export));
    }
}
