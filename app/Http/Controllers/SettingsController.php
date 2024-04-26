<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConfirm;
use App\Http\Requests\UpdateSetting;
use App\Models\UserSetting;
use App\Services\CodeGeneratorService;
use App\Services\ConfirmationMethodResolver;
use App\Services\TemporarySessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingsController extends Controller
{
    public function index(Request $request): Response
    {
        $userSettings = $request->user()->settings;

        return response($userSettings);
    }

    public function update(
        UpdateSetting $request,
        ConfirmationMethodResolver $confirmationMethodResolver,
        CodeGeneratorService $codeGeneratorService,
        TemporarySessionService $tempSessionService,
    ): Response|JsonResponse {
        $settingId = $request->validated('setting_id');
        $settingToUpdate = UserSetting::findOrFail($settingId);
        if (! $settingToUpdate->needsConfirmation()) {
            $updatedSetting = $settingToUpdate->updateSetting($request->validated('value'));

            return response($updatedSetting);
        }
        if ($settingToUpdate->needsConfirmation()) {
            $confirmationCode = $codeGeneratorService->generate();
            $tempSessionId = $tempSessionService->generateFromRequest($request, $confirmationCode);

            $confirmationMethodKey = $request->user()->getConfirmationMethodKey();
            $confirmationMethodService = $confirmationMethodResolver->resolve($confirmationMethodKey);
            $confirmationMethodService->sendConfirmationCode($request->user(), $confirmationCode);

            \Log::info('Confirmation data', [
                'session_id' => $tempSessionId,
                'code'       => $confirmationCode,
            ]);

            return response()->json([
                'message'    => 'Action needs confirmation',
            ]);
        }
    }

    public function confirm(
        UpdateConfirm $request,
        TemporarySessionService $tempSessionService,
    ): Response|JsonResponse {
        $requestData = $tempSessionService->getRequestDataFromCode($request->user(), $request->validated('code'));
        if (!$requestData) {
            return response()->json([
                'message' => 'Invalid code',
            ], 422);
        }
        ['setting_id' => $settingId, 'value' => $value] = $requestData;
        $settingToUpdate = UserSetting::findOrFail($settingId);
        $updatedSetting = $settingToUpdate->updateSetting($value);

        return response($updatedSetting);
    }
}
