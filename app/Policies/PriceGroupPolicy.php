<?php

namespace App\Policies;

use App\PriceGroup;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * PriceGroup policy.
 *
 * @package App\Policies
 */
class PriceGroupPolicy implements DatatablePolicyContract
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
	 * @param PriceGroup $priceGroup
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, PriceGroup $priceGroup)
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
	 * @param PriceGroup $priceGroup
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, PriceGroup $priceGroup)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param PriceGroup $priceGroup
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, PriceGroup $priceGroup)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param PriceGroup $priceGroup
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, PriceGroup $priceGroup)
    {

        return true;
    }
}
