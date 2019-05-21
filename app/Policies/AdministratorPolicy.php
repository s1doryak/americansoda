<?php

namespace App\Policies;

use App\Administrator;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Administrator policy.
 *
 * @package App\Policies
 */
class AdministratorPolicy implements DatatablePolicyContract
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
	 * @param Administrator $administrator
	 *
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, Administrator $administrator)
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
	 * @param Administrator $administrator
	 *
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, Administrator $administrator)
	{

		return true;
	}

	/**
	 * Determine whether the user can delete the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param Administrator $administrator
	 *
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, Administrator $administrator)
	{

		return true;
	}

    /**
     * Determine whether the user can restore the entity.
     *
     * @param Authenticatable $authenticatable
     * @param Administrator $administrator
     *
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, Administrator $administrator)
    {

        return true;
    }
}
