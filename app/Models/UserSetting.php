<?php

namespace App\Models;

use App\Models\Scopes\UserSettingScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Setting
{
    protected static function booted(): void
    {
        static::addGlobalScope(new UserSettingScope);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function needsConfirmation(): bool
    {
        return $this->confirmable;
    }

    public function updateSetting(string $value): static
    {
        $this->value = $value;
        $this->save();

        return $this;
    }
}
