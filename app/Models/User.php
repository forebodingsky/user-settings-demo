<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmation_method_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::observe(UserObserver::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(UserSetting::class);
    }

    public function confirmationMethod(): BelongsTo
    {
        return $this->belongsTo(ConfirmationMethod::class);
    }

    public function addDefaultSettings(): void
    {
        $globalSettings = GlobalSetting::get();

        $userSettingsData = $globalSettings->reduce(function (array $carry, GlobalSetting $setting) {
            $carry[] = [
                ...$setting->convertToArrayWithoutId(),
                'user_id' => $this->id,
            ];
            return $carry;
        }, []);

        UserSetting::insert($userSettingsData);
    }

    public function addDefaultConfirmationMethod(): void
    {
        $defaultMethod = ConfirmationMethod::getDefaultMethod();
        $this->confirmationMethod()->associate($defaultMethod)->save();
    }

    public function getConfirmationMethodKey(): string
    {
        return $this->confirmationMethod->key;
    }
}
