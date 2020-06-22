<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Notifications\Api\V1\AuthAttemptFailed;
use App\Services\Api\V1\UserService;
use App\Services\Api\V1\CustomerUserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SendTokenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required',
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();

        $userService = app(UserService::class);
        $customerUserService = app(CustomerUserService::class);
        $email = $this->input('email');

        if (!$customerUserService->firstWhere(compact('email'))) {
            Notification::send($userService->notifiable(), new AuthAttemptFailed($email));

            throw new UnprocessableEntityHttpException();
        }
    }
}
