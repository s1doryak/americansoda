<?php

namespace App\Http\Controllers\Dashboard;

use App\CustomerUser;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * CustomerUser controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerUsersController extends ResourceController
{
    use DashboardSidebar;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'customer_user';

    /**
     * @var array
     */
    protected $with = [
        'customers',
    ];

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'customers' => 'name',
    ];

    /**
     * CustomerUsersController constructor.
     * @param Gate $gate
     * @param CustomerUserRepository $customerUserRepository
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        Gate $gate,
        CustomerUserRepository $customerUserRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerUserRepository;
        $this->customers = $customerRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    public function updateToken(Request $request)
    {
        /** @var CustomerUser $customerUser */
        $customerUser = $this->repository->find($request->route('customer_user'));
        $customerUser->token = JWTAuth::fromUser($customerUser);
        $customerUser->save();
        $message = trans('models/customer_user.updateToken.success');

        return redirect()->back()->withSuccess($message);
    }
}
