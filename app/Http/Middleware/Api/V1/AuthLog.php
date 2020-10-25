<?php

namespace App\Http\Middleware\Api\V1;

use App\Repositories\Contracts\AuthLogRepository;
use App\Repositories\Eloquent\AuthLogRepositoryEloquent;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;


class AuthLog extends BaseMiddleware
{
    /**
     * @var AuthLogRepository
     */
    protected $authLogRepository;

    public function __construct(JWTAuth $auth, AuthLogRepositoryEloquent $authLogRepository)
    {
        parent::__construct($auth);

        $this->authLogRepository = $authLogRepository;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ValidatorException
     * @throws JWTException
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->auth->parseToken()->authenticate();
            $this->authLogRepository->create([
                'date' => Carbon::now(),
                'loggable_id' => auth()->id(),
                'loggable_type' => 'customer_user'
            ]);
        } catch (JWTException $e) {
        }

        return $next($request);
    }
}
