<?php

namespace App\Policies;

use App\CustomerPreOrder;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerPreOrder policy.
 *
 * @package App\Policies
 */
class CustomerPreOrderPolicy implements DatatablePolicyContract
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
	 * @param CustomerPreOrder $customerPreOrder
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerPreOrder $customerPreOrder)
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
	 * @param CustomerPreOrder $customerPreOrder
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerPreOrder $customerPreOrder)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerPreOrder $customerPreOrder
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerPreOrder $customerPreOrder)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CustomerPreOrder $customerPreOrder
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerPreOrder $customerPreOrder)
    {

        return true;
    }
}
