<?php

namespace App\Policies;

use App\ProductType;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * ProductType policy.
 *
 * @package App\Policies
 */
class ProductTypePolicy implements DatatablePolicyContract
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
	 * @param ProductType $productType
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, ProductType $productType)
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
	 * @param ProductType $productType
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, ProductType $productType)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param ProductType $productType
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, ProductType $productType)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param ProductType $productType
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, ProductType $productType)
    {

        return true;
    }
}
