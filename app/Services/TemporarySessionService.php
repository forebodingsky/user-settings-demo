<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TemporarySessionService
{
    public function generateFromRequest(Request $request, string $code): string
    {
        $userId = $request->user()->id;
        $sessionId = "{$userId}-{$code}";
        Cache::put($sessionId, $request->validated(), now()->addMinutes(10));

        return $sessionId;
    }

    public function getRequestDataFromCode(User $user, string $code): mixed
    {
        $sessionId = "{$user->id}-{$code}";
        $requestData = Cache::pull($sessionId);

        return $requestData;
    }
}
