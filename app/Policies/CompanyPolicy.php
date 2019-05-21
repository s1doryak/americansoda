<?php

namespace App\Policies;

use App\Company;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Company policy.
 *
 * @package App\Policies
 */
class CompanyPolicy implements DatatablePolicyContract
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
	 * Determine whether the user can view action column.
	 *
	 * @param Authenticatable $authenticatable
	 *
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * Determine whether the user can view the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param Company $company
	 *
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, Company $company)
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

		return true;
	}

	/**
	 * Determine whether the user can update the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param Company $company
	 *
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, Company $company)
	{

		return true;
	}

	/**
	 * Determine whether the user can delete the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param Company $company
	 *
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, Company $company)
	{

		return true;
	}

    /**
     * Determine whether the user can restore the entity.
     *
     * @param Authenticatable $authenticatable
     * @param Company $company
     *
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, Company $company)
    {

        return true;
    }
}
