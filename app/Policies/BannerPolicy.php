<?php

namespace App\Policies;

use App\Banner;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Banner policy.
 *
 * @package App\Policies
 */
class BannerPolicy implements DatatablePolicyContract
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
	 * @param Banner $banner
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, Banner $banner)
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
	 * @param Banner $banner
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, Banner $banner)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param Banner $banner
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, Banner $banner)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param Banner $banner
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, Banner $banner)
    {

        return true;
    }
}
