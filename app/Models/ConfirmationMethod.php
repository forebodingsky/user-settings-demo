<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConfirmationMethod extends Model
{
    public const EMAIL = 'email';
    public const SMS = 'sms';
    public const TELEGRAM = 'telegram';

    public const DEFAULT_METHOD = self::EMAIL;

    public const DEFAULT_METHODS = [
        self::EMAIL    => 'Confirm with email',
        self::SMS      => 'Confirm with SMS',
        self::TELEGRAM => 'Confirm with Telegram',
    ];

    protected $fillable = [
        'name',
        'key',
        'active',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function getDefaultMethod(): static
    {
        return static::firstWhere('key', self::DEFAULT_METHOD);
    }
}
