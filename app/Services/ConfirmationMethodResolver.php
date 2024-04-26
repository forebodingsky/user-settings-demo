<?php

namespace App\Services;

use App\Interfaces\ConfirmationMethod as IConfirmationMethod;
use App\Models\ConfirmationMethod;
use InvalidArgumentException;

class ConfirmationMethodResolver
{
    public function resolve(string $key): IConfirmationMethod
    {
        return match ($key) {
            ConfirmationMethod::EMAIL    => new ConfirmationMethodMail(),
            ConfirmationMethod::TELEGRAM => new ConfirmationMethodTelegram(),
            ConfirmationMethod::SMS      => new ConfirmationMethodSMS(),
            default                      => throw new InvalidArgumentException('Unknown method given'),
        };
    }
}
