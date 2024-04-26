<?php

namespace App\Services;

use App\Interfaces\ConfirmationMethod;
use App\Models\User;

class ConfirmationMethodSMS implements ConfirmationMethod
{
    public function sendConfirmationCode(User $user, string $code): void
    {
        // Send code via sms
        // User must have phone number set in the settings
    }
}
