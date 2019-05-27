<?php

namespace App\Policies;

use App\Assembly;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Assembly policy.
 *
 * @package App\Policies
 */
class AssemblyPolicy implements DatatablePolicyContract
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
	 * @param Assembly $assembly
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, Assembly $assembly)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param Assembly $assembly
	 * @return boolean
	 */
	public function create(Authenticatable $authenticatable)
	{

		return false;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param Assembly $assembly
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, Assembly $assembly)
	{

		return false;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param Assembly $assembly
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, Assembly $assembly)
	{

		return false;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param Assembly $assembly
	 * @return boolean
	 */
    public function restore(Authenticatable $authenticatable, Assembly $assembly)
    {

        return false;
    }

	/**
	 * @param Authenticatable $authenticatable
	 * @param Assembly $assembly
	 * @return boolean
	 */
	public function assembly_list(Authenticatable $authenticatable, Assembly $assembly)
	{
		return true;
	}
}
