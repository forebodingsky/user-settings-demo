<?php

namespace App\Services;

use App\Interfaces\ConfirmationMethod;
use App\Models\User;

class ConfirmationMethodMail implements ConfirmationMethod
{
    public function sendConfirmationCode(User $user, string $code): void
    {
        // Send code via email
    }
}
