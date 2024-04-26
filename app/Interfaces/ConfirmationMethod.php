<?php

namespace App\Interfaces;

use App\Models\User;

interface ConfirmationMethod
{
    public function sendConfirmationCode(User $user, string $code): void;
}
