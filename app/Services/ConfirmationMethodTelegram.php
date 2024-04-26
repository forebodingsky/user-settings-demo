<?php

namespace App\Services;

use App\Interfaces\ConfirmationMethod;
use App\Models\User;

class ConfirmationMethodTelegram implements ConfirmationMethod
{
    public function sendConfirmationCode(User $user , string $code): void
    {
        // Send message via telegram bot
        // User must have telegram nickname set in the settings
    }
}
