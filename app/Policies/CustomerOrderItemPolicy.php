<?php

namespace App\Policies;

use App\CustomerOrderItem;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerOrderItem policy.
 *
 * @package App\Policies
 */
class CustomerOrderItemPolicy implements DatatablePolicyContract
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can list of entities.
	 *
	 * @param Authenticatable $authenticatable
	 *
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
	 * Determine whether the user can view action column.
	 *
	 * @param Authenticatable $authenticatable
	 *
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{

		return false;
	}

	/**
	 * Determine whether the user can view the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param CustomerOrderItem $customerOrderItem
	 *
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerOrderItem $customerOrderItem)
	{

		return true;
	}

	/**
	 * Determine whether the user can create entity.
	 *
	 * @param Authenticatable $authenticatable
	 *
	 * @return boolean
	 */
	public function create(Authenticatable $authenticatable)
	{

		return false;
	}

	/**
	 * Determine whether the user can update the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param CustomerOrderItem $customerOrderItem
	 *
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerOrderItem $customerOrderItem)
	{

		return false;
	}

	/**
	 * Determine whether the user can delete the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param CustomerOrderItem $customerOrderItem
	 *
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerOrderItem $customerOrderItem)
	{

		return false;
	}

    /**
     * Determine whether the user can restore the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerOrderItem $customerOrderItem
     *
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerOrderItem $customerOrderItem)
    {

        return false;
    }
}
