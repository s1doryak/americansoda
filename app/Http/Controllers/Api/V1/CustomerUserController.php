<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Profile\GetProfileRequest;
use Barryvdh\TranslationManager\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerUserController extends Controller
{
    protected $prefix = 'api';

    public function profile(GetProfileRequest $request)
    {
        return response()->json(Auth::user());
    }
}