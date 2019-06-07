<?php

namespace App\Policies;

use App\CustomerUserToken;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerUserToken policy.
 *
 * @package App\Policies
 */
class CustomerUserTokenPolicy implements DatatablePolicyContract
{
	use HandlesAuthorization;

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function index(Authenticatable $authenticatable)
	{
		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerUserToken $customerUserToken
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerUserToken $customerUserToken)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function create(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerUserToken $customerUserToken
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerUserToken $customerUserToken)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerUserToken $customerUserToken
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerUserToken $customerUserToken)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CustomerUserToken $customerUserToken
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerUserToken $customerUserToken)
    {

        return true;
    }
}
