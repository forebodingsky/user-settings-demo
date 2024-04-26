<?php

namespace App\Services;

class CodeGeneratorService
{
    public function generate(): string
    {
        return sprintf("%06d", mt_rand(1, 999999));
    }
}
