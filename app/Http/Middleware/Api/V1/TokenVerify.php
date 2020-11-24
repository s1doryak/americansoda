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

    protected $except = [
        'api/v1.settings',
        'api/v1.auth'
    ];

    public function __construct(CustomerUserRepository $customerUserRepository)
    {
        $this->customerUserRepository = $customerUserRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $this->getTokenFromRequest($request);
        $user = $this->customerUserRepository->firstWhere(['token' => $token]);

        if ($user || $this->except($request)) {
            return $next($request);
        }

        return abort(401);
    }

    protected function getTokenFromRequest(Request $request)
    {
        $token = $request->header('Authorization');

        return Str::after($token, 'Bearer ');
    }

    protected function except(Request $request)
    {
        return in_array($request->route()->getName(), $this->except);
    }
}
