<?php

namespace App\Models;

class GlobalSetting extends Setting
{
    public function convertToArrayWithoutId(): array
    {
        return $this->makeHidden('id')->toArray();
    }
}
