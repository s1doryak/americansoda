<?php

namespace App\Policies;

use App\CustomerUser;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerUser policy.
 *
 * @package App\Policies
 */
class CustomerUserPolicy implements DatatablePolicyContract
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
     * Determine whether the user can list of trashed entities.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function trashed(Authenticatable $authenticatable)
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
	 * @param CustomerUser $customerUser
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerUser $customerUser)
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
	 * @param CustomerUser $customerUser
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerUser $customerUser)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerUser $customerUser
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerUser $customerUser)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CustomerUser $customerUser
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerUser $customerUser)
    {

        return true;
    }
}
