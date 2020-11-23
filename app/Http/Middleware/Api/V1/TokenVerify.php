<?php

namespace App\Http\Middleware\Api\V1;

use App\Repositories\Contracts\CustomerUserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenVerify
{
    /** @var CustomerUserRepository */
    protected $customerUserRepository;

    public function __construct(CustomerUserRepository $customerUserRepository)
    {
        $this->customerUserRepository = $customerUserRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $this->getTokenFromRequest($request);
        $user = $this->customerUserRepository->firstWhere(['token' => $token]);

        if ($user) {
            return $next($request);
        }

        return abort(401);
    }

    protected function getTokenFromRequest(Request $request)
    {
        $token = $request->header('Authorization');

        return Str::after($token, 'Bearer ');
    }
}
